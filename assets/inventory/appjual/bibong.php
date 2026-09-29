<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
		$expl=explode("_",$_GET['cus']);
		$skr=date("Y-m-d");
		/*$kon=$db->select("m_retribusi","*");
		foreach($kon as $d){  
			foreach($db->select("m_biaya_retribusi a left join m_biaya_retribusi_dtl b on a.id_biaya=b.id_biaya","b.nilai","b.tgl_berlaku<='$skr' and b.id_retribusi='$d[id_retribusi]' and a.id_cus='$expl[0]' and a.id_jenis='$_GET[kend]' order by b.tgl_berlaku desc limit 0,1") as $kol);
		}*/
		
	foreach($db->select("m_tkbm a join m_barang b on a.id_barang=b.id_barang","a.nilai_bongkar,b.berat","a.id_cabang='$_SESSION[ID_CABANG]' and a.id_barang='$_GET[bar]'") as $kol);

	echo $kol['nilai_bongkar']*$_GET['qty']*$kol['berat'];
?>
		
