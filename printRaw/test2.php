<?php
error_reporting(0);
session_start ();
require( 'webclass.php' );
$db=new kelas;

$kon=$db->select("v_report_penjualan","*","no_penjualan='TX/01/201705/0001'");
foreach($kon as $val){}

	
	$dtl=$db->select("pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang","nama_barang as nm_brg, qty_jual, discprs, dtl_total","a.id_pj='$val[id_pj]'");
	echo "select * from pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang where a.id_pj='$val[id_pj]'<br>";
	foreach($dtl as $val2){
	
	$d=sprintf("%-20s %5d %5s %15s", $val2[nm_brg],"$val2[qty_jual]", "$val2[discprs]%",number_format($val2[dtl_total]));
	echo $d."<br>";
	//Ganti dengan for dari detil penjualan
	
	
	}
	

