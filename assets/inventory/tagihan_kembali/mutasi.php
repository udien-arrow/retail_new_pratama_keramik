<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	$bln=date("m");
	$thn=date("Y");
	$god=$_GET['gudang'];
	$mutasi=$db->cek_mutasi($_GET['id'],$god);
	if($mutasi['akhir']==''){
		$mutasi['akhir']=0;
	}else{
		$mutasi['akhir']=$mutasi['akhir'];
		}
	
	echo "<script>$('#stok_sys$_GET[id]').val('$mutasi[akhir]');</script>";
	//echo $mutasi['akhir'];

?>
