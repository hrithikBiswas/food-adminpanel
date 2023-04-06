
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
						<th>name</th>
						<th>Description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i              = 1;
						$cat_sql        = 'SELECT * FROM category_list WHERE delete_flag = 0 ORDER BY id DESC';
						$cat_sql_result = mysqli_query( $conn, $cat_sql );
					while ( $row = mysqli_fetch_assoc( $cat_sql_result ) ) :
						?>
					<tr>
						<td class="text-center"><?php echo $i++; ?></td>
						<td><?php echo date( 'Y-M-d h:i A', strtotime( $row['date_created'] ) ); ?></td>
						<td><?php echo $row['name']; ?></td>
						<td>
						   <p><?php echo $row['description']; ?></p>
						</td>
						<td>
							<?php if ( $row['status'] == 1 ) : ?>
								<button class="btn btn-xs btn-success rounded-pill py-0 px-3">Active</button>
							<?php else : ?>
								<button class="btn btn-xs btn-danger rounded-pill py-0 px-3">Inactive</button>
							<?php endif; ?>
						</td>
						<td>
							<div class="dropdown">
								<button class="btn btn-sm btn-light dropdown-toggle px-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
									Action
								</button>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item category_view" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-eye"></i> View</a></li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item category_edit" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #0d6efd;"></i> Edit</a></li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item category_delete" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash" style="color: #dc3545;"></i> Delete</a></li> 
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
			uni_modal("<i class='fa-solid fa-plus'></i> Add new category", "categories/manage_category.php");
		});
		$(".category_view").click(function(){
			uni_modal("<i class='fa-solid fa-circle-info' style='color: #9e9e9e;'></i> Category Details", "categories/view_category.php?id="+$(this).attr("data-id"));
		});
		$(".category_edit").click(function(){
			uni_modal("<i class='fa-solid fa-pen-to-square'></i> Update Category Details", "categories/manage_category.php?id="+$(this).attr("data-id"));
		});
		$(".category_delete").click(function(){
			delete_modal("Are you sure to delete this category?", "delete_category", $(this).attr("data-id"));
		});

	});
	function delete_category($id){
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_category",
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
						console.log("error in delete_category function");
						alert(resp.error);
					}
				}
			}

		})
	}
</script>
