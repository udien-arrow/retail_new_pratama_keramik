<?php
if($_POST[kode]==''){
		//----- isi auto number
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$id=$db->idurut("kas_kecil","ID");
		$id2=$db->idurut("ak_jurnal","IDJ");
		$no=$db->nourut('NO', 'kas_kecil', 'PC', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		//----- isi auto number

		//----- isi table kas_kecil
		$tabel = "kas_kecil";
		$data = array( 'ID' => $id, 
				 'NO' => $no,
				 'TANGGAL' => date("Y-m-d H:i:s"),
				 'USER' => $_SESSION['ID_LOGIN'],
				 'STATUS' => '1',
				 'PENGUNAAN' => $_POST['penggunaan'],
				 'NOMINAL' => str_replace(',','',$_POST['jml']),
				 'ACCOUNT' => $_POST['account'], 
				);
		//var_dump($data);
		//exit;
		$exec= $db->insert($tabel, $data);
		//----- /isi table kas_kecil
		
		//----- isi jurnal header 
		$tabel = "ak_jurnal";
		$data = array(  'IDJ' => $id2,
						   'NO_JURNAL' => $idj,
						   'IDKM' => $no,
						   'DEBET' => '0',
						   'KREDIT' => '0',
						   'URAIAN' => $_POST['penggunaan'],
						   'TGL_JURNAL' => date("Y-m-d H:i:s"),
						   'USER' => $_SESSION['ID_LOGIN'],
						   'ID_CAB' => $_SESSION ['ID_CABANG'],
						  );
		$execjur= $db->insert($tabel, $data);
		//----- isi jurnal header 
	
		//----- isi jurnal detail debet
			$dat = $db -> select ("ak_parameterjur","acc_code","id_m_parameterjur = '24'");
			foreach ($dat as $data){};
			$tabel="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data['acc_code'],
							   'DEBET' => str_replace(',','',$_POST['jml']),
							   'KREDIT' => '0',
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $no,
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);
				
		//----- isi jurnal detail
	
		//----- isi jurnal detail kredit
			$tabel="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $_POST['account'],
							   'DEBET' => '0',
							   'KREDIT' => str_replace(',','',$_POST['jml']),
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $no,
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);
				
		//----- isi jurnal kredit	
	echo "<script>window.location='index.php?x=kaskecil'</script>";
}else{
	echo "<script>window.location='index.php?x=kaskecil'</script>";
}


?>