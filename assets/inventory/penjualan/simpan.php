<?php	
$tabel = "pj_penjualan_dtl_tmp";
$pisah=explode("_", $_POST['kode_barang']);
$jumlah = str_replace(",","",$_POST['harga_barang'])*$_POST['qty']; 
$discrp = $jumlah*$_POST['disc']/ 100;
$total =$jumlah - $discrp;

// if ($_POST['id_barang'] == '1'){
// 	$aku=$db->select("m_pricelist_jual aa join m_pricelist_jual_dtl bb on aa.id_price=bb.id_price","bb.harga_cetak","aa.id_cabang='1' and bb.id_barang='1' and aa.jenis='1' ORDER BY bb.id_price_dtl desc limit 0,1");
// 	$hargac = $aku[0]['harga_cetak'];
// 	$hargac = 46000;

// }else{
// 	$hargac = str_replace(",","",$_POST['harga_barang_c']);
// 	}

$aku=$db->select("m_pricelist_jual aa join m_pricelist_jual_dtl bb on aa.id_price=bb.id_price","bb.harga_cetak","aa.id_cabang='1' and bb.id_barang='$_POST[id_barang]' and aa.jenis='1' ORDER BY bb.id_price_dtl desc limit 0,1");
$hargac = $aku[0]['harga_cetak'];

if($hargac == 0){
	$hargac = str_replace(",","",$_POST['harga_barang']);
}else{ $hargac = str_replace(",","",$_POST['harga_barang_c']); }

			$data = array( 
					'id_barang' => $_POST['id_barang'],
					'harga_jual_tmp' => str_replace(",","",$_POST['harga_barang']),
					'harga_jual_cetak_tmp' => $hargac,
					'qty_tmp' => $_POST['qty'],
					'discprs_tmp' => $_POST['disc'],
					'total_tmp' => $total,
					'session_jual' => $_SESSION['ID_LOGIN'],
					'user_tmp' => $_SESSION['ID_LOGIN'],
					'jenis' => 1
						);
$ba=$db->select("pj_penjualan_dtl_tmp","*","id_barang= '$_POST[id_barang]' and jenis='1' and user_tmp='$_SESSION[ID_LOGIN]'");
foreach($ba as $bar){}

					
if (($_POST['qty'] == "" || $_POST['qty_stok'] == ""  || $_POST['qty_stok'] == "0" || $_POST['harga_barang'] == "0") || ($_POST['qty']>$_POST['qty_stok']))
	{
	  echo "<script>
	window.location='index.php?x=penjualan'</script>";
	} 
	else if ($bar > 0){
		$baru= $bar['qty_tmp']+$_POST['qty'];
		$jumlah = str_replace(",","",$_POST['harga_barang'])*$baru; 
		$discrp = $jumlah*$bar['discprs_tmp']/ 100;
		$total =$jumlah - $discrp;
		$data2 = array( 
					'id_barang' => $_POST['id_barang'],
					'harga_jual_tmp' => str_replace(",","",$_POST['harga_barang']),
					'harga_jual_cetak_tmp' => $hargac,
					'qty_tmp' => $baru,
					'discprs_tmp' => $bar['discprs_tmp'],
					'total_tmp' => $total,
					'session_jual' => $_SESSION['ID_LOGIN'],
					'user_tmp' => $_SESSION['ID_LOGIN'],
					'jenis' => 1
						);
		$exec= $db->update($tabel, $data2, "id_barang='$_POST[id_barang]'  and jenis='1' and user_tmp='$_SESSION[ID_LOGIN]'");
		echo "<script>window.location='index.php?x=penjualan'</script>";
	}
	else{
		$exec= $db->insert($tabel, $data);
		echo "<script>window.location='index.php?x=penjualan'</script>";			
			
}
?>

