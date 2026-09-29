<?php
session_start();
include_once('../../../webclass.php');
$db=new kelas();
$barang=@$_GET['barang'];
$kelas1="";

/*echo "select * from m_barang_gudang_ a 
LEFT join m_pricelist_jual b on a.id_cabang = b.id_cabang
LEFT join m_pricelist_jual_dtl c on b.id_price= c.id_price and a.id_barang=c.id_barang where a.id_cabang='6' and id_gudang='9' and kode_barang = '$barang'";
*/
foreach($db->select("m_barang_gudang a", "a.id_cabang,
 a.id,
 a.id_barang,
 a.nama_barang,
 a.kode_barang,
	(select concat(bb.harga,'*',ifnull(bb.harga_cetak,0)) from m_pricelist_jual aa join m_pricelist_jual_dtl bb on aa.id_price=bb.id_price where aa.id_cabang=a.id_cabang and bb.id_barang
=a.id_barang and aa.jenis='2' ORDER BY tgl_berlaku desc limit 0,1
)as harga,
(select v.akhir from tx_mutasi v where v.id_gudang=a.id_gudang and v.id_barang=a.id_barang order by id_mutasi desc limit 0,1)as stok","a.id_cabang='$_SESSION[ID_CABANG]' and id_gudang='$_SESSION[ID_GUDANG]' and kode_barang = '$barang'") as $val){
	
	$kelas1 = $val['kode_barang']."_".$val['nama_barang']."_".$val['id_barang']."_".$val['harga']."_".$val['stok'];
	
	}

echo"$kelas1";


?>
