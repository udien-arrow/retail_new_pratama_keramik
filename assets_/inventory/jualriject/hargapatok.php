<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	$skr=date("Y-m-d");
	$sql=$db->select("m_pricelist_jual a 
		left join m_pricelist_jual_dtl b on a.id_price=b.id_price
		","b.harga,b.sat","a.tgl_berlaku<='$skr' and a.status='1' and b.id_barang='$_GET[id]' and a.id_cabang='$_SESSION[ID_CABANG]' order by a.tgl_berlaku desc limit 0,1");

	foreach($sql as $vl){}
	echo number_format($vl['harga']);

?>
