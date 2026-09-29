<?php
$cek=substr($selisih,0,1);
$s=$db->select("m_supplier","ifnull(pph,0) as pph,ifnull(account,0) as account,account_pph,jenis_aging,term","id_supp='$gud[id_supp]'");
foreach($s as $pps){}
if($cek!='-'){
	$dpp=$selisih/1.1;
	$hrgbelib_d=$dpp*$valtmp['qty'];
	$ppn_d=($dpp*(10/100))*$valtmp['qty'];
	$ppn_k=0;
	$hrgbelib_k=0;
	if($pps['pph']!=0){
		$pph_d=($dpp*($pps['pph']/100))*$valtmp['qty'];
		$pph_k=0;
	}
	$hutang_k=$hrgbelib_d+$ppn_d+$pph_d;
	$hutang_d=0;
}else{
	$dpp=abs($selisih)/1.1;
	$hrgbelib_k=$dpp*$valtmp['qty'];
	$ppn_k=($dpp*(10/100))*$valtmp['qty'];
	$ppn_d=0;
	$hrgbelib_d=0;
	if($pps['pph']!=0){
		$pph_k=($dpp*($pps['pph']/100))*$valtmp['qty'];
		$pph_d=0;
	}
	$hutang_d=$hrgbelib_k+$ppn_k+$pph_k;
	$hutang_k=0;
}
	//====jurnal=================
	$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","inventory","a.id_barang='$valtmp[id_barang]'");
	foreach($ba as $bar){}
	$dttime=date("Y-m-d H:i:s");
	$datajur = array(  
			 'NO_JURNAL' => $idj, 
			 'ACC_CODE' => $bar['inventory'],
			 'DEBET' => $hrgbelib_d,
			 'KREDIT' => $hrgbelib_k,
			 'USD' => "0",
			 'KURS' => "0",
			 'KET_DTL' => "AJ Koreksi Harga Beli (persediaan)",
		     'TGL_JURNAL' => $tgl,
			 'TANGGAL' => $dttime,
			 'ID_CAB' => $_SESSION['ID_CABANG'],
			 'NO_INVOICE' => $idgen,
			 'ID_GUD' => $gud['id_gudang'],
			);
	$execjur= $db->insert("ak_jurnal_dtl", $datajur);
	//ppn
	//start auto jurnal ppn
		
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $ppn_d,
							   'KREDIT' => $ppn_k,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Koreksi Harga Beli (PPN Masukan)",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $gud['id_gudang'],
							  );
		$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		//===============pph========================
				if($pps['pph']!=0){
						$datajur = array(  
							   'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['account'],
							   'DEBET' => $pph_d,
							   'KREDIT' => $pph_k,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Koreksi Harga Beli (PPH)",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $gud['id_gudang'],
							  );
						$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				}	
				
			//==================start auto jurnal hutang====================
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => $hutang_d,
							   'KREDIT' => $hutang_k,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Koreksi Harga Beli (Hutang)",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $gud['id_gudang'],
							  );
							
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang		
		
		
	
//}
?>