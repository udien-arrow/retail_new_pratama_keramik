<?php
		//start auto jurnal pph
		$dttime=date("Y-m-d H:i:s");
		//start auto jurnal ppn
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='3' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $tppn,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Penjualan (PPN Keluaran)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal ppn
			//start auto jurnal hutang
			$s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account","id_cus='$_POST[cusa]'");
			foreach($s as $pps){}
			
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => "0",
							   'KREDIT' => $thutang,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Penjualan",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
							
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang
?>