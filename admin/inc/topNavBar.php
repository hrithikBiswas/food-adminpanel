<nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-2 text-sm ">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo base_url; ?>admin" class="nav-link">Fast Food Ordering System - Admin</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- User Menu -->
		<li class="nav-item dropdown">
			<button
				class="d-flex justify-content-between btn-group align-items-center btn btn-white dropdown-toggle btn-rounded border-0 badge badge-light"
				type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
				<span>
					<img class="img-circle elevation-2 user-img" width="27px" src="<?php echo validate_image( isset( $_SESSION['userdata']['avatar'] ) ? $_SESSION['userdata']['avatar'] : '' ); ?>" alt="">
				</span>
				<span class="ml-2" style="font-size: 15px;"><?php echo $_SESSION['userdata']['firstname'] . ' ' . $_SESSION['userdata']['lastname']; ?></span>
			</button>
			<div class="dropdown-menu dropdown-menu-md-left py-2">
				<a href="<?php echo base_url . 'admin/?page=user'; ?>" class="dropdown-item">
					<span>
						<i class="fa-solid fa-user"></i> My Account
					</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="<?php echo base_url; ?>classes/Login.php?f=logout" class="dropdown-item">
					<span>
						<i class="fa-solid fa-right-from-bracket"></i> Logout
					</span>
				</a>
			</div>
		</li>
	</ul>
</nav>
