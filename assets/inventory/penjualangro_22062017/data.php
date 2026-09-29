<?php
session_start();
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("m_barang_gudang a", "a.id_cabang,
 a.id,
 a.id_barang,
 a.nama_barang,
 a.kode_barang,
	(select concat(bb.harga,'*',ifnull(bb.harga_cetak,0)) from m_pricelist_jual aa join m_pricelist_jual_dtl bb on aa.id_price=bb.id_price where aa.id_cabang=a.id_cabang and bb.id_barang
=a.id_barang and aa.jenis='2' and aa.tgl_berlaku <= date(NOW()) ORDER BY tgl_berlaku desc limit 0,1
)as harga,
(select v.akhir from tx_mutasi v where v.id_gudang=a.id_gudang and v.id_barang=a.id_barang order by id_mutasi desc limit 0,1)as stok","a.id_cabang='$_SESSION[ID_CABANG]' and id_gudang='$_SESSION[ID_GUDANG]' and nama_barang like '%$term%'");

foreach($dat as $row)
{
	//$kelas1 = $val['kode_barang']."_".$val['nama_barang']."_".$val['id_barang']."_".$val['harga']."_".$val['stok'];
	$rowi1=htmlentities(stripslashes($row['nama_barang']));
	$rowi2=htmlentities(stripslashes($row['nama_barang']));
	$rowi3=htmlentities(stripslashes($row['kode_barang']));
	$rowi4=htmlentities(stripslashes($row['id_barang']));
	$rowi5=htmlentities(stripslashes($row['harga']));
	$rowi6=htmlentities(stripslashes($row['stok']));
	
    //$row_set[] = $row;
	$row_set[] = array("value"=>$rowi1,"a"=>$rowi2,"b"=>$rowi3,"c"=>$rowi4,"d"=>$rowi5,"e"=>$rowi6);
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>