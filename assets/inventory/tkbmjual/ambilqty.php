<?php
	require( '../../../webclass.php' );
	error_reporting(0);
	$db=new kelas;
	$tgla= date("Y-m-d");
	$tglb=date('Y-m-d', strtotime('+2 days'));
	
	$exp=explode("_",$_GET['no']);
	
	$sat=$db->select("tx_tkbm_pembelian_dtl","qty","id_tkbm_b='$exp[1]' and id_jenis_kendaraan='$exp[2]' and id_barang='$_GET[bar]'");
	foreach($sat as $va){}
	
	$sat2=$db->select("tx_tkbm_penjualan_dtl","sum(qty)as qty","no_masuk='$exp[0]' and id_jenis_kendaraan='$exp[2]' and id_barang='$_GET[bar]'");
	foreach($sat2 as $va2){}
	
	echo $va['qty']-$va2['qty'];
	

?>
