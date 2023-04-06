<?php
require_once( '../config.php' );
class Users extends DBConnection {
	private $settings;
	public function __construct() {
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct() {
		parent::__destruct();
	}
	public function save_users() {
		if ( empty( $_POST['password'] ) ) {
			unset( $_POST['password'] );
		} else {
			$_POST['password'] = $_POST['password'];
		}

		extract( $_POST );
		$data = '';
		foreach ( $_POST as $k => $v ) {
			if ( ! in_array( $k, array( 'id' ) ) ) {
				if ( ! empty( $data ) ) {
					$data .= ',';
				}
				$data .= "{$k} = '{$v}'";
			}
		}

		if ( empty( $id ) ) {
			// return 'id empty';
			$sql = mysqli_query( $this->conn, "INSERT INTO users SET {$data}" );
			if ( $sql ) {
				$id = mysqli_insert_id( $this->conn );
				$this->settings->set_flashdata( 'success', 'New user added successfully' );
				foreach ( $_POST as $k => $v ) {
					if ( $k != 'id' ) {
						if ( ! empty( $data ) ) {
							$data .= ' , ';
						}
						if ( $this->settings->userdata( 'id' ) == $id ) {
							$this->settings->set_userdata( $k, $v );
						}
					}
				}
				if ( ! empty( $_FILES['img']['tmp_name'] ) ) {
					if ( ! is_dir( base_app . 'uploads/avatars' ) ) {
						mkdir( base_app . 'uploads/avatars' );
					}
					$ext    = pathinfo( $_FILES['img']['name'], PATHINFO_EXTENSION );
					$fname  = "uploads/avatars/{$id}.png";
					$accept = array( 'image/png', 'image/jpeg' );
					if ( ! in_array( $_FILES['img']['type'], $accept ) ) {
						$err = 'The file type is invalid';
					}
					if ( $_FILES['img']['type'] == 'image/jpeg' ) {
						$uploadfile = imagecreatefromjpeg( $_FILES['img']['tmp_name'] );
					} elseif ( $_FILES['img']['type'] == 'image/png' ) {
						$uploadfile = imagecreatefrompng( $_FILES['img']['tmp_name'] );
					}
					if ( ! $uploadfile ) {
						$err = 'Image is invalid';
					}
					$temp = imagescale( $uploadfile, 200, 200 );
					if ( is_file( base_app . $fname ) ) {
						unlink( base_app . $fname );
					}
					$upload = imagepng( $temp, base_app . $fname );
					if ( $upload ) {
						mysqli_query( $this->conn, "UPDATE users SET avatar='{$fname}' WHERE id = '{$id}'" );
						if ( $this->settings->userdata( 'id' ) == $id ) {
							$this->settings->set_userdata( 'avatar', $name );
						}
					}
					imagedestroy( $temp );
				}
				return 1;
			} else {
				return 2;
			}
		} else {
			// return 'id ase';
			//Update existing user
			$qry               = "UPDATE users SET $data WHERE id = {$id}";
			$updated_user_info = mysqli_query( $this->conn, $qry );
			if ( $updated_user_info ) {
				$this->settings->set_flashdata( 'success', 'User details successfully updated.' );
				foreach ( $_POST as $k => $v ) {
					if ( $k != 'id' ) {
						if ( ! empty( $data ) ) {
							$data .= ',';
						}
						if ( $this->settings->userdata( 'id' ) == $id ) {
							$this->settings->set_userdata( $k, $v );
						}
					}
				}
				if ( ! empty( $_FILES['img']['tmp_name'] ) ) {
					if ( ! is_dir( base_app . 'uploads/avatars' ) ) {
						mkdir( base_app . 'uploads/avatars' );
					}

					$ext    = pathinfo( $_FILES['img']['name'], PATHINFO_EXTENSION );
					$fname  = "uploads/avatars/{$id}.png";
					$accept = array( 'image/jpeg', 'image/png' );
					if ( ! in_array( $_FILES['img']['type'], $accept ) ) {
						$err = 'The file type is invalid';
					}
					if ( $_FILES['img']['type'] == 'image/jpeg' ) {
						$uploadfile = imagecreatefromjpeg( $_FILES['img']['tmp_name'] );
					} elseif ( $_FILES['img']['type'] == 'image/png' ) {
						$uploadfile = imagecreatefrompng( $_FILES['img']['tmp_name'] );
					}
					if ( ! $uploadfile ) {
						$err = 'Image is invalid';
					}
					$temp = imagescale( $uploadfile, 200, 200 );
					if ( is_file( base_app . $fname ) ) {
						unlink( base_app . $fname );
					}
					$upload = imagepng( $temp, base_app . $fname );
					if ( $upload ) {
						mysqli_query( $this->conn, "UPDATE users SET avatar='{$fname}' WHERE id='{$id}'" );
						if ( $this->settings->userdata( 'id' ) == $id ) {
							$this->settings->set_userdata( 'avatar', $fname );
						}
					}
					imagedestroy( $temp );
				}
				return 1;
			} else {
				// return "UPDATE users SET $data WHERE id={$id}";
				return mysqli_error( $this->conn );
			}
		}

	}
	public function delete_user() {
		extract( $_POST );
		$delete = mysqli_query( $this->conn, "DELETE FROM users WHERE id = {$id}" );
		if ( $delete ) {
			$this->settings->set_flashdata( 'success', 'User deleted successfully' );
			if ( is_file( base_app . "uploads/avatars/{$id}.png" ) ) {
				unlink( base_app . "uploads/avatars/{$id}.png" );
			}
			return 1;
		} else {
			return false;
		}
	}
}

$users  = new Users();
$action = ! isset( $_GET['f'] ) ? 'none' : strtolower( $_GET['f'] );
switch ( $action ) {
	case 'save':
		echo $users->save_users();
		break;
	case 'delete':
		echo $users->delete_user();
		break;
	default:
		break;
}
