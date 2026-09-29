<?php
		//start auto jurnal pph
		$dttime=date("Y-m-d H:i:s");
		//start auto jurnal ppn
		
		if($pps['pkp']==1){
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $tppn,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang PPN",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			$thutang=$thutang;
		}else{
			$thutang=$thutang-$tppn;
		}
						
						//echo"<br><br>";
			//end auto jurnal ppn
			//start auto jurnal hutang
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => "0",
							   'KREDIT' => $thutang/2,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang Hutang",
							   'TGL_JURNAL' => $tgl,
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
							
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang
			//var_dump($datajur);

			if($_POST['jenk']=='LCO'){
					$ba=$db->select("ak_parameterjur","*","id_m_parameterjur='23' and status='1'");
					foreach($ba as $bar){}
					$dttime=date("Y-m-d H:i:s");
					$datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $bar['acc_code'],
								   'DEBET' => 0,
								   'KREDIT' => $ongkos_bagtot,
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
					
				}
?>