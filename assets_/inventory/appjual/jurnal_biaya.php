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
					   'ID_GUD' => $valtmp['id_gudang'],
					   'IDKM' => $_POST['id'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
	$dttime=date("Y-m-d H:i:s");
	if($_POST['jenisju']=='FRC'){
			//====jurnal debet===================
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='16' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['ujs'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Total Retribusi",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//====jurnal debet===================
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='38' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['botok'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Bongkar Toko",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			//====jurnal kredit===================
			$total=$_POST['botok']+$_POST['ujs'];
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $_POST['pemb'],
									   'DEBET' => 0,
									   'KREDIT' => $total,
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Pengiriman",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
	}//end frc
	if($_POST['jenisju']=='LCO'){
			//====jurnal debet===================
			if($_POST['lco']>0){
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='39' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['lco'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Locco",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//====jurnal kredit===================
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $_POST['pemb'],
									   'DEBET' => 0,
									   'KREDIT' => $_POST['lco'],
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Locco",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			}
	}//end frc
	if($_POST['jenisju']=='SWC'){
			//====jurnal debet===================
			if($_POST['swc']>0){
			$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='18' and status='1'");
			foreach($ckpph as $ckpph2){}
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => $_POST['swc'],
									   'KREDIT' => "0",
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Switch",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//====jurnal kredit===================
			$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $_POST['pemb'],
									   'DEBET' => 0,
									   'KREDIT' => $_POST['swc'],
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Biaya Switch",
									   'TGL_JURNAL' => date("Y-m-d"),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $_POST['id'],
									   'ID_CAB' => $_SESSION['ID_CABANG'],
									  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
			}
	}//end frc
	$dataup = array( 
				'status_jurnal' => 1,
			  );
	$execjur= $db->update("tx_sales_biaya", $dataup,"no_sb='$_POST[id]'");
	echo "<script>window.open='cetak.php?page=appjual_c&id=$_POST[id]'</script>";
?>