<?php
session_start();
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("m_pricelist_jual a
				  JOIN m_pricelist_jual_dtl b ON a.id_price = b.id_price
				  JOIN m_barang_gudang c ON b.id_barang=c.id_barang", 
				  "	a.id_cabang,
					b.id_barang,
					c.kode_barang,
					c.nama_barang,
					b.harga,
				(
						SELECT
							v.akhir
						FROM
							tx_mutasi v
						WHERE
							v.id_gudang = c.id_gudang
						AND v.id_barang = c.id_barang
						ORDER BY
							id_mutasi DESC
						LIMIT 0,
						1
					) AS stok",
				  "tgl_berlaku < date(NOW())
					AND concat(c.kode_barang,' - ',c.nama_barang) like  '%$term%'
					AND c.id_gudang='$_SESSION[ID_GUDANG]'
					AND a.id_cabang='$_SESSION[ID_CABANG]'
					
					ORDER BY
						tgl_berlaku DESC
					LIMIT 0,1");


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