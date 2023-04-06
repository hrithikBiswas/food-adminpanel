
<div class="container-fluid">
  <div class="content bg-warning py-3 px-4">
	<h3 class="fw-bolder text-light">Order List (Kitchen Side)</h3>
  </div>
  <div class="row mt-n4 justify-content-center">
	<div class="col-md-11">
	  <div class="card rounded-0">
		<div class="card-body">
		  <div class="row gx-2 py-1" id="order-feild">
			<?php
			  $order_list = mysqli_query( $conn, 'SELECT * FROM order_list WHERE status = 0 ORDER BY id DESC' );
			while ( $order_list_row = mysqli_fetch_assoc( $order_list ) ) :
				?>
			<div class="col-sm-12 col-md-6 col-xl-4">
			  <div class="card rounded-0 border-top border-warning shadow" style="border-top-width: 3px !important;">
				<div class="card-header">
				  <p class="card-title">Queue #<?php echo $order_list_row['queue']; ?></p>
				</div>
				<div class="order-list card-body overflow-auto">
				  <table class="table table-sm table-bordered">
					<thead class="bg-warning">
					  <tr>
						<th scope="col">Product</th>
						<th scope="col">QTY</th>
					  </tr>
					</thead>
					<tbody>
				<?php
				$order_items_sql = "SELECT oi.*, concat(m.code, ' - ', m.name) as item  FROM order_items oi INNER JOIN menu_list m ON oi.menu_id = m.id WHERE order_id = {$order_list_row['id']}";
				$order_items     = mysqli_query( $conn, $order_items_sql );
				while ( $order_items_row = mysqli_fetch_assoc( $order_items ) ) :
					?>
					  <tr>
						  <td><?php echo $order_items_row['item']; ?></td>
					<td><?php echo $order_items_row['quantity']; ?></td>
					  </tr>
				  <?php endwhile; ?>
					</tbody>
				  </table>
				</div>
				<div class="card-footer py-1 text-body-secondary">
				  <button
					class="btn btn-sm btn-light btn-block bg-gradient-light px-2 border rounded-pill serve-order" data-queue="<?php echo $order_list_row['queue']; ?>" data-id="<?php echo $order_list_row['id']; ?>">Serve</button>
				</div>
			  </div>
			</div>
			<?php endwhile; ?>
		  </div>
		</div>
	  </div>
	</div>
  </div>
</div>
<script>
	$(document).ready(function(){
		$(".serve-order").click(function(){
			delete_modal("Are you sure to serve Queue #: "+ $(this).attr('data-queue') +"?", "serve_order", $(this).attr('data-id'));
		})
	})

	function serve_order($id){
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=serve_order",
			method: "POST",
			data: {id: $id},
			error: err => {
				console.log(err);
				alert("Error occurred");
			},
			success: function(resp){
				if(resp){
					resp = JSON.parse(resp);
					if(resp.status == 'success'){
						end_loader();
						location.reload();
					}else{
						end_loader();
						console.log(resp.msg);
						alert("check console error");
					}
				}
			}
		})
	}
</script>
