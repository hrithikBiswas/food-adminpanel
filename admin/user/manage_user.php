<?php
if ( isset( $_GET['id'] ) ) {
	$user = mysqli_query( $conn, "SELECT * FROM users WHERE id = '{$_GET['id']}'" );
	$row  = mysqli_fetch_assoc( $user );
}
?>
<?php if ( $_settings->check_flashdata( 'success' ) ) : ?>
<script>
	alert_toast("<?php echo $_settings->flashdata( 'success' ); ?>", "success");
</script>
<?php endif; ?>
<section class="content text-dark">
	<div class="container-fluid">
		<div class="card mb-0 border-top border-warning" style="border-top-width: 3px !important;">
			<form action="" id="manage-user-form" method="post" enctype="multipart/form-data">
				<div id="msg"></div>
				<input type="hidden" name="id" value="<?php echo isset( $row['id'] ) ? $row['id'] : ''; ?>">
				<div class="card-body">
					<div class="mb-3">
						<label for="firstname" class="form-label">First Name</label>
						<input type="text" class="form-control" name="firstname" id="firstname"
							value="<?php echo isset( $row['firstname'] ) ? $row['firstname'] : ''; ?>">
					</div>
					<div class="mb-3">
						<label for="middlename" class="form-label">Middle Name</label>
						<input type="text" class="form-control" name="middlename" id="middlename"
							value="<?php echo isset( $row['middlename'] ) ? $row['middlename'] : ''; ?>">
					</div>
					<div class="mb-3">
						<label for="lastname" class="form-label">Last Name</label>
						<input type="text" class="form-control" name="lastname" id="lastname"
							value="<?php echo isset( $row['lastname'] ) ? $row['lastname'] : ''; ?>">
					</div>
					<div class="mb-3">
						<label for="username" class="form-label">User Name</label>
						<input type="text" class="form-control" name="username" id="username"
							value="<?php echo isset( $row['username'] ) ? $row['username'] : ''; ?>">
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" name="password" id="password" value="">
					</div>
					<div class="mb-3">
						<label for="type" class="form-label">Type</label>
						<select name="type" id="type" class="form-control">
							<option value="1" <?php echo isset( $row['type'] ) && $row['type'] == 1 ? 'selected' : ''; ?>>Administrator</option>
							<option value="2" <?php echo isset( $row['type'] ) && $row['type'] == 2 ? 'selected' : ''; ?>>Chashier</option>
							<option value="3" <?php echo isset( $row['type'] ) && $row['type'] == 3 ? 'selected' : ''; ?>>Kitchen Side</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="img" class="form-label">Avatar</label>
						<input type="file" class="form-control" name="img" id="img" onChange="displayImg(this)">
					</div>
					<div class="mb-3 d-flex justify-content-center">
						<img id="cimg" src="<?php echo base_url . ( isset( $row['avatar'] ) ? $row['avatar'] : 'uploads/logo.png' ); ?>" alt="avatar" class="img-fluid img-thumbnail rounded-circle"
							style="width:150px; height:150px;">
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</section>
<script>
	function displayImg(input){
		if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload =function(e){
				$('#cimg').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(document).ready(function(){
		$("#manage-user-form").submit(function(e){
			e.preventDefault();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Users.php?f=save",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: "POST",
				type: "POST",
				error: err => {
					console.log(err);
					alert("Check console");
				},
				success: function(resp){
					if(resp ==1){
					location.href='./?page=user/list'
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
				}
			})
		})
	})

</script>
