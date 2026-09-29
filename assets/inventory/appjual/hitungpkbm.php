<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	foreach($db->select("m_tkbm a left join m_barang b on a.id_barang=b.id_barang","IFNULL(a.nilai,0)as nilai,b.berat","a.id_barang='$_GET[id]' and a.id_cabang='$_SESSION[ID_CABANG]'") as $kol);
	if($kol['nilai']==''){
		$nilai=0;	
		$berat=0;
	}else{
		$nilai=$kol['nilai'];
		$berat=$kol['berat'];	
	}
	echo ($nilai*($_GET['qty']*$berat)).'_'.$_GET[cusi].'_'.$_GET[ji].'_'.$berat;
	
	
?>
		
