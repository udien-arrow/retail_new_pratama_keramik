<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
$tabel = "am_katagori_dtl";
if ($_GET['jen']=='tambah')
{
	if($_POST['idreal']==''){
			$id=$db->idurut($tabel,"id_dtl");
			$data = array( 
					'id_dtl' => $id, 
					'id_am' => $_POST['kd'],
					'keterangan' => $_POST['ketr'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 1,
					);
			$exec= $db->insert($tabel, $data);	
			echo $_POST['kd'];
	}else{
		$data = array( 
					'keterangan' => $_POST['ketr'],
					);
			$exec= $db->update("am_katagori_dtl", $data,"id_dtl='$_POST[idreal]'");	
			echo $_POST['kd'];
	}
}
if ($_GET['jen']=='hapustmp')
{
		$cek=$db->select("am_katagori_dtl","*","id_dtl='$_POST[idreal]'");
		foreach($cek as $cak){}
		if($cak['status']==1){
			$ks=2;}else{$ks=1;}
			$data = array( 
					'status' => $ks,
					);
			$exec= $db->update("am_katagori_dtl", $data,"id_dtl='$_POST[idreal]'");	
			//echo $_POST['idreal'];
			echo $_POST['kd'];
}
if ($_GET['jen']=='simpan')
{
			
			$tmp=$db->select("am_katagori_tmp","*","id_am='$_POST[kd]' and id_user='$_SESSION[ID_LOGIN]'");
			foreach($tmp as $temp){
			$ids=$db->idurut("am_katagori_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $ids, 
					'id_am' => $_POST['kd'],
					'keterangan' => $temp['keterangan'],
					'id_user' => $temp['id_user'],
					);
			$exec= $db->insert("am_katagori_dtl", $data);
			$where = array("id_tmp" => $temp['id_tmp']);
			$db->delete("am_katagori_tmp",$where);
			}
			echo $_POST['kd'];
}


?>