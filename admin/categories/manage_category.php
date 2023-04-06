<?php
require_once( '../../config.php' );
if ( isset( $_GET['id'] ) ) {
	$sql    = "SELECT * FROM category_list WHERE id = {$_GET['id']}";
	$result = mysqli_query( $conn, $sql );
	$row    = mysqli_fetch_assoc( $result );
}


?>
<div class="container-fluid">
  <form class="row g-3" action="" id="category-form">
	<input type="hidden" name="id" value="<?php echo isset( $row['id'] ) ? $row['id'] : ''; ?>">
	<div class="col-md-12">
	  <label for="name" class="form-label">Name</label>
	  <input type="text" name="name" class="form-control" id="name" value="<?php echo isset( $row['name'] ) ? $row['name'] : ''; ?>">
	</div>
	<div class="col-md-12">
	  <label for="description" class="form-label">Description</label>
	  <textarea class="form-control" name="description" id="description"><?php echo isset( $row['description'] ) ? $row['description'] : ''; ?></textarea>
	</div>
	<div class="col-md-12">
	  <label for="inputStatus" class="form-label">Status</label>
	  <select id="inputStatus" name="status" class="form-select">
		<option value="1" <?php echo isset( $row['status'] ) && $row['status'] == 1 ? 'selected' : ''; ?>>Active</option>
		<option value="0" <?php echo isset( $row['status'] ) && $row['status'] == 0 ? 'selected' : ''; ?>>Inactive</option>
	  </select>
	</div>
	
  </form>
</div>

<script>
  $(document).ready(function(){
	$('#category-form').submit(function(e){
	  e.preventDefault();
	  start_loader();
	  if($(".error-msg").length > 0) $(".error-msg").remove();
	  $.ajax({
		url: _base_url_ + "classes/Master.php?f=save_category",
		data: new FormData($(this)[0]),
		cache: false,
		contentType: false,
		processData: false,
		method: 'POST',
		type: 'POST',
		error: err=>{
		  console.log(err);
		  alert("An error occurred!");
		},
		success: function(resp){
		  if(resp){
			resp = JSON.parse(resp);
			if(resp.status=='success'){
			  end_loader();
			  location.reload();
			}else if(resp.status == 'failed'){
			  $("#category-form").prepend("<div class='alert alert-danger error-msg' role='alert'>" + resp.msg + "</div>");
			  end_loader();
			}
		  }
		  
		}
	  })  
	})
  })
</script>
