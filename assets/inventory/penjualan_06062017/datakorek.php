<?php
session_start();
error_reporting(0);
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("m_barang_gudang_ a 
LEFT join m_pricelist_jual b on a.id_cabang = b.id_cabang
LEFT join m_pricelist_jual_dtl c on b.id_price= c.id_price and a.id_barang=c.id_barang","a.id_cabang,a.id,a.id_barang,a.nama_barang,a.stok, a.kode_barang, c.harga, ifnull(c.harga,0)harga","a.id_cabang='6' and id_gudang='9' and (a.kode_barang like '%$term%' or a.nama_barang like '%$term%') ");
foreach($dat as $row)
{
	$row=htmlentities(stripslashes($row['kode_barang']));
    $row_set[] = $row;
}

//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>