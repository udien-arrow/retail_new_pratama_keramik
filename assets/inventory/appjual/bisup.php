<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	foreach($db->select("m_biayasupir a join m_barang b on a.id_barang=b.id_barang","a.biaya,ifnull(b.berat,0)as berat","a.id_barang='$_GET[bar]' and a.id_cabang='$_SESSION[ID_CABANG]'") as $kol);
	
	echo $kol['biaya']*$kol['berat']*$_GET['qty'];
?>
		
