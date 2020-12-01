<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html';
	?>
	<title>DASHBOARD</title>
</head>

<body>

	<?php 
		include 'nav.html';
		require_once 'db_crud.php';
	?>
	
	<div class="container">

		<br>
		<h3>Dashboard</h3>
		<hr>

		<?php
			$rows_per_page = 10;
			$total_rows = db_count();
			$num_pages = ($total_rows > 0) ? ceil($total_rows / $rows_per_page) : 1;
			$cur_page = get_curpage($num_pages);
			$db_start = ($cur_page - 1) * $rows_per_page;
			$print_tabkeys = ['id', 'fname', 'lname', 'email', 'msgtxt', 'file'];

			function show_file($path_) {

				if (empty($path_))
					$res_ = 'No file attached';
				else
					if (file_exists($path_)) {
						$finfo_ = new finfo(FILEINFO_MIME_TYPE);
						$tinfo_ = $finfo_->file($path_);
						$type_ = explode("/", $tinfo_);
						switch ($type_[0]) {

							case 'text':
								$txtfile_ = fopen($path_, 'r');
								$txt_ = '';
								while (!feof($txtfile_)) {
									$txt_ .= fgets($txtfile_);	    
								}
								fclose($txtfile_);
								$res_ = 	'<p><a data-toggle="collapse" href="#' . $path_ . '" aria-expanded="false" aria-controls="footwear">Attached text file</a></p>' .
											'<div class="collapse" id="' . $path_ . '">' .
											'<pre class="my-0" style="white-space: pre-wrap;">' .	$txt_ . '</pre> </div>';
								break;

							case 'image':
								$img_ = '<img src="' . $path_ . '" alt="Warning: Load image failed!">';

								$res_ = 	'<p><a data-toggle="collapse" href="#' . $path_ . '" aria-expanded="false" aria-controls="footwear">Attached picture</a></p>' .
											'<div class="collapse" id="' . $path_ . '">' . $img_. '</div>';
								break;

							default:
								$res_ = $path_;
						}
						unset($finfo_);
					}
					else
						$res_ = "Warning: Can't find file " . $path_ ;
				echo $res_;
			}

			function get_curpage($max_, $min_ = 1) {

				$my_get = (empty($_GET)) ? 1 : $_GET['page'];				

				if ($my_get == NULL)
					$cur_page_ = $min_;
				elseif ($my_get < $min_)
					$cur_page_ = $min_;
				elseif ($my_get > $max_)
					$cur_page_ = $max_;
				else
					$cur_page_ = ($my_get); 
					
				return $cur_page_;
			}

			function get_page($cur_page_, $max_, $inc_, $min_ = 1, $printout_ = false)	{
				$get_page_ = (($cur_page_ + $inc_) > $max_) || (($cur_page_ + $inc_) < $min_) ? NULL : $cur_page_ + $inc_;

				if ($inc_ > 0)
					$label_ = '"> >>';
				else 
					$label_ = '"> <<';

				if ($get_page_ == NULL)
					$ref_dis_ = ' disabled';
				else
					$ref_dis_ = '';

				if ($printout_) {
					echo '<li class="page-item' . $ref_dis_ . '">';
					echo '<a class="page-link" href="' . $_SERVER['PHP_SELF'] . '?page=' . $get_page_ . $label_ . '</a>';
				}

				return $get_page_;
			}

			function get_centr($cur_page_, $max_page_)	{
				echo '<li class="page-item disabled">';
				echo '<a class="page-link" href="">' . $cur_page_ . " | " . $max_page_ . '</a>';
			}

		?>

		<!-- TABLE -->
		<table class="table table-hover">

			<thead class="thead-dark" align="center">
				<tr>
					<?php
						foreach ($print_tabkeys as $val) {
							echo '<th scope="col">';
								echo $fields[$val];
							echo '</th>';

						}
					?>
				</tr>
			</thead>

			<?php 
				$rows_readed = db_read($db_start, $rows_per_page);
				if ($rows_readed !== false) {
					while($row = $rows_readed->fetch_assoc()) {
						echo '<tr>'	;
							foreach ($print_tabkeys as $val) {
								echo '<th class="font-weight-normal">';
									if ($val == 'file')
										show_file($row[$val]);
									else
										echo $row[$val];
								echo '</th>';
							}
						echo '</tr>';
					}
					$rows_readed->free();
				}
			?>
		</table>

		<!-- PAGINATION -->
		<div class="container-fluid">
			<nav aria-label="...">
				<ul class="pagination justify-content-center">
					<?php
						get_page($cur_page, $num_pages, -1, $min_ = 0, $printout_ = true);
						get_centr($cur_page, $num_pages);
						get_page($cur_page, $num_pages, 1, $min_ = 0, $printout_ = true);
					?>
				</ul>
			</nav>
		</div>

		<hr>
		
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>