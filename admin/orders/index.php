<div class="container-fluid">
	<div class="card mb-0 border-top border-warning" style="border-top-width: 3px !important;">
		<div class="card-header">
			<div class="card-title">List of Orders</div>
		</div>
	   <div class="card-body">
			<table id="example" class="table table-hover table-bordered table-striped " style="width:100%">
				<thead>
					<tr>
						<th>S/N</th>
						<th>Date Created</th>
						<th>Transaction Code</th>
						<th>Queue</th>
						<th>Total Amount</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i         = 1;
					$order_sql = mysqli_query( $conn, 'SELECT * FROM order_list ORDER BY id DESC' );
					while ( $order_sql_row = mysqli_fetch_assoc( $order_sql ) ) :
						?>
					<tr>
						<td class="text-center"><?php echo $i++; ?></td>
						<td><?php echo date( 'Y-M-d h:i A', strtotime( $order_sql_row['dete_created'] ) ); ?></td>
						<td><?php echo $order_sql_row['code']; ?></td>
						<td><?php echo $order_sql_row['queue']; ?></td>
						<td><?php echo $order_sql_row['total_amount']; ?></td>
						<td>
							<?php
							if ( $order_sql_row['status'] == 0 ) :
								?>
							<button class="btn btn-xs btn-primary fw-bold">Queued</button>
							<?php else : ?>
							<button class="btn btn-xs btn-success fw-bold">Served</button>
							<?php endif; ?>
						</td>
						<td>
							<button class="btn btn-xs btn-secondary view-receipt" data-id="<?php echo $order_sql_row['id']; ?>" title="Print Receipt"><i class="fa-solid fa-print"></i></button>
							<button class="btn btn-xs btn-danger delete-order" data-id="<?php echo $order_sql_row['id']; ?>" title="Delete Order"><i class="fa-solid fa-trash"></i></button>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
	   </div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete-order').click(function(){
			delete_modal("re you sure to delete this order permanently?", "delete_order", $(this).attr('data-id'));
		})
		$(".view-receipt").click(function(){
			var new_window = window.open(_base_url_ + "admin/sale/receipt.php?id="+$(this).attr('data-id'), "_blank", "width="+($(window).width() * .8) +",left="+($(window).width() * .1)+",height="+($(window).height() * .8)+",top="+($(window).height() * .1));
				setTimeout(() => {
					new_window.print();
					setTimeout(() => {
						new_window.close();
						location.reload();
					}, 500);
				}, 200);
		})
	})

	function delete_order($id){
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_order",
			method: "POST",
			data: {id: $id},
			error: err => {
				console.log(err);
				alert("check console");
			},
			success: function(resp){
				if(resp){
					resp = JSON.parse(resp);
					if(resp.status == 'success'){
						end_loader();
						location.reload();
					}else{
						console.log(resp.msg);
					}
				}
			}
		})
	}
</script>
