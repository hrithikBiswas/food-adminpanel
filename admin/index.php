<?php require_once( '../config.php' ); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once( 'inc/header.php' ); ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
	<!-- Navbar -->
	<?php require_once( 'inc/topNavBar.php' ); ?>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<?php require_once( 'inc/navigation.php' ); ?>

	<?php if ( $_settings->check_flashdata( 'success' ) ) : ?>
<script>
	alert_toast("<?php echo $_settings->flashdata( 'success' ); ?>", "success");
</script>
<?php endif; ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper pt-3 px-2 text-dark">
		<?php
			$page = isset( $_GET['page'] ) ? $_GET['page'] : 'home';

		if ( ! file_exists( $page . '.php' ) && ! is_dir( $page ) ) {
			include '404.html';
		} else {
			if ( is_dir( $page ) ) {
				include $page . '/index.php';
			} else {
				include $page . '.php';
			}
		}
		?>
	</div>
	<!-- /.content-wrapper -->

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
	  <!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->

	<!-- Main Footer -->
	<footer class="main-footer">
	  <strong>Copyright &copy; <?php echo date( 'Y' ); ?> <a href="https://resume-sandy-one.vercel.app/" target="_blank">Hrithik-Biswas</a>.</strong>
	  All rights reserved.
	  <div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 1.0.0
	  </div>
	</footer>
  </div>
  <!-- ./wrapper -->

	<!-- Delete Modal -->
	<div class="modal fade" id="delete-modal" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">confimation</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" id="delete-btn" class="btn btn-danger" onclick="">Continue</button>
			</div>
			</div>
		</div>
	</div>
	
	<!-- Modal  -->
	<div class="modal fade" id="uni_modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="submit" id="submit" class="btn btn-primary" onclick="$('#uni_modal form').submit();">Save</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
	</div>


  <?php require_once( './inc/footer.php' ); ?>
</body>

</html>
