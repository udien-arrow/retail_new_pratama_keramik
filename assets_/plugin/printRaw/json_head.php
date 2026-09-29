<?php
require( '../../../webclass.php' );
$db=new kelas;

$kon=$db->select("pj_penjualan a
				  JOIN r_user_login b ON a.id_user = b.ID
				  JOIN m_pegawai c ON b.ID_PEGAWAI=c.id_pegawai","a.*,c.nama_pegawai","no_penjualan='$_GET[id]'");
	//echo "select * from pj_penjualan_dtl a JOIN m_barang b ON a.id_barang=b.id_barang where a.id_pj='$val[id_pj]'";
	foreach($dtl as $val2){

	}

echo json_encode($kon);
?>