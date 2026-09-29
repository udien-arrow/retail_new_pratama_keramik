<?php

$tabel = "pj_penjualan";
$ip_num = $_SERVER['REMOTE_ADDR'];
$tanggal= $_POST['tgl'];
$tgl= date('Y-m-d', strtotime($tanggal));
$stamp = date("Y-m-d H:i:s");
$idj=$db->nourut('NO_PENJUALAN', 'pj_penjualan', 'TX', sprintf("%02s", $_SESSION['ID_GUDANG']), date("Y-m-d"));
$cek=count($db->select("pj_penjualan_dtl_tmp", "*", "user_tmp = '$_SESSION[ID_LOGIN]' and jenis='2'")); 

if($cek>0){
$idur=$db->idurut("pj_penjualan","id_pj");
$idjur=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));

//=====================header========================
//jurnal
				$datajur = array(  
					   'IDKM'=> $idjur,
					   'NO_JURNAL' => $idjur,
					   'DEBET' => $_POST['grantot'],
					   'KREDIT' => $_POST['grantot'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $_SESSION['ID_GUDANG'],
					  );
				$execjur= $db->insertID("ak_jurnal", $datajur);
//end jurnal
$kon=$db->select("pj_penjualan_dtl_tmp", "id_tmp, id_barang, harga_jual_tmp, qty_tmp, user_tmp, Sum(total_tmp) as total", "user_tmp = '$_SESSION[ID_LOGIN]' and jenis='2'"); 
foreach($kon as $x){  

}
$discrp_ = $x['total']*$_POST['disc2']/ 100;
$data = array( 
		'id_pj' => $idur,
		'no_penjualan' => $idj,
		'tgl_penjualan' => $tgl,
		'jenis_jual' => $_POST['jenis_jual'],
		'id_customer' => $_POST['cust2'],
		'jenis_bayar' => $_POST['jenis_bayar'],
		'id_user'	=> $x['user_tmp'],
		'stamp_date' => $stamp,
		'disc_prs'  => $_POST['disc2'],
		'disc_rp'	=> $discrp_,
		'total_jual' => $x['total'],
		'grantot_jual' => str_replace(",","",$_POST['grantot']),
		'bayar_tunai' => 0,
		'bayar_card' => 0,
		'nomor_kartu' => '',
		'kembali_tunai' =>0,
		'ip'	=> $ip_num,
		'id_gudang' => $_SESSION['ID_GUDANG'] 

		);
		$pj=$db->insertID($tabel, $data);
		//var_dump($data);
		//exit;
		//============================piutang==============================
		$dataj = array(
					'no_faktur_jual' => $idj, 
					'no_ref' => $idj,
					'status' => 1,
					'tgl' => $tgl,
					'id_cus' => $_POST['cust2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'stampdate' => date("Y-m-d H:i:s"), 
					'status_bayar' => 0,
					'jenis' => 2,
					'total_piutang'  => str_replace(",","",$_POST['grantot']),
			);
			$exec= $db->insert("tx_piutang", $dataj);
			//============================piutang==============================
//=====================header========================
//=====================detil========================			
$kon=$db->select("pj_penjualan_dtl_tmp", "id_tmp, id_barang, harga_jual_tmp, qty_tmp, user_tmp, discprs_tmp,total_tmp,harga_jual_cetak_tmp", "user_tmp = '$_SESSION[ID_LOGIN]' and jenis='2'"); 
foreach($kon as $d){
			$jumlah = $d['harga_jual_tmp']*$d['qty_tmp']; 
			$discrp = $jumlah*$d['discprs_tmp']/ 100;
			//$total = $jumlah - $discrp;
			$total = $d['total_tmp'];
			$tabel2 = "pj_penjualan_dtl";			
			$data2 = array(
					'id_pj' => $idur,
					'id_barang' => $d['id_barang'],
					'qty_jual'	=> $d['qty_tmp'],
					'harga_jual' => $d['harga_jual_tmp'],
					'harga_jual_cetak' => $d['harga_jual_cetak_tmp'],
					'discprs'	=> $d['discprs_tmp'],
					'discrp'	=> $discrp,
					'dtl_total' => $d['total_tmp']
				);
			$exec= $db->insert($tabel2, $data2);
//==================================mutasi===============================
		foreach($db->select("tx_mutasi","*","id_gudang='$_SESSION[ID_GUDANG]' and id_barang='$d[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1")as $k);
		$idbarang=$d['id_barang'];
		$akhir=$k['akhir']-$d['qty_tmp'];
		$data3 = array(
			'no_ref' => $idj,
			'id_barang' => $idbarang,
			'awal' => $k['akhir'],
			'masuk' => 0,
			'keluar' => $d['qty_tmp'],
			'akhir'	   => $akhir,
			'hpp'		=> $k['hpp'],
			'tgl_mutasi' => date("Y-m-d H:i:s"),
			'tgl_trx'   => date("Y-m-d H:i:s"),
			'jenis_mutasi' => '2',
			'id_user' => $_SESSION['ID_LOGIN'],
			'id_gudang' => $_SESSION['ID_GUDANG'],
			);
		$exc= $db->insert("tx_mutasi",$data3);
			//=====================================end mutasi=====================================
			//======================================
			$ba=$db->select("m_barang_gudang a join m_grup b on a.id_grup=b.id_grup","inventory,sales,cogs","a.id_barang= '$d[id_barang]'");
				foreach($ba as $bar){}
				$hrgjual = $total;
				$hpp = $k['hpp']*$d['qty_tmp'];
				
				$dttime=date("Y-m-d H:i:s");
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $bar['cogs'],
							   'DEBET' => $hpp,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PENJUALAN BARANG (COGS)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idj,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				//==============cogs=============
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => "0",
							   'KREDIT' => $hpp,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PENJUALAN BARANG (Persediaan)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idj,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				//======end cogs			
			//End Persediaan//
			//==============================================Pendapatan========================================//		
				$hrgjual = $total;
				$dttime=date("Y-m-d H:i:s");
				$datajur4 = array(  'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $bar['sales'],
							   'DEBET' => "0",
							   'KREDIT' => $hrgjual,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PENJUALAN BARANG (Penjualan)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idj,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
			$execjur= $db->insert("ak_jurnal_dtl", $datajur4);
			//================================================End Pendapatan===================================//
				$hpptotal+=$hpp;
				$jualtotal+=$hrgjual;
				
				$where2 = array( 
					"user_tmp" => $_SESSION['ID_LOGIN'],
					"id_tmp" => $d['id_tmp']
					);
				$db->delete("pj_penjualan_dtl_tmp",$where2);
		}  //=====================end foreach===============================
		//Kas/Bank//
		$ba=$db->select("ak_parameterjur","*","id_m_parameterjur='6' and status='1'");
		foreach ($ba as $par){}
		$dttime=date("Y-m-d H:i:s");
		$datajur3 = array(  'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $par['acc_code'],
							   'DEBET' => $jualtotal,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PENJUALAN BARANG",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idj,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
			$execjur= $db->insert("ak_jurnal_dtl", $datajur3);
//end Kas/Bank //		
//end jurnal
$ipserv= $_SERVER['SERVER_ADDR'];


$koneksi=$db->select("pj_penjualan_dtl a inner join m_barang b on a.id_barang = b.id_barang","b.nama_barang,a.id_pj,count(a.id_pj) as qty","id_pj = '$idur'  group by id_pj");
//echo "select  b.nama_barang,a.id_pj,count(a.id_pj) as qty from pj_penjualan_dtl a inner join m_barang b on a.id_barang = b.id_barang where id_pj = '$idur'  group by id_pj";
//exit;
if ( strpos($koneksi[0]['nama_barang'],'BIMA') !== false AND $koneksi[0]['qty'] == '1')
{
 ?> 
  <script>
	//$('#ok').click();
	//function print(){document.getElementById("ok").click();}
	//print();
	//window.location='jav:<?=$idur?>:grosir'; 
	window.location='jav:<?=$idur?>:bima'; 
	window.location='index.php?x=penjualangro'; 

	</script>; 
<?php
}else{

$koneksi2=$db->select("m_customer a inner join m_customer_shipto b on a.id_cus = b.id_cus", "*", "a.id_cus = '$_POST[cust2]'"); 
if ($koneksi2[0]['shipto_code'] != '' ){
?>	
  <script>
	//$('#ok').click();
	//function print(){document.getElementById("ok").click();}
	//print();
	//window.location='jav:<?=$idur?>:grosir'; 
	window.location='jav:<?=$idur?>:jalan'; 
	window.location='index.php?x=penjualangro'; 
	//alert ('Test');
	</script>; 
<?php 
 
}else{

?>	
 
  <script>
	//$('#ok').click();
	//function print(){document.getElementById("ok").click();}
	//print();
	//window.location='jav:<?=$idbarang?>:barang';		
	//window.location='jav:<?=$idur?>:grosir2';
	window.location='jav:<?=$idur?>:jalan2';	 
	window.location='index.php?x=penjualangro'; 
	//alert ('Test');
	</script>; 
 <?php	
}//END NON BIMA
}// END BIMA



}else{
	echo "<script>window.location='index.php?x=penjualangro'</script>";
	
}
 ?>   