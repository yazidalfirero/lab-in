<?php
require_once('../config.php');

	$hasil=$_POST['hasil'];
	$result['pesan']="";

	if ($hasil=="") {
		$result['pesan']="hasil harus diisi";
	}else{
		$queryResult = $connect->query("UPDATE `transaction_items` set `hasil` = '$hasil' WHERE `transaction_items`.`id` = 1 ");

		if ($queryResult) {
			$result['pesan']="hasil berhasil ditambah";
		}else{
			$result['pesan']="hasil gagal ditambah";
		}
	}

	echo json_encode($result);
?>