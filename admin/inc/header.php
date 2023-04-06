<?php require_once( 'sess_auth.php' ); ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Food - Admin Dashboard</title>
  <!-- FAVICON -->
  <link rel="shortcut icon" href="<?php echo base_url; ?>uploads/favicon.png" type="image/x-icon">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?php echo base_url; ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- Bootstrap-5 -->
  <link rel="stylesheet" href="<?php echo base_url; ?>node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url; ?>node_modules/admin-lte/dist/css/adminlte.min.css">
  <!-- Data Table  -->
  <link rel="stylesheet"
	href="<?php echo base_url; ?>node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url; ?>node_modules/sweetalert2/dist/sweetalert2.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url; ?>dist/style/main.css">
  <script>
	var _base_url_ = '<?php echo base_url; ?>';
  </script>
  <!-- jQuery -->
  <script src="<?php echo base_url; ?>node_modules/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url; ?>dist/js/script.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url; ?>node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <style>
	aside .sidebar .nav-link {
	  width: initial !important;
	  margin-bottom: 0 !important;
	}

	#system-cover {
	  width: 100%;
	  height: 45em;
	  object-fit: cover;
	  object-position: center center;
	}
  </style>
</head>
