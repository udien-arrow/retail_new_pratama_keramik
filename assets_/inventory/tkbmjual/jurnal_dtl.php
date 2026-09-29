<?php
			$hrgbeli=$valtmp2['total'];
			$dttime=date("Y-m-d H:i:s");
		//====jurnal=================
			if($valtmp2['jenis_tkbm']=='2'){
				//$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='6' and status='1'");
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","muat","a.id_barang='$valtmp2[id_barang]'");
				foreach($ba as $ckpph2 ){}
				$ckkp=$ckpph2['muat'];
				$ket="(Muat)";
			}
			foreach($ckpph as $ckpph2){}
			$ttot+=$hrgbeli;
			
			$dttime=date("Y-m-d H:i:s");
			$datajur = array(  'NO_JURNAL' => $idj, 
						   'ACC_CODE' => $ckkp,
						   'DEBET' => $hrgbeli,
						   'KREDIT' => "0",
						   'USD' => "0",
						   'KURS' => "0",
						   'KET_DTL' => "Auto Jurnal TKBM Pembelian ".$ket."",
						   'TGL_JURNAL' => date("Y-m-d"),
						   'TANGGAL' => $dttime,
						   'ID_CAB' => $_SESSION['ID_CABANG'],
						   'NO_INVOICE' => $id,
						  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		
?>