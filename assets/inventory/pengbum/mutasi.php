<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	$bln=date("m");
	$thn=date("Y");
	
	$mutasi=$db->cek_mutasi($_GET['id'],$_GET['gud']);
	if($mutasi['akhir']==''){
		$mutasi['akhir']=0;
	}else{
		$mutasi['akhir']=$mutasi['akhir'];
		}
	$s=$db->select("tx_pengbum_tmp","*","id_barang='$_GET[id]' and id_gudang='$_GET[gud]' and id_user='$_SESSION[ID_LOGIN]'");
	foreach($s as $w){}
	$ak=$mutasi['akhir']-$w['qty'];
	echo $ak;

?>
