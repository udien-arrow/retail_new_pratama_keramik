<?php
//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $_POST['total'],
					   'KREDIT' => $_POST['total'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
			$aa=$db->select("tx_koreksi","*","no_koreksi='$_POST[id]'");
			foreach($aa as $valtmp2){
				$dttime=date("Y-m-d H:i:s");
				$sel=$valtmp2['total']-$valtmp2['total_sebelumnya'];
				if($sel!=0){
				  if($sel>0){
					 $hrgbeli=$sel;
					 //====jurnal piutang=================
					 $s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account,nama_usaha","id_cus='$valtmp2[id_cus]'");
					 foreach($s as $pps){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $pps['account'],
								   'DEBET' => $hrgbeli,
								   'KREDIT' => 0,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Piutang ".$valtmp2['no_fj']." nama Customer : ".$pps['nama_usaha']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
					 //====penjualan=================
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $_POST['pemb'],
								   'DEBET' => 0,
								   'KREDIT' => $hrgbeli,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Piutang ".$valtmp2['no_fj']." nama Customer : ".$pps['nama_usaha']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
				  }else{ //turun
					 $hrgbeli=abs($sel);
					 $s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account,nama_usaha","id_cus='$valtmp2[id_cus]'");
					 foreach($s as $pps){}
					 //====penjualan=================
					  $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $_POST['pemb'],
								   'DEBET' => $hrgbeli,
								   'KREDIT' => 0,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga ".$valtmp2['no_fj']."  nama Customer : ".$pps['nama_usaha']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
					  //====jurnal piutang=================
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $pps['account'],
								   'DEBET' => 0,
								   'KREDIT' => $hrgbeli,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga ".$valtmp2['no_fj']." nama Customer : ".$pps['nama_usaha']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
				  }//end if naik turun	
				}
			}	
?>