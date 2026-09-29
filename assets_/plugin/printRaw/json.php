<?php
require( '../../../webclass.php' );
$db=new kelas;

$dtl=$db->select("pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang","nama_barang as nm_brg, qty_jual, discprs, dtl_total","a.id_pj='$_GET[id]'");
	//echo "select * from pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang where a.id_pj='$val[id_pj]'";
	foreach($dtl as $val2){

	}

echo json_encode($dtl);
?>