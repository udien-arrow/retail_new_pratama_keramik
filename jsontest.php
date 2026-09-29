<?php
session_start();
error_reporting(0);
include "webclass.php";
$db=new kelas();





// $fld="(SELECT a.no_penjualan, a.stamp_date, a.id_customer , g.nama_cus, a.id_user, e.USERNAME, f.nama_pegawai, a.total_jual, a.grantot_jual, 
// 			 a.bayar_tunai, a.bayar_card, bayar_transfer, a.kembali_tunai,
// 			 c.nama_barang, b.qty_jual, d.nama_satuan,  b.harga_jual, b.dtl_total
// FROM `pj_penjualan` a JOIN pj_penjualan_dtl b using(id_pj) 
// 							JOIN m_barang c on c.id_barang=b.id_barang
// 							JOIN m_satuan d on d.id_satuan=c.id_satuan
// 							JOIN r_user_login e on e.ID=a.id_user
// 							JOIN m_pegawai f on f.id_pegawai=e.ID_PEGAWAI
// 							LEFT JOIN m_customer g ON g.id_cus=a.id_customer
// where no_penjualan='TX/01/202110/0664') pjpenjualan";

$fld="(SELECT a.no_penjualan, a.stamp_date, a.id_customer , g.nama_cus, a.id_user, e.USERNAME, f.nama_pegawai, a.total_jual, a.grantot_jual, 
			 a.bayar_tunai, a.bayar_card, bayar_transfer, a.kembali_tunai,
			 c.nama_barang, b.qty_jual, d.nama_satuan,  b.harga_jual, b.dtl_total
FROM `pj_penjualan` a JOIN pj_penjualan_dtl b using(id_pj) 
							JOIN m_barang c on c.id_barang=b.id_barang
							JOIN m_satuan d on d.id_satuan=c.id_satuan
							JOIN r_user_login e on e.ID=a.id_user
							JOIN m_pegawai f on f.id_pegawai=e.ID_PEGAWAI
							LEFT JOIN m_customer g ON g.id_cus=a.id_customer
where a.id_pj='$_GET[id]') pjpenjualan";

// echo $fld;


$dtk=$db->select($fld,"*");

foreach($dtk as $k){
	$dtx[header]="TB PRATAMA";
	$dtx[alamat]="WONODADI BLITAR \n (0342)55564";
	$dtx[salesheader]=array(array("notrans" => $k[no_penjualan],
										"tgltrans"=>$k[stamp_date],
										"pelanggan"=>$k[nama_cus],
										"kasir"=>$k[nama_pegawai]
));
	
	$dtx[item][]=array("itemname"=>$k[nama_barang],
							"qty"=>$k[qty_jual],
							"harga"=>$k[harga_jual],
							"total"=>$k[dtl_total],
							"satuan"=>$k[nama_satuan],
						 );
	$dtx[payment][card]=$k[bayar_card] ? $k[bayar_card] : 0;
	$dtx[payment][cash]=$k[bayar_tunai] ? $k[bayar_tunai] : 0;
	$dtx[payment][transfer]=$k[bayar_transfer] ? $k[bayar_transfer] : 0;
}

echo json_encode(array($dtx)? array($dtx) : array());


// {
//   "header":"HEADER DATA",
//   "alamat":"Jalan Jalan Sekali Yok",
//   "telp":"031-32341223",
//   "salesheader":[{
//   "notrans": "TX0000129202",
//   "tgltrans": "2023-05-12 08:08:08",
//   "pelanggan": "Ap",
//   "kasir": "hamed_ap",
// }
// "item":[{
//   "itemname": "COLOR BLUE NAVY #1283748 SZ 42 INS 42",
//   "qty": "5"
//   "satuan": "pcs",
//   "harga": "1,000,000",
//   "total": "5,000,000"
// },
// {
//   "itemname": "COLOR BLUE NAVY #1283748 SZ 43 INS 42",
//   "qty": "5",
//   "satuan": "pcs",
//   "harga": "1,000,000",
//   "total": "5,000,000"
// }],