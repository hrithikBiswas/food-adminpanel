<?php
require_once( '../../config.php' );
if ( isset( $_GET['id'] ) ) {
	$sql    = "SELECT * FROM order_list WHERE id = {$_GET['id']}";
	$result = mysqli_query( $conn, $sql );
	$row    = mysqli_fetch_assoc( $result );

	if ( isset( $row['user_id'] ) ) {
		$user     = mysqli_query( $conn, "SELECT * FROM users WHERE id = {$row['user_id']}" );
		$user_row = mysqli_fetch_assoc( $user );
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
require_once( '../inc/header.php' );
?>
<body>
	<div class="container" style="line-height: 1rem;">
		<header class="text-center">
			<h5>Fast Food Ordering System</h5>
			<h6>Unofficial Receipt</h6>
		</header>
		<hr>
		<main>
			<div>
				<div>Transaction code: <?php echo isset( $row['code'] ) ? $row['code'] : ''; ?></div>
				<div>Date & Time: <?php echo isset( $row['dete_created'] ) ? date( 'M, d Y g:i a', strtotime( $row['dete_created'] ) ) : ''; ?></div>
				<div>Processed By: <?php echo isset( $user_row['username'] ) ? $user_row['username'] : ''; ?></div>
			</div>
			<hr>
			<table class="table">
				<thead>
					<tr>
						<th>QTY</th>
						<th>Items</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody class="table-group-divider">
					<?php
						$order_items = mysqli_query( $conn, "SELECT oi.*, concat(m.code, ' - ', m.name) as item FROM order_items  oi INNER JOIN menu_list m ON oi.menu_id = m.id WHERE oi.order_id = {$row['id']}" );
					while ( $order_items_row = mysqli_fetch_assoc( $order_items ) ) :
						?>
					<tr>
						<td><?php echo isset( $order_items_row['quantity'] ) ? $order_items_row['quantity'] : '0'; ?></td>
						<td><?php echo isset( $order_items_row['item'] ) ? $order_items_row['item'] : ''; ?></td>
						<td><?php echo isset( $order_items_row['price'] ) ? $order_items_row['price'] : '0'; ?></td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<div class="table-group-divider"></div>
			<div class="calc-value">
				<div class="d-flex justify-content-between">
					<h5 class="fw-bold">Grant total</h5>
					<h5 class="fw-bold"><?php echo isset( $row['total_amount'] ) ? $row['total_amount'] : '0'; ?></h5>
				</div>
				<div class="d-flex justify-content-between">
					<h6 class="fw-bold">Trendered</h6>
					<h6 class="fw-bold"><?php echo isset( $row['tendered_amount'] ) ? $row['tendered_amount'] : '0'; ?></h6>
				</div>
				<div class="d-flex justify-content-between">
					<h6 class="fw-bold">Change</h6>
					<h6 class="fw-bold"><?php echo isset( $row['total_amount'] ) && isset( $row['tendered_amount'] ) ? ( $row['tendered_amount'] - $row['total_amount'] ) : '0'; ?></h6>
				</div>
			</div>
			<hr class="border-bottom border-1" style="border-bottom-color:black !important; padding:1px">
			<div class="text-center">
				<h6 class="fw-bold">Queue #</h6>
				<h5 class="fw-bold"><?php echo isset( $row['queue'] ) ? $row['queue'] : '00000'; ?></h5>
			</div>
			<hr class="border-bottom border-1" style="border-bottom-color:black !important; padding:1px">
		</main>
	</div>
</body>
<script>
	document.querySelector('title').innerHTML = "Unofficial Receipt - Print View"
</script
</html>
