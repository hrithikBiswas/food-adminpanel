<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct() {
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct() {
		parent::__destruct();
	}
	public function index() {
		echo 'see code';
	}
	public function login() {
		extract( $_POST );

		$sql       = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
		$result    = mysqli_query( $this->conn, $sql );
		$row_count = mysqli_num_rows( $result );
		if ( $row_count > 0 ) {
			foreach ( mysqli_fetch_assoc( $result ) as $k => $v ) {
				if ( ! is_numeric( $k ) && $k != 'password' ) {
					$this->settings->set_userdata( $k, $v );
				}
			}
			$this->settings->set_userdata( 'login_type', 1 );
			return json_encode( array( 'status' => 'success' ) );
		} else {
			return json_encode(
				array(
					'status'   => 'incorrect',
					'last_qry' => "SELECT * FROM users WHERE username = '$username' AND password = '$password'",
				)
			);
		}
	}
	public function logout() {
		if ( $this->settings->sess_des() ) {
			redirect( 'admin/login.php' );
		}
	}
}

$action = ! isset( $_GET['f'] ) ? 'none' : strtolower( $_GET['f'] );
$auth   = new Login();

switch ( $action ) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
	default:
		echo $auth->index();
		break;
}
