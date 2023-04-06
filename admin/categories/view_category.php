<?php
require_once( '../../config.php' );
if ( isset( $_GET['id'] ) ) {
	$sql    = "SELECT * FROM category_list WHERE id = {$_GET['id']}";
	$result = mysqli_query( $conn, $sql );
	$row    = mysqli_fetch_assoc( $result );
}

?>

<style>
	.modal-footer #submit{
		display: none;
	} 
</style>
<div class="container-fluid">
	<h6><span class="fw-bold">Category name</span>: <?php echo $row['name']; ?></h6>
	<div>
		<h6 class="mb-0"><span class="fw-bold">Description:</span></h6>
		<p><?php echo $row['description']; ?></p>
	</div>
	<h6><span class="fw-bold">Status</span>: 
	<?php if ( $row['status'] == 1 ) : ?>
		<button class="btn btn-xs btn-success rounded-pill py-0 px-3">Active</button>
	<?php else : ?>
		<button class="btn btn-xs btn-danger rounded-pill py-0 px-3">Inactive</button>
	<?php endif; ?>
	</h6>
</div>
