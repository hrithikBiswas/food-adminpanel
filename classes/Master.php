<?php
require_once( '../config.php' );
class Master extends DBConnection {
	private $settings;
	public function __construct() {
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct() {
		parent::__destruct();
	}
	public function save_category() {
		extract( $_POST );
		$data = '';
		foreach ( $_POST as $k => $v ) {
			if ( ! in_array( $k, array( 'id' ) ) ) {
				if ( ! empty( $data ) ) {
					$data .= ',';
				}
				$v     = mysqli_real_escape_string( $this->conn, trim( $v ) );
				$data .= "{$k} = '{$v}'";
			}
		}
		$check        = "SELECT * FROM category_list WHERE name = '{$name}'" . ( ! empty( $id ) ? " AND id != '{$id}'" : '' );
		$check_result = mysqli_query( $this->conn, $check );
		if ( mysqli_num_rows( $check_result ) > 0 ) {
			$resp['status'] = 'failed';
			$resp['msg']    = 'Category name already exists';
			return json_encode( $resp );
			exit;
		}
		if ( empty( $name ) || empty( $description ) ) {
			$resp['status'] = 'failed';
			$resp['msg']    = 'Category name or description can not be empty';
			return json_encode( $resp );
			exit;
		}
		if ( empty( $id ) && ! empty( $name ) && ! empty( $description ) ) {
			$sql = "INSERT INTO category_list SET {$data}";
		} elseif ( ! empty( $id ) && ! empty( $name ) && ! empty( $description ) ) {
			$sql = "UPDATE category_list SET {$data} WHERE id = {$id}";
		}
		$save = mysqli_query( $this->conn, $sql );
		if ( $save ) {
			$resp['status'] = 'success';
			if ( empty( $id ) ) {
				$resp['msg'] = 'New category successfully created';
			} else {
				$resp['msg'] = 'Category updated successfully';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['err']    = mysqli_error( $this->conn );
		}
		if ( $resp['status'] == 'success' ) {
			$this->settings->set_flashdata( 'success', $resp['msg'] );
		}
		return json_encode( $resp );
	}
	public function delete_category() {
		extract( $_POST );
		$sql  = "UPDATE category_list SET delete_flag = 1 WHERE id = {$id}";
		$save = mysqli_query( $this->conn, $sql );
		if ( $save ) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata( 'success', 'Category deleted successfully' );
		} else {
			$resp['status'] = 'failed';
			$resp['error']  = 'Error occurred while deleting category';
		}
		return json_encode( $resp );
	}
	public function save_menu() {
		extract( $_POST );
		$data = '';
		foreach ( $_POST as $k => $v ) {
			if ( ! empty( $data ) ) {
				$data .= ',';
			}
			$v     = htmlspecialchars( mysqli_real_escape_string( $this->conn, trim( $v ) ) );
			$data .= "{$k} = '{$v}'";
		}
		$check        = "SELECT * FROM menu_list WHERE code = '{$code}' AND delete_flag = 0" . ( ! empty( $id ) ? " AND id != '{$id}'" : '' );
		$check_result = mysqli_query( $this->conn, $check );
		if ( mysqli_num_rows( $check_result ) > 0 ) {
			$resp['status'] = 'failed';
			$resp['msg']    = 'Menu code already exists';
			return json_encode( $resp );
			exit;
		}
		if ( empty( $category_id ) || empty( $code ) || empty( $name ) || empty( $price ) || empty( $description ) ) {
			$resp['status'] = 'failed';
			$resp['msg']    = 'All fields are required!';
			return json_encode( $resp );
			exit;
		}
		if ( empty( $id ) && ! empty( $category_id ) && ! empty( $code ) && ! empty( $name ) && ! empty( $price ) && ! empty( $description ) ) {
			$sql = "INSERT INTO menu_list SET {$data}";
		} else {
			$sql = "UPDATE menu_list SET {$data} WHERE id = $id";
		}
		$save = mysqli_query( $this->conn, $sql );
		if ( $save ) {
			$resp['status'] = 'success';
			if ( empty( $id ) ) {
				$resp['msg'] = 'New menu successfully added';
			} else {
				$resp['msg'] = 'Menu updated successfully';
			}
		} else {
			$resp['status'] = 'failed';
			$resp['err']    = mysqli_error( $this->conn );
		}
		if ( $resp['status'] == 'success' ) {
			$this->settings->set_flashdata( 'success', $resp['msg'] );
		}
		return json_encode( $resp );
	}
	public function delete_menu() {
		extract( $_POST );
		$sql    = "UPDATE menu_list SET delete_flag = 1 WHERE id = {$id}";
		$result = mysqli_query( $this->conn, $sql );
		if ( $result ) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata( 'success', 'Menu deleted successfully' );
		} else {
			$resp['status'] = 'failed';
			$resp['err']    = mysqi_error( $this->conn );
		}
		return json_encode( $resp );
	}
	public function place_order() {
		$prefix = date( 'Ymd' );
		$code   = sprintf( "%'.05d", 1 );
		while ( true ) {
			$check    = mysqli_query( $this->conn, "SELECT * FROM order_list WHERE code = '{$prefix}{$code}'" );
			$num_rows = mysqli_num_rows( $check );
			if ( $num_rows > 0 ) {
				$code = sprintf( "%'.05d", abs( $code ) + 1 );
			} else {
				$_POST['code']  = $prefix . $code;
				$_POST['queue'] = $code;
				break;
			}
		}
		$_POST['user_id'] = $this->settings->userdata( 'id' );
		extract( $_POST );
		$order_fields = array( 'code', 'queue', 'total_amount', 'tendered_amount', 'user_id' );
		$data         = '';
		foreach ( $_POST as $k => $v ) {
			if ( in_array( $k, $order_fields ) && ! is_array( $_POST[ $k ] ) ) {
				$v = htmlspecialchars( mysqli_real_escape_string( $this->conn, trim( $v ) ) );
				if ( ! empty( $data ) ) {
					$data .= ', ';
				}
				$data .= "{$k} = '{$v}'";
			}
		}

		$sql  = "INSERT INTO order_list SET {$data}";
		$save = mysqli_query( $this->conn, $sql );
		if ( $save ) {
			$oid         = mysqli_insert_id( $this->conn );
			$resp['oid'] = $oid;
			$data        = '';
			foreach ( $menu_id as $k => $v ) {
				if ( ! empty( $data ) ) {
					$data .= ', ';
				}
				$data .= "('{$oid}', '{$menu_id[$k]}', '{$price[$k]}', '{$quantity[$k]}')";
			}
			$sql2  = "INSERT INTO order_items (order_id, menu_id, price, quantity) VALUES {$data} ";
			$save2 = mysqli_query( $this->conn, $sql2 );
			if ( $save2 ) {
				$resp['status'] = 'success';
				$this->settings->set_flashdata( 'success', 'Order has been placed successfully' );
			} else {
				$resp[ status ] = 'failed';
				$resp['msg']    = 'Order has failed to save due to some reason.';
				$resp['err']    = mysqli_error( $this->conn );
				$resp['sql']    = $sql;
			}
			return json_encode( $resp );
		}
	}
	function serve_order() {
		extract( $_POST );
		$sql    = "UPDATE order_list SET status = 1 WHERE id = {$id}";
		$result = mysqli_query( $this->conn, $sql );
		if ( $result ) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata( 'success', 'Order has been served successfully' );
		} else {
			$resp['status'] = 'failed';
			$resp['msg']    = mysqli_error( $this->conn );
		}
		return json_encode( $resp );

	}
	function delete_order() {
		extract( $_POST );
		$delete_order = mysqli_query( $this->conn, "DELETE order_list, order_items FROM order_list INNER JOIN order_items ON order_list.id = order_items.order_id  WHERE order_list.id = {$id}" );
		if ( $delete_order ) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata( 'success', 'Order has been deleted successfully' );
		} else {
			$resp['status'] = 'failed';
			$resp['msg']    = mysqi_error( $this->conn );
		}
		return json_encode( $resp );
	}
}

$Master = new Master();
$action = ! isset( $_GET['f'] ) ? 'none' : strtolower( $_GET['f'] );

switch ( $action ) {
	case 'save_category':
		echo $Master->save_category();
		break;
	case 'delete_category':
		echo $Master->delete_category();
		break;
	case 'save_menu':
		echo $Master->save_menu();
		break;
	case 'delete_menu':
		echo $Master->delete_menu();
		break;
	case 'place_order':
		echo $Master->place_order();
		break;
	case 'serve_order':
		echo $Master->serve_order();
		break;
	case 'delete_order':
		echo $Master->delete_order();
		break;
	default:
		break;
}
