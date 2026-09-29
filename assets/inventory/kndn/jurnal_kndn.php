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

				$hrgbeli=abs($kredit);
				//===============jurnal=================
				$s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account","id_cus='$_POST[cusa]'");
				foreach($s as $pps){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  
								'NO_JURNAL' => $idj, 
							   'ACC_CODE' =>  $pps['account'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ KNDN ". $kre[1]."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//=================jurnal lawan=============
				$datajur = array(  
								'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ KNDN ". $explo[0]."",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
?>