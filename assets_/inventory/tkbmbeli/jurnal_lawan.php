<?php
		//start auto jurnal pph
		$dttime=date("Y-m-d H:i:s");
		//start auto jurnal ppn
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='23' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => 0,
							   'KREDIT' => $ttot,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal TKBM Pembelian",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $id,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal
?>