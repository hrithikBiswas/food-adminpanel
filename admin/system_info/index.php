<section class="content text-dark">
	<div class="container-fluid">
		<div class="card mb-0 border-top border-warning" style="border-top-width: 3px !important;">
			<div class="card-header">
				<div class="card-title">System Information</div>
			</div>
			<div class="card-body">
				<form action="" id="system-form">
					<input type="hidden" name="id" value="">
					<div class="card-body">
						<div class="mb-3">
							<label for="firstname" class="form-label">System Name</label>
							<input type="text" class="form-control" name="name" id="firstname" value="">
						</div>
						<div class="mb-3">
							<label for="short_name" class="form-label">System Short Name</label>
							<input type="text" class="form-control" name="short_name" id="short_name" value="">
						</div>
						<div class="mb-3">
							<label for="img" class="form-label">System Logo</label>
							<input type="file" class="form-control" name="img" id="img" onChange="displayImg(this)">
						</div>
						<div class="mb-3 d-flex justify-content-center">
							<img id="cimg" src="<?php echo base_url . 'uploads/logo.png'; ?>" alt="avatar" class="img-fluid img-thumbnail rounded-circle"
								style="width:150px; height:150px;">
						</div>
						<div class="mb-3">
							<label for="img" class="form-label">Website Cover</label>
							<input type="file" class="form-control" name="img" id="img" onChange="displayImg(this)">
						</div>
						<div class="mb-3 d-flex justify-content-center">
							<img id="cimg2" src="<?php echo base_url . 'uploads/cover.png'; ?>" alt="avatar" class="img-fluid img-thumbnail bg-gradient-dark border-dark" style="height:50vh;width:100%;object-fit:contain;">
						</div>
					</div>
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
