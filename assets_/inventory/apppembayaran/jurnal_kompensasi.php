<?php
				$hrgbeli=$kmp;
				//===============jurnal=================
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='25' and status='1'");
				foreach($ckpph as $ckpph2){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  
							   'NO_JURNAL' => $idj, 
							   'ACC_CODE' =>  $ckpph2['acc_code'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Kompensasi ".$tel['no_fj']."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $_POST['link'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//=================jurnal lawan=============
				$s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account","id_cus='$tel[id_cus]'");
				foreach($s as $pps){}
				$datajur = array(  
							   'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Kompensasi ".$tel['no_fj']."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $_POST['link'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
?>