<?php require_once( '../../config.php' );

if ( isset( $_GET['id'] ) ) {
	$menu_sql    = "SELECT * FROM menu_list  WHERE id = {$_GET['id']} AND delete_flag = 0";
	$menu_result = mysqli_query( $conn, $menu_sql );
	$menu_row    = mysqli_fetch_assoc( $menu_result );
}
?>

<div class="container-fluid">
	<form class="row g-3" id="menu-form" action="" method="post">
		<input type="hidden" name="id" value="<?php echo isset( $menu_row['id'] ) ? $menu_row['id'] : ''; ?>">
		<div class="col-md-12">
			<label for="category_id" class="form-label">Category</label>
			<select id="category_id" name="category_id" class="form-select" required>
				<option value="" disabled <?php echo isset( $menu_row['category_id'] ) ? '' : 'selected'; ?>>Choose
					category</option>
				<?php
				$cat_sql        = 'SELECT * FROM category_list WHERE delete_flag = 0 AND status = 1 ORDER BY name ASC';
				$cat_sql_result = mysqli_query( $conn, $cat_sql );
				while ( $row = mysqli_fetch_assoc( $cat_sql_result ) ) :
					?>
				<option value="<?php echo $row['id']; ?>" 
										  <?php
											echo isset( $menu_row['category_id'] ) &&
											$menu_row['category_id'] == $row['id'] ? 'selected' : '';
											?>
					>
								<?php echo $row['name']; ?>
				</option>
							<?php endwhile; ?>
			</select>
		</div>
		<div class="col-md-12">
			<label for="code" class="form-label">Code</label>
			<input type="text" name="code" class="form-control" id="code"
				value="<?php echo isset( $menu_row['code'] ) ? $menu_row['code'] : ''; ?>" required>
		</div>
		<div class="col-12">
			<label for="name" class="form-label">Name</label>
			<input type="text" name="name" class="form-control" id="name"
				value="<?php echo isset( $menu_row['name'] ) ? $menu_row['name'] : ''; ?>" required>
		</div>
		<div class="col-12">
			<label for="price" class="form-label">Price</label>
			<input type="number" name="price" class="form-control" id="price"
				value="<?php echo isset( $menu_row['price'] ) ? $menu_row['price'] : ''; ?>" required>
		</div>
		<div class="col-md-12">
			<label for="description" class="form-label">Description</label>
			<textarea name="description" class="form-control" id="description" required><?php echo isset( $menu_row['description'] ) ? $menu_row['description'] : ''; ?></textarea>
		</div>
		<div class="col-md-12">
			<label for="status" class="form-label">Status</label>
			<select id="status" name="status" class="form-select">
				<option value="1" 
				<?php
				echo isset( $menu_row['status'] ) && $menu_row['status'] == 1 ? 'selected' : '';
				?>
					>Available</option>
				<option value="0" 
				<?php
				echo isset( $menu_row['status'] ) && $menu_row['status'] == 0 ? 'selected' : '';
				?>
					>Unavailable</option>
			</select>
		</div>
	</form>
</div>

<script>
	$(document).ready(function () {
		$('#menu-form').submit(function (e) {
			e.preventDefault();
			start_loader();
			if ($(".error-msg").length > 0) $(".error-msg").remove();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_menu",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				error: err => {
					console.log(err);
				},
				success: function (resp) {
					if (resp) {
						resp = JSON.parse(resp);
						if (resp.status == 'success') {
							end_loader();
							location.reload();
						} else if (resp.status == 'failed') {
							$("#menu-form").prepend("<div class='alert alert-danger error-msg' role='alert'>" + resp.msg + "</div>");
							end_loader();
						} else {
							console.log(resp);
						}
					}
				}
			})
		})

	})
</script>
