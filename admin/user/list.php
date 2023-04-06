<div class="container-fluid">
	<div class="card mb-0 border-top border-warning" style="border-top-width: 3px !important;">
		<div class="card-header">
			<div class="card-title">List of Categories</div>
			<a href="./?page=user/manage_user" class="card-tools btn btn-primary rounded-0"><i
					class="fa-solid fa-plus fa-lg" style="color: #ffffff;"></i> Create New</a>
		</div>
		<div class="card-body">
			<table id="example" class="table table-hover table-bordered table-striped" style="width:100%">
				<thead>
					<tr>
						<th>S/N</th>
						<th>Date Updated</th>
						<th>Avatar</th>
						<th>name</th>
						<th>Username</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i          = 1;
						$sql    = "SELECT * FROM users WHERE id != '{$_settings->userdata('id')}'";
						$result = mysqli_query( $conn, $sql );
					while ( $row = mysqli_fetch_assoc( $result ) ) :
						?>
					<tr>
						<td class="text-center align-middle">
							<?php echo $i++; ?>
						</td>
						<td class="align-middle">
							<?php echo date( 'Y-M-d h:i A', strtotime( $row['date_added'] ) ); ?>
						</td>
						<td class="text-center align-middle">
							<img class="d-inline img-fluid img-thumbnail rounded-pill" src="
							<?php
							echo validate_image( isset( $row['avatar'] ) ? $row['avatar'] : '' );
							?>
							" alt="avatar" width="50px" height="50px">
						</td>
						<td class="align-middle">
							<?php echo $row['firstname']; ?>
						</td>
						<td class="align-middle">
							<?php echo $row['username']; ?>
						</td>
						<td class="align-middle">
							<?php
							if ( $row['type'] == 1 ) {
								echo 'Administrator';
							} elseif ( $row['type'] == 2 ) {
								echo 'Cashier';
							} elseif ( $row['type'] == 3 ) {
								echo 'Kitchen Side';
							}
							?>
						</td>
						<td class="align-middle">

							<div class="dropdown">
								<button class="btn btn-sm btn-light dropdown-toggle px-4" type="button" data-bs-toggle="dropdown">
									Action
								</button>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item user_edit" href="./?page=user/manage_user&id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen-to-square" style="color: #0d6efd;"></i> Edit</a></li>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item user-delete" href="JavaScript:void(0)" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-trash" style="color: #dc3545;"></i> Delete</a></li> 
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
	$(document).ready(function(){
		$('.user-delete').click(function(){
			delete_modal("Are you sure to delete this user parmanently?", "delete_user", $(this).attr('data-id'));
		})
	})
	function delete_user($id){
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Users.php?f=delete",
			method: "POST",
			data: {id: $id},
			error: err => {
				console.log(err);
				alert("check console");
			},
			success: function(resp){
				if(resp == 1){
					end_loader();
					location.reload();
				}else{
					alert("error");
					
				}
			}
		})
	}
</script>
