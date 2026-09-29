<?php
//-------- Void Penjualan
$ip_num = $_SERVER['REMOTE_ADDR'];
$tanggal= $_POST['tgl'];
$tgl= date('Y-m-d', strtotime($tanggal));
$stamp = date("Y-m-d H:i:s");
$idj=$db->nourut('no_penjualan', 'pj_penjualan_void', 'VO', sprintf("%02s", $_SESSION['ID_GUDANG']), date("Y-m-d"));
$idjur=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
$idur=$db->idurut("pj_penjualan_void","id_pj");
//=====================header jurnal========================
				$datajur = array(  
					   'IDKM'=> $idjur,
					   'NO_JURNAL' => $idjur,
					   'DEBET' => $_POST['grantot_jual'],
					   'KREDIT' => $_POST['grantot_jual'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $_SESSION['ID_GUDANG'],
					  );
				$execjur= $db->insertID("ak_jurnal", $datajur);
//end jurnal
//----------- isi pj _penjualan_void
$kon=$db->select("pj_penjualan","*","id_pj = '$_POST[id]'");
//echo "select * from pj_penjualan where id_pj = '$_POST[id]'";
//echo "<br>";
foreach ($kon as $kon2){};
$tabel = "pj_penjualan_void";
$data = array( 
		'id_pj' => $idur,
		'no_penjualan' =>  $idj,
		'tgl_penjualan' =>  $kon2['tgl_penjualan'],
		'jenis_jual' =>  $kon2['jenis_jual'],
		'id_customer' =>  $kon2['id_customer'],
		'jenis_bayar' =>  $kon2['jenis_bayar'],
		'id_user'	=>  $kon2['id_user'],
		'stamp_date' =>  $kon2['stamp_date'],
		'disc_prs'  =>  $kon2['disc_prs'],
		'disc_rp'	=>  $kon2['disc_rp'],
		'total_jual' =>  $kon2['total_jual'],
		'grantot_jual' =>  $kon2['grantot_jual'],
		'bayar_tunai' =>  $kon2['bayar_tunai'],
		'bayar_card' =>  $kon2['bayar_card'],
		'nomor_kartu' =>  $kon2['nomor_kartu'],
		'kembali_tunai' => $kon2['kembali_tunai'],
		'ip'	=> $ip_num,
		'id_gudang' => $_SESSION['ID_GUDANG'],
		);	
		$pj=$db->insertID($tabel, $data);
		
		$data = array( 
		'void_jual' => $idj,
		);	
		$pj=$db->update("pj_penjualan", $data,"id_pj = '$_POST[id]'");
//==============tx piu================
//if($_POST['jenis']=='2'){ // jika grosir

		$data = array( 
			'status_bayar' => 2,
			'status' => 2,
		);	
		$db->update("tx_piutang", $data,"no_faktur_jual = '$_POST[no_penjualan]'");
//}

//================ penjualan detil========================			
$tabel2 = "pj_penjualan_dtl_void";			
$kon=$db->select("pj_penjualan_dtl", "*", "id_pj = '$_POST[id]'"); 
foreach($kon as $d){
			
			$data2 = array(
					'id_pj' => $idur,
					'id_barang' => $d['id_barang'],
					'qty_jual'	=> $d['qty_jual'],
					'harga_jual' => $d['harga_jual'],
					'discprs'	=> $d['discprs'],
					'discrp'	=> $d['discpr'],
					'dtl_total' => $d['dtl_total']
				);
			$exec= $db->insert($tabel2, $data2);
//==================================mutasi===============================
		foreach($db->select("tx_mutasi","*","id_gudang='$_SESSION[ID_GUDANG]' and id_barang='$d[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1")as $k);
		$idbarang=$d['id_barang'];
		$akhir=$k['akhir']+$d['qty_jual'];
		$data3 = array(
			'no_ref' => $idj,
			'id_barang' => $idbarang,
			'awal' => $k['akhir'],
			'masuk' => $d['qty_jual'],
			'keluar' => 0,
			'akhir'	   => $akhir,
			'hpp'		=> $k['hpp'],
			'tgl_mutasi' => date("Y-m-d H:i:s"),
			'tgl_trx'   => date("Y-m-d H:i:s"),
			'jenis_mutasi' => '2',
			'id_user' => $_SESSION['ID_LOGIN'],
			'id_gudang' => $_SESSION['ID_GUDANG'],
			);
		$exc= $db->insert("tx_mutasi",$data3);
} // ----- end entry detail dan mutasi
//===================================== Jurnal Detail =====================================
			$ba=$db->select("ak_jurnal_dtl","*","NO_INVOICE = '$_POST[no_penjualan]'");
				//echo "select * from ak_jurnal_dtl where NO_INVOICE = '$_POST[no_penjualan]'";
				//echo "<br>";
				foreach($ba as $bar){
								
				$dttime=date("Y-m-d H:i:s");
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $bar['ACC_CODE'],
							   'DEBET' => $bar['KREDIT'],
							   'KREDIT' => $bar['DEBET'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "void '$bar[KET_DTL]'",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idj,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				}
//--------------------- end jurnal
echo "<script>alert ('void sukses')</script>"; 
echo "<script>window.location='index.php?x=voidpen'</script>"; 
	
$ipserv= $_SERVER['SERVER_ADDR'];
?>	
<script>
	//alert('Sukses Simpan Dengan No Penjualan <?=$idj?>');
	//window.location='cetak.php?&no_pj=<?=$idj?>&page=penjualan'
	window.location='index.php?x=penjualan'; 
	window.open('http://localhost/printRaw/jsontest.php?id=<?=$pj?>&ip=<?=$ipserv?>');
    //window.open('cetak.php?page=penjualan&no_pj=<?=$idj?>');
	//window.location='index.php?x=penjualan'</script>";	  
    </script>;
    
