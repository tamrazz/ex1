<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html'
	?>
	<title>MESSAGE SENDING</title>
</head>

<body>
	<?php 
		include 'nav.html';
		require_once 'start.php';
		
		$formdata	= $_POST;
		$formfile 	= $_FILES['in_file'];
		$emailto	= $aemail;

		// file uploading
		$uploaddir 		= '../admin/heap/';
		$uploadfile 	= $uploaddir . basename($formfile['name']);

		if ($formfile['error'] == 0 and $formfile['size'] > 0)
			$isok_file	= move_uploaded_file($formfile['tmp_name'], $uploadfile);
		else
			$isok_file = true;

		// email sending
		$boundary	= "---";
		$to 		= $emailto;
		$subject 	= 'New message from user';
		$message 	= $formdata['in_msg'];
		$headers	= array(
		    'From'			=> $formdata['in_vocative'] . $formdata['in_name'] . $formdata['in_lname'],
		    'Reply-To'		=> $formdata['in_email'],
		    'Content-Type'	=> 'multipart/mixed; boundary=\"$boundary\""',
		    'X-Mailer'		=> 'PHP/' . phpversion()
		);

		$msgbody = "--$boundary\n";
		$msgbody .= "Content-type: text/html; charset='utf-8'\n";
		$msgbody .= "Content-Transfer-Encoding: quoted-printablenn";
		$msgbody .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($uploadfile)."?=\n\n";
		$msgbody .= $message."\n";
		$msgbody .= "--$boundary\n";
		$servfile = fopen($uploadfile, "r");
		$textfile = fread($servfile, filesize($uploadfile));
		fclose($servfile);
		$msgbody .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($uploadfile)."?=\n";
		$msgbody .= "Content-Transfer-Encoding: base64\n";
		$msgbody .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($uploadfile)."?=\n\n";
		$msgbody .= chunk_split(base64_encode($textfile))."\n";
		$msgbody .= "--".$boundary ."--\n";

		$isok_email = mail($to, $subject, $msgbody, $headers);
		$isok_msg	= $isok_file and $isok_email;
	
	?>	
	
	<div class="container">

		<br>
		<h3>Message sending</h3>
		<hr>

		<?php 

			$sucmsg = "Your message has been successfully sent!\n" . "Thank you for feedback";
			$usucmsg = "Unfortunately there was an error at data sending!\n" . "Please try again later";

			if ($isok_msg) {
				$value = $formdata + ['path' => $uploadfile];
				
				if (!db_add($link, $table, $fields, $value)) {
					echo '<pre class="mb-0" style="white-space: pre-wrap;">';
						echo("Adding in database failed");
					echo '</pre>';			
				}

				echo '<pre class="mb-0" style="white-space: pre-wrap;">';
					echo($sucmsg);
				echo '</pre>';


			}

			else {
				echo '<pre class="mb-0" style="white-space: pre-wrap;">';
					echo($usucmsg);
				echo '</pre>';
			}

			$link->close();

		?>

		<hr>
		
	</div>


	<script src="../bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>