<!-- Content Header (Page header) -->
<div class="content-header p-0">
	<div class="container-fluid text-dark">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0" style="font-size:2.5rem;">Welcome, <?php echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname']; ?>!</h1>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<hr>
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content p-0 text-dark">
	<div class="container-fluid">
		<div class="row">

			<div class="col-lg-4">
				<div class="info-box">
					<span class="info-box-icon bg-gradient-light elevation-1"><i class="fa-solid fa-list"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">
							Categories</span>
						<span class="info-box-number text-right h5">
							<?php
							$category          = mysqli_query( $conn, 'SELECT * FROM category_list WHERE status = 1 AND delete_flag = 0' );
							$category_num_rows = mysqli_num_rows( $category );
							echo $category_num_rows;
							?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="info-box">
					<span class="info-box-icon bg-gradient-warning elevation-1"><i
							class="fa-solid fa-burger"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">
							Menus</span>
						<span class="info-box-number text-right h5">
						<?php
							$menu          = mysqli_query( $conn, 'SELECT * FROM menu_list WHERE status = 1 AND delete_flag = 0' );
							$menu_num_rows = mysqli_num_rows( $menu );
							echo $menu_num_rows;
						?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="info-box">
					<span class="info-box-icon bg-gradient-dark elevation-1"><i class="fa-solid fa-table"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">
							Queued Order</span>
						<span class="info-box-number text-right h5">
						<?php
							$order          = mysqli_query( $conn, 'SELECT * FROM order_list WHERE status = 0' );
							$order_num_rows = mysqli_num_rows( $order );
							echo $order_num_rows;
						?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="info-box">
					<span class="info-box-icon bg-gradient-warning elevation-1"><i class="fa-solid fa-list"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">
							Total Sales Today</span>
						<span class="info-box-number text-right h5">
						<?php
							$total_sale        = mysqli_query( $conn, "SELECT SUM(total_amount) AS total_price  FROM order_list WHERE date(dete_created) = '" . ( date( 'Y-m-d' ) ) . "'" );
							$total_sale_amount = mysqli_fetch_assoc( $total_sale );
							echo $total_sale_amount['total_price'] ? $total_sale_amount['total_price'] : 'N/A';
						?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
		<divc class="container-fluid text-center">
			<img class="img-fluid" id="system-cover" src="../uploads/cover.png" alt="cover">
		</divc>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content -->
