<aside class="main-sidebar sidebar-light-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url; ?>" class="brand-link bg-warning">
		<img src="../uploads/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			style="opacity: .8">
		<span class="brand-text text-white font-weight-light">FFOS - PHP</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar px-0">
		<!-- Sidebar Menu -->
		<nav class="mt-0">
			<ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
			 with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="<?php echo base_url; ?>" class="nav-link nav-home">
						<i class="nav-icon fa-solid fa-house"></i>
						<p class="">
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url . 'admin/?page=sale/manage_sale'; ?>" class="nav-link nav-sale_manage_sale">
						<i class="nav-icon fa-solid fa-cash-register"></i>
						<p>
							Pos
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url . 'admin/?page=orders'; ?>" class="nav-link nav-orders">
						<i class="nav-icon fa-solid fa-list"></i>
						<p>
							Order List
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="./?page=kitchen" class="nav-link nav-kitchen">
						<i class="nav-icon fa-solid fa-table"></i>
						<p>
							Kitchen Side
						</p>
					</a>
				</li>
				<li class="nav-header">Master List</li>
				<li class="nav-item">
					<a href="./?page=categories" class="nav-link nav-categories">
						<i class="nav-icon fa-solid fa-list"></i>
						<p>
							Category List
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="./?page=menus" class="nav-link nav-menus">
						<i class="nav-icon fa-solid fa-burger"></i>
						<p>
							Menu List
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fa-sharp fa-solid fa-file-lines"></i>
						<p>
							Reports
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview" style="display: none;">
						<li class="nav-item">
							<a href="./?page=reports" class="nav-link">
								<i class="far fa-circle nav-icon nav-reports"></i>
								<p>Daily Sales Report</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-header">Maintenance</li>
				<li class="nav-item">
					<a href="<?php echo base_url . 'admin/?page=user/list'; ?>" class="nav-link nav-user_list">
						<i class="nav-icon fa-solid fa-users-gear"></i>
						<p>User List</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url . 'admin/?page=system_info'; ?>" class="nav-link nav-system_info">
						<i class="nav-icon fa-solid fa-screwdriver-wrench"></i>
						<p>Syetem Informaation</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
<script>
	$(document).ready(function(){
		var page ="<?php echo isset( $_GET['page'] ) ? $_GET['page'] : 'home'; ?>";
		page = page.replace(/\//g, "_");
		var getClassName = $('.nav-'+page).attr('class');
		var classArr = getClassName.split(" ");
		if(classArr.includes("nav-"+page)){
			$('.nav-link.nav-'+page).addClass('bg-warning');
			$('.nav-link.nav-'+page+' i, .nav-link.nav-'+page+' p').addClass('text-white');
		}else{
			$('.nav-link.nav-'+page).removeClass('bg-warning')
			$('.nav-link.nav-'+page+' i, .nav-link.nav-'+page+' p').removeClass('text-white');
		}
	});
</script>
