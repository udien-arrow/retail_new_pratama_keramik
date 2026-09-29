<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	$bln=date("m");
	$thn=date("Y");
	$god=$db->dekrip($_GET['gudang']);
	$aas=$db->select("tx_mutasi","*","id_barang='$_GET[id]' and id_gudang='$god' ORDER BY id_mutasi desc LIMIT 0,1");
	foreach($aas as $dks){}
	echo "<script>$('#hpp$_GET[id]').val('$dks[hpp]');</script>";
	//echo $mutasi['akhir'];

?>
