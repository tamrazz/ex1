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
		require_once 'db_crud.php';

		$formdata	= $_POST;
		$formfile 	= $_FILES['in_file'];
		$emailto	= $aemail;

		// file uploading
		$uploaddir 		= 'upload/';
		$uploadfilename = basename($formfile['name']);
		$uploadfile 	= ($uploadfilename == "") ? "" : $uploaddir . $uploadfilename;

		if (file_exists($uploadfile)) {
			$_uploadfilename = explode(".", $uploadfilename);
			$suffix = ($_uploadfilename[1] == '') ? '' : '.' . $_uploadfilename[1];
			$uploadfile =  $uploaddir . $_uploadfilename[0] . rand(0, 1023) . $suffix;
		}

		$error = '';
		switch ($formfile['error']) {
			case 0:
				$isok_file	= move_uploaded_file($formfile['tmp_name'], $uploadfile);
				break;
			case 1:
			case 2:
				$error = "ERROR file uploading: File is to large.";
				$isok_file = false;
				break;
			case 4:
				$isok_file = true;
				break;
			default:
				$error = "ERROR file uploading: Server error";
				$isok_file = false;
		}

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

		if ($isok_file && ($formfile['error'] == 0)) {
			$servfile = fopen($uploadfile, "r");
			$textfile = fread($servfile, filesize($uploadfile));
			fclose($servfile);
		}
		else
			$textfile = "";

		$msgbody .= "Content-Type: application/octet-stream; name==?utf-8?B?".base64_encode($uploadfile)."?=\n";
		$msgbody .= "Content-Transfer-Encoding: base64\n";
		$msgbody .= "Content-Disposition: attachment; filename==?utf-8?B?".base64_encode($uploadfile)."?=\n\n";
		$msgbody .= chunk_split(base64_encode($textfile))."\n";
		$msgbody .= "--".$boundary ."--\n";

		$isok_email = mail($to, $subject, $msgbody, $headers);
	//	$isok_email = true;
		$isok_msg	= $isok_file and $isok_email;
	
	?>	
	
	<div class="container">

		<br>
		<h3>Message sending</h3>
		<hr>

		<?php 

			$sucmsg = "Your message has been successfully sent!\n" . "Thank you for feedback";
			$usucmsg = "Unfortunately there was an error at data sending!\n" . $error;
			$value = $formdata + ['path' => $uploadfile];

			echo '<pre class="mb-0" style="white-space: pre-wrap;">';

			if ($isok_msg and db_add($value))
				echo($sucmsg);
			else
				echo($usucmsg);
			
			echo '</pre>';
		?>

		<hr>
		
	</div>

</body>
</html>