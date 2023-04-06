<?php
if ( ! class_exists( 'DBConnection' ) ) {
	require_once( '../config.php' );
	require_once( 'DBConnection.php' );
}
class SystemSettings extends DBConnection {
	public function __construct() {
		parent::__construct();
	}
	public function __destruct() {
		// parent::__destruct();
	}
	public function set_userdata( $field = '', $value = '' ) {
		if ( ! empty( $field ) && ! empty( $value ) ) {
			$_SESSION['userdata'][ $field ] = $value;
		}
	}
	public function userdata( $field = '' ) {
		if ( ! empty( $field ) ) {
			if ( isset( $_SESSION['userdata'][ $field ] ) ) {
				return $_SESSION['userdata'][ $field ];
			} else {
				return null;
			}
		} else {
			false;
		}
	}
	public function set_flashdata( $field = '', $value = '' ) {
		if ( ! empty( $field ) && ! empty( $value ) ) {
			$_SESSION['flashdata'][ $field ] = $value;
			return true;
		}
	}
	public function check_flashdata( $field = '' ) {
		if ( isset( $_SESSION['flashdata'][ $field ] ) ) {
			return true;
		} else {
			return false;
		}
	}
	public function flashdata( $field = '' ) {
		if ( ! empty( $field ) ) {
				$_tmp = $_SESSION['flashdata'][ $field ];
				unset( $_SESSION['flashdata'] );
				return $_tmp;
		} else {
			return false;
		}
	}
	public function sess_des() {
		if ( isset( $_SESSION['userdata'] ) ) {
			unset( $_SESSION['userdata'] );
			return true;
		}
		return true;
	}
}

$_settings = new SystemSettings();
