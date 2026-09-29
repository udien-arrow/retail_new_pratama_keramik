<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	$sql=$db->select("tx_piutang a left join tx_buku_bg b on a.no_ref=b.no_spj","b.no_spj,count(*)as jum","a.id_piutang='$_GET[id]' and b.status='0'");
	foreach($sql as $vl){}
	echo $vl['no_spj'].'_'.$vl['jum'];

?>
