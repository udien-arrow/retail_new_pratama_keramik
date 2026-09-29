<?php
	error_reporting(0);
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
	
	$jum=$db->select("m_konversi","*","id_barang='$_GET[id]' and def=1");
	$jumi=count($jum);
	
	if($jumi==0){
		echo $mutasi['akhir'];
	}else{
		foreach($jum as $val){}
		
		echo $mutasi['akhir']/$val['konv'];
	}
	//echo $mutasi['akhir'];

?>
