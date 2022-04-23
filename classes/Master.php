<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = 'Category Name already exists.';

		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Category has successfully added.";
				else
					$resp['msg'] = "Category details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `category_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Category has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_price(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `price_list` set {$data} ";
		}else{
			$sql = "UPDATE `price_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `price_list` where `size` = '{$size}' and `category_id` = '{$category_id}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = ' Size already exists on the selected category.';

		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = " Price has successfully added.";
				else
					$resp['msg'] = " Price details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_price(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `price_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Price has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_transaction(){
		if(empty($_POST['id'])){
			$pref = date('m');
			$code = sprintf("%'.05d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM `transaction_list` where `code` = '{$pref}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.05d",abs($code) + 1);
				}else{
					break;
				}
			}
			$_POST['code'] = $pref.$code;
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(in_array($k,array('discount_id','code','client_name','client_age','client_gender','client_contact','client_address','sender','sender_name','total_amount','paid_amount','balance','payment_status','status'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}


		if(empty($id)){
			$sql = "INSERT INTO `transaction_list` set {$data} ";
		}else{
			$sql = "UPDATE `transaction_list` set {$data} where id = '{$id}' ";
		}

		$save = $this->conn->query($sql);
		// print_r($save);
		if($save){
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			$resp['msg'] = 'Transaction has successfully added.';
			$total = 0;
			$this->conn->query("DELETE FROM `transaction_items` where transaction_id = '{$tid}'");
			$data = "";
			$i = 0;

			foreach($price_id as $k => $v){
				$paket = $this->conn->query("SELECT p.*,pl.* from paket as p inner join `price_list` as pl on p.price_id = pl.id where  p.price_paket = {$v} ");

 				if($paket->num_rows > 0){
					$total += $this->conn->query("SELECT price from price_list where id = {$v}")->fetch_assoc()['price'] * 1;
					foreach ($paket as $value) {
						// print_r($value);
						if(!empty($data)) $data .=", ";
						$priceId = $value['price_id'];
						$pr = $value['price'];
						//$data += "('{$tid}','{$value['price_id']}','{$value['price']}',1,{$value['price']})";
						$data .= "('{$tid}','{$priceId}','{$v}',0,'{$pr}',1,'{$pr}')";

					}
				}
				else{

				if(!empty($data)) $data .=", ";
				$_total = $price[$k] * $quantity[$k];
				$total += $_total;
				// var_dump($price[$k]);
				$data .= "('{$tid}','{$v}',NULL,'0','{$price[$k]}','{$quantity[$k]}','{$_total}')";

			}


				// if($i == 1)
					// var_dump($data_mass);
			}
			// for ($i=0; $i < count($price_id); $i++) {
			// 	# code...
			// }

			// print_r($data_bulk);


			//print_r($data);

			//print_r($data_bulk);

			// if(empty($data_bulk)){
				$sql2 = "INSERT INTO `transaction_items` (`transaction_id`,`price_id`,`paket_price_id`,`hasil`,`price`,`quantity`,`total`) VALUES {$data}";
			// }

			//print_r($sql2);
	// print_r($total);
			$save2= false;
			if(isset($sql2))
			$save2 = $this->conn->query($sql2);
			// if($_POST['discount_id'])
			// {
				if(isset($discount_id))
				{
					$discount = $this->conn->query("SELECT * from `discount` where id = '{$discount_id}' ")->fetch_array();
					if($discount['jenis_discount'] == "persen")
						$total = $total - ($total * $discount['jumlah_discount']/100);
					else
						$total -= $discount['jumlah_discount'];
				}
			// }
			if($save2){
				$this->conn->query("UPDATE `transaction_list` set total_amount = '{$total}' where id = '{$tid}'");
				if(isset($amount)){
					if(empty($id))
						$save3 = $this->conn->query("INSERT INTO payment_history (`transaction_id`,`amount`) VALUES ('{$tid}','{$amount}')");
					else{
						$save3 = $this->conn->query("UPDATE payment_history set `amount` = '{$amount}' where transaction_id = '{$tid}' order by unix_timestamp(date_created) asc limit 1");
					}
					if($save3){
						$total_paid = $this->conn->query("SELECT SUM(amount) from payment_history where transaction_id = '{$tid}'")->fetch_array()[0];
						$total_paid = $total_paid > 0 ? $total_paid : 0;
						$pstatus = $total_paid > 0 ? ($total_paid == $total) ? 2 : 1 : 0;
						$balance = $total - $total_paid;
						$this->conn->query("UPDATE `transaction_list` set paid_amount = '{$total_paid}', payment_status = '{$pstatus}', `balance` ='{$balance}' where id = '{$tid}'");
						if(empty($id))
							$resp['msg'] = " Transaction has successfully added.";
						else
							$resp['msg'] = " Transaction details has been updated successfully.";
					}else{
						$resp['status'] = 'failed';
						$resp['msg'] = " Transaction Items has failed to save.";
						$resp['err'] = $this->conn->error;
						if(empty($id))
							$this->conn->query("DELETE FROM `transaction_list` where id = '{$tid}' ");
					}
				}

			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = " Transaction Items has failed to save.";
				$resp['err'] = $this->conn->error."[{$sql2}]";
				if(empty($id))
					$this->conn->query("DELETE FROM `transaction_list` where id = '{$tid}' ");
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_transaction(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `transaction_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Transaction has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_payment(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `payment_history` set {$data} ";
		}else{
			$sql = "UPDATE `payment_history` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = " Payment has successfully added.";
			else
				$resp['msg'] = " Payment details has been updated successfully.";
			$total = $this->conn->query("SELECT total_amount FROM `transaction_list` where id = '{$transaction_id}'")->fetch_array()[0];
			$total = $total > 0 ? $total : 0;
			$total_paid = $this->conn->query("SELECT SUM(amount) from payment_history where transaction_id = '{$transaction_id}'")->fetch_array()[0];
			$total_paid = $total_paid > 0 ? $total_paid : 0;
			$pstatus = $total_paid > 0 ? ($total_paid == $total) ? 2 : 1 : 0;
			$balance = $total - $total_paid;
			$this->conn->query("UPDATE `transaction_list` set paid_amount = '{$total_paid}', payment_status = '{$pstatus}', `balance` ='{$balance}' where id = '{$transaction_id}'");
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_payment(){
		extract($_POST);
		$get = $this->conn->query("SELECT * FROM `payment_history` where id = '{$id}'");
		if($get->num_rows > 0){
			$res = $get->fetch_array();
		}
		$del = $this->conn->query("DELETE FROM `payment_history` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Payment has been deleted successfully.");
			if(isset($res['transaction_id'])){
				$total = $this->conn->query("SELECT total_amount FROM `transaction_list` where id = '{$res['transaction_id']}'")->fetch_array()[0];
				$total = $total > 0 ? $total : 0;
				$total_paid = $this->conn->query("SELECT SUM(amount) from payment_history where transaction_id = '{$res['transaction_id']}'")->fetch_array()[0];
				$total_paid = $total_paid > 0 ? $total_paid : 0;
				$pstatus = $total_paid > 0 ? ($total_paid == $total) ? 2 : 1 : 0;
				$balance = $total - $total_paid;
				$this->conn->query("UPDATE `transaction_list` set paid_amount = '{$total_paid}', payment_status = '{$pstatus}', `balance` ='{$balance}' where id = '{$res['transaction_id']}'");
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_transaction_status(){
		extract($_POST);

		$update = $this->conn->query("UPDATE `transaction_list` set status = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Transaction's Status has been updated successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function update_transaction_result(){
		extract($_POST);
		//print_r($_POST['hasil'][0]['value']);

		for ($i=0; $i < count($_POST['hasil']); $i++) {
			$result = $this->conn->query("UPDATE `transaction_items` SET `hasil` = '{$_POST['hasil'][$i]['value']}' WHERE `transaction_id` = '{$_POST['transaction_id'][$i]['value']}' AND  `price_id` = '{$_POST['price_id'][$i]['value']}'");
		}
		if($result){
			$resp['status'] = 'success';
			// $this->settings->set_flashdata('success'," Transaction's Status has been updated successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function transaction_sperm_add(){
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		// print_r($_POST);
		if($_POST['id'] == 'null')
		{
			$id = null;
		}
		else{
			$id = $_POST['id'];
		}
		$data .=", `date_created`=". "'".date('Y-m-d H:i:s'). "'";
		print_r($data);
		if($id == null){
			$sql = "INSERT INTO `sperm_transaction` set {$data} ";
		}else{
			$sql = "UPDATE `sperm_transaction` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = 'Category Name already exists.';

		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Category has successfully added.";
				else
					$resp['msg'] = "Category details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}

	function transaction_sperm_delete(){
		extract($_POST);
		$id = $_GET['id'];
		$get = $this->conn->query("SELECT * FROM `sperm_transaction` where id = '{$id}'");
		if($get->num_rows > 0){
			$res = $get->fetch_array();
		}
		$del = $this->conn->query("DELETE FROM `sperm_transaction` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';

		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		header("location: ../admin/?page=transactions/index_sperma");
	}

	function discount_add()
	{
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		// print_r($_POST);
		if($_POST['id'] == 'null')
		{
			$id = null;
		}
		else{
			$id = $_POST['id'];
		}
		$data .=", `date_created`=". "'".date('Y-m-d H:i:s'). "'";
		//print_r($data);
		if($id == null){
			$sql = "INSERT INTO `discount` set {$data} ";
		}else{
			$sql = "UPDATE `discount` set {$data} where id = '{$id}' ";
		}
		//$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;

			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Discount has successfully added.";
				else
					$resp['msg'] = "Discount details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}

		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}

	function discount_delete()
	{
		extract($_POST);
		$id = $_GET['id'];
		$get = $this->conn->query("SELECT * FROM `discount` where id = '{$id}'");
		if($get->num_rows > 0){
			$res = $get->fetch_array();
		}
		$del = $this->conn->query("DELETE FROM `discount` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';

		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		header("location: ../admin/?page=discount/view_discount");
	}

}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_price':
		echo $Master->save_price();
	break;
	case 'delete_price':
		echo $Master->delete_price();
	break;
	case 'save_transaction':
		echo $Master->save_transaction();
	break;
	case 'delete_transaction':
		echo $Master->delete_transaction();
	break;
	case 'save_payment':
		echo $Master->save_payment();
	break;
	case 'delete_payment':
		echo $Master->delete_payment();
	break;
	case 'update_transaction_status':
		echo $Master->update_transaction_status();
	break;
	case 'update_transaction_result':
		echo $Master->update_transaction_result();
	break;
	case 'transaction_sperm_add':
		echo $Master->transaction_sperm_add();
	break;
	case 'transaction_sperm_edit':
		echo $Master->transaction_sperm_edit();
	break;
	case 'transaction_sperm_delete':
		echo $Master->transaction_sperm_delete();
	break;
	case 'discount_add':
		echo $Master->discount_add();
	break;
	case 'discount_delete':
		echo $Master->discount_delete();
	break;
	default:
		// echo $sysset->index();
		break;
}
