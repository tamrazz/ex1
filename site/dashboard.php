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
		require_once 'start.php';
		require_once 'db_crud.php';
	?>
	
	<div class="container">

		<br>
		<h3>Dashboard</h3>
		<hr>

		<?php
			$rows_per_page = 10;
			$total_rows = db_count($link, $table);
			$num_pages = ceil($total_rows / $rows_per_page);
			$cur_page = get_curpage($num_pages);
			$db_start = ($cur_page - 1) * $rows_per_page;
			$print_fields = array('id', $fields[0], $fields[1], $fields[3], $fields[7]);

			function get_curpage($max_, $min_ = 1) {
				$my_get = $_GET['page'];

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

		<table class="table table-hover">

			<thead class="thead-dark" align="center">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Message</th>
				</tr>
			</thead>

			<?php 
				db_read($link, $table, $print_fields, $db_start, $rows_per_page);
			?>
		</table>

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

	<script src="../bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>