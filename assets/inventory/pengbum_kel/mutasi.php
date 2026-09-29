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
	
	echo $mutasi['akhir'];

?>
