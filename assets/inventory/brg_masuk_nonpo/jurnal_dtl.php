<?php
if($valtmp2['jenis']==2 || $valtmp2['jenis']==3){
		//==============jurnal qty terima========
				//$dpp=$harga_beli_bm/1.1;
				$dpp=$harga_beli_bm;
				$hrgbelib=$dpp*($valtmp2['qty_terima']-$valtmp2['claim_utuh']);
				//====jurnal=================
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => $hrgbelib,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				
				//====jurnal=================
				if($valtmp2['claim_ktg']>0){
				$hrgbelic=$dpp*$valtmp2['claim_ktg'];
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory_riject","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory_riject'],
							   'DEBET' => $hrgbelic,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				}
				//jurnal lawan
				$hrgbelid=$hrgbelib+$hrgbelic;
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","intransit","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['intransit'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbelid,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//jurnal lawan
		//==============jurnal qty terima========
		//==============jurnal calim utuh========
		if($valtmp2['claim_utuh']>0){
				//$dpp=$harga_beli_bm/1.11;
				$dpp=$harga_beli_bm;
				$hrgbeli=$dpp*$valtmp2['claim_utuh'];
				//====jurnal debet===================
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='36' and status='1'");
				foreach($ckpph as $ckpph2){}
				$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $hrgbeli,
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Claim Utuh",
									   'TGL_JURNAL' => $tgl,
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $idgen,
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									   'ID_GUD' => $valtmp['id_gudang'],
									  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//====jurnal kredit=====
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Claim Utuh",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
		}
		if($valtmp2['claim_ktg']>0){
				//$dpp=$harga_beli_bm/1.11;
				$dpp=$harga_beli_bm;
				$hrgbeli=1000*$valtmp2['claim_ktg'];
				//====jurnal debet===================
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='14' and status='1'");
				foreach($ckpph as $ckpph2){}
				$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $hrgbeli,
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Claim Ktg",
									   'TGL_JURNAL' => $tgl,
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $idgen,
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									   'ID_GUD' => $valtmp['id_gudang'],
									  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//====jurnal kredit ktg=====
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='15' and status='1'");
				foreach($ckpph as $ckpph2){}
				$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => 0,
									   'KREDIT' => $hrgbeli,
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Claim Ktg",
									   'TGL_JURNAL' => $tgl,
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $idgen,
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									   'ID_GUD' => $valtmp['id_gudang'],
									  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		}
		//==============end========		
}elseif($valtmp2['jenis']==1){
	
	//echo"disini";
	
	foreach($db->select("m_gudang","jenis","id_gudang='$_SESSION [ID_GUDANG]'") as $vgud){}
	if($vgud[jenis]==1){
	$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory as acc","a.id_barang='$valtmp2[id_barang]'");
	}
	else {
		$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","intransit as acc","a.id_barang='$valtmp2[id_barang]'");
		}
	foreach($ba as $bar){}
	
	$dttime=date("Y-m-d H:i:s");
	$datajur = array(  'NO_JURNAL' => $idj, 
				   'ACC_CODE' => $bar['acc'],
				   'DEBET' => $totkali,
				   'KREDIT' => 0,
				   'USD' => "0",
				   'KURS' => "0",
				   'KET_DTL' => "Auto Jurnal Claim Utuh",
				   'TGL_JURNAL' => $tgl,
				   'TANGGAL' => $dttime,
				   'ID_CAB' => $_SESSION['ID_CABANG'],
				   'NO_INVOICE' => $idgen,
				   'ID_GUD' => $valtmp['id_gudang'],
				  );
	$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
	//var_dump($datajur);


}elseif($valtmp2['jenis']==4){
				$dpp=$harga_beli_bm;
				$hrgbeli=$dpp*$valtmp2['qty_terima'];
				//====jurnal=================
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Transit Barang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//jurnal lawan
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","intransit","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['intransit'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Transit Barang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
}else{
				//====jurnal=================
				
				//$dpp=$harga_beli_bm/1.11;
				$dpp=$harga_beli_bm;
				$ppn=$dpp*(11/100)*$valtmp2['qty_terima'];		
				
				$hrgbeli=$dpp*$valtmp2['qty_terima'];
				$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $bar){}
				
				$tppn+=$ppn;
				$thutang+=$ppn+$hrgbeli;
				
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				if($_POST['jenk']=='LCO'){
					$ba=$db->select("m_barang a join m_grup b on a.id_sub=b.id_sub","inventory","a.id_barang='$valtmp2[id_barang]'");
					foreach($ba as $bar){}
					$dttime=date("Y-m-d H:i:s");
					$datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $bar['inventory'],
								   'DEBET' => $ongkos_bag,
								   'KREDIT' => "0",
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "Auto Jurnal Penerimaan Locco",
								   'TGL_JURNAL' => $tgl,
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $idgen,
								   'ID_GUD' => $valtmp['id_gudang'],
								  );
					$execjur= $db->insert("ak_jurnal_dtl", $datajur);
					$ongkos_bagtot+=$ongkos_bag;
				}
				
}
?>