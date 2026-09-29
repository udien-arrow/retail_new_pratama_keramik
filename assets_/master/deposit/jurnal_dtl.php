<?php
//===========================================================start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$max=$db->select("ak_jurnal","max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		  $datajur = array(  'IDJ' => $id,
			   'IDKM'=> $idgen,
			   'NO_JURNAL' => $idj,
			   'DEBET' => $_POST['total'],
			   'KREDIT' => $_POST['total'],
			   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl'])),
			   'USER' => $_SESSION['ID_LOGIN'],
			   'ID_CAB' => $_SESSION['ID_CABANG'],
			   'ID_GUD' => $valtmp['id_gudang'],
			  );
		  $execjur= $db->insert("ak_jurnal", $datajur);
		  ////==============dtl==================		
	  	  $dttime=date("Y-m-d H:i:s");
		  $datajur = array(  'NO_JURNAL' => $idj, 
						 'ACC_CODE' =>  $_POST['pemb'],
						 'DEBET' => str_replace(",","",$_POST['nominal']),
						 'KREDIT' => "0",
						 'USD' => "0",
						 'KURS' => "0",
						 'KET_DTL' => "AJ Deposit Pelanggan ".$expc[1]." ",
						 'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl'])),
						 'TANGGAL' => $dttime,
						 'ID_CAB' => $_SESSION['ID_CABANG'],
						 'NO_INVOICE' => $nogen,
						);
		  $execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			//=================jurnal lawan=============
				$s=$db->select("ak_parameterjur","acc_code","id_m_parameterjur='24'");
				
				foreach($s as $pps){}
				
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['acc_code'],
							   'DEBET' => 0,
							   'KREDIT' => str_replace(",","",$_POST['nominal']),
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AJ Deposit Pelanggan ".$expc[1]." ",
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $nogen,
							  );
						  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);		
		//=========================================================================end auto jurnal total
?>