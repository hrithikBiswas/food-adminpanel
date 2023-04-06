<?php
ob_start();
ini_set( 'date.timezone', 'Asia/Dhaka' );
date_default_timezone_set( 'Asia/Dhaka' );
session_start();

require_once( 'initialize.php' );
require_once( 'classes/DBConnection.php' );
require_once( 'classes/SystemSettings.php' );

$db   = new DBConnection;
$conn = $db->conn;

function redirect( $url = '' ) {
	if ( ! empty( $url ) ) {
		echo '<script>location.href ="' . base_url . $url . '"</script>';
	}
}
function validate_image( $file ) {
	if ( ! empty( $file ) ) {
		$ext  = explode( '?', $file );
		$file = $ext[0];
		$ts   = isset( $ext[1] ) ? $ext[1] : '';
		if ( is_file( base_app . $file ) ) {
			return base_url . $file . $ts;
		}
	}
}

