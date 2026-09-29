<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	$bln=date("m");
	$thn=date("Y");
	
	$mutasi=$db->cek_mutasi($bln,$thn,$_GET['id'],$_GET['gud']);
	echo $mutasi['akhir'];

?>
