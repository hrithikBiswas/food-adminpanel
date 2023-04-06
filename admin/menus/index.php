<?php if ( $_settings->check_flashdata( 'success' ) ) : ?>
<script>
	alert_toast("<?php echo $_settings->flashdata( 'success' ); ?>", "success");
</script>
<?php endif; ?>
<div class="container-fluid">
	<div class="card mb-0 border-top border-warning" style="border-top-width: 3px !important;">
		<div class="card-header">
			<div class="card-title">List of Categories</div>
			<button class="card-tools btn btn-primary rounded-0" id="create-new"><i class="fa-solid fa-plus fa-lg" style="color: #ffffff;"></i> Create New</button>
		</div>
	   <div class="card-body">
			<table id="example" class="table table-hover table-bordered table-striped" style="width:100%">
				<thead>
					<tr>
						<th>S/N</th>
						<th>Date Created</th>
						<th>Menu</th>
						<th>Description</th>
						<th>Price</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i      = 1;
						$sql    = 'SELECT m.*, c.name as category FROM menu_list m INNER JOIN category_list c ON m.category_id = c.id  WHERE m.delete_flag = 0';
						$result = mysqli_query( $conn, $sql );
					while ( $row = mysqli_fetch_assoc( $result ) ) :
						?>
					<tr>
						<td class="text-center"><?php echo $i++; ?></td>
						<td><?php echo date( 'Y-M-d h:i A', strtotime( $row['date_created'] ) ); ?></td>
						<td>
							<div style="line-height: 1rem;">
								<p class="m-0"><?php echo $row['code'] . ' - ' . $row['name']; ?></p>
								<div><small class="text-muted"><?php echo $row['category']; ?></small></div>
							</div>
						</td>
						<td>
						   <p><?php echo $row['description']; ?></p>
						</td>
						<td><?php echo $row['price']; ?>$</td>
						<td>
							<?php if ( $row['status'] == 1 ) : ?>
							<button class="btn btn-xs btn-success rounded-pill py-0 px-3">Available</button>
							<?php else : ?>
							<button class="btn btn-xs btn-danger rounded-pill py-0 px-3">Unavailable</button>
							<?php endif; ?>
						</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-sm btn-light dropdown-toggle px-4" type="button" data-bs-toggle="dropdown">
									Action
								</button>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item menu_view" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-eye"></i> View</a></li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item menu_edit" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #0d6efd;"></i> Edit</a></li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item menu_delete" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash" style="color: #dc3545;"></i> Delete</a></li> 
								</ul>
							</div>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
	   </div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#create-new').click(function(){
			uni_modal("<i class='fa-solid fa-plus'></i> Add new menu", "menus/manage_menu.php");
		});
		$(".menu_view").click(function(){
			uni_modal("<i class='fa-solid fa-circle-info' style='color: #9e9e9e;'></i> Menu Details", "menus/view_menu.php?id="+$(this).attr("data-id"));
		});
		$(".menu_edit").click(function(){
			uni_modal("<i class='fa-solid fa-pen-to-square'></i> Update menu Details", "menus/manage_menu.php?id="+$(this).attr("data-id"));
		});
		$(".menu_delete").click(function(){
			delete_modal("Are you sure to delete this menu?", "delete_menu", $(this).attr("data-id"));
		});

	});
	function delete_menu($id){
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_menu",
			method: 'POST',
			data: {id: $id},
			error: err =>{
				console.log("Error: " + err);
				alert("Error occurred");
			},
			success: function(resp){
				if(resp){
					resp = JSON.parse(resp);
					if(resp.status == 'success'){
						end_loader();
						location.reload();
					}else{
						console.log("error in delete_menu function");
						alert(resp.error);
					}
				}
			}

		})
	}
</script>
