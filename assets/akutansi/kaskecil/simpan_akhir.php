<?php
		//----- isi auto number
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$id=$db->idurut("kas_kecil","ID");
		$id2=$db->idurut("ak_jurnal","IDJ");
		//----- isi auto number
		
		//----- isi jurnal header 
		$tabel = "ak_jurnal";
		$data = array(  'IDJ' => $id2,
						   'NO_JURNAL' => $idj,
						   'IDKM' =>  $_POST['no'],
						   'DEBET' => '0',
						   'KREDIT' => '0',
						   'URAIAN' => $_POST['pengunaan'],
						   'TGL_JURNAL' => date("Y-m-d H:i:s"),
						   'USER' => $_SESSION['ID_LOGIN'],
						   'ID_CAB' => $_SESSION ['ID_CABANG'],
						  );
		$execjur= $db->insert($tabel, $data);
		//----- isi jurnal header 
		
		if ($_POST['sisa']== 0){
		//----- isi jurnal detail debet
			$dat2 = $db -> select ("kas_kecil_dtl","*","ID = $_POST[idku]");
			$total = 0;
			$tabel="ak_jurnal_dtl";
			foreach ($dat2 as $data2){;
			$total = $total + 1;
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['ACCOUNT'],
							   'DEBET' => str_replace(',','',$data2['NOMINAL']),
							   'KREDIT' => '0',
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );			
			//var_dump($datakas);
			//echo "<br>";	  
			$execjur= $db->insert($tabel, $datakas);
			}			
		//----- isi jurnal detail debet
			
		//----- isi jurnal detail kredit
			$dat2 = $db -> select ("ak_parameterjur","acc_code","id_m_parameterjur = '24'");
			foreach ($dat2 as $data2){};		
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['acc_code'],
							   'DEBET' => 0,
							   'KREDIT' => str_replace(',','',$_POST['kaskecil']),
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);		
		//----- /isi jurnal detail kredit
		}else if($_POST['sisa'] > 0 ){
			
		//----- isi jurnal detail debet
			$dat2 = $db -> select ("kas_kecil_dtl","*","ID = $_POST[idku]");
			$total = 0;
			$tabel="ak_jurnal_dtl";
			foreach ($dat2 as $data2){;
			$total = $total + 1;
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['ACCOUNT'],
							   'DEBET' => str_replace(',','',$data2['NOMINAL']),
							   'KREDIT' => '0',
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );			 
			$execjur= $db->insert($tabel, $datakas);
			}			
		//----- isi jurnal detail debet
		
		//----- isi jurnal detail debet sisa
			$dat2 = $db -> select ("kas_kecil","*","ID = $_POST[idku]");
			foreach ($dat2 as $data2){};		
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['ACCOUNT'],
							   'DEBET' => str_replace(',','',$_POST['sisa']),
							   'KREDIT' => 0,
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);		
		//----- /isi jurnal detail debet sisa	
			
		//----- isi jurnal detail kredit
			$dat2 = $db -> select ("ak_parameterjur","acc_code","id_m_parameterjur = '24'");
			foreach ($dat2 as $data2){};		
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['acc_code'],
							   'DEBET' => 0,
							   'KREDIT' => str_replace(',','',$_POST['kaskecil']),
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);		
		//----- /isi jurnal detail kredit		
		}else if($_POST['sisa'] < 0 ){
			
		//----- isi jurnal detail debet
			$dat2 = $db -> select ("kas_kecil_dtl","*","ID = $_POST[idku]");
			$total = 0;
			$tabel="ak_jurnal_dtl";
			foreach ($dat2 as $data2){;
			$total = $total + 1;
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['ACCOUNT'],
							   'DEBET' => str_replace(',','',$data2['NOMINAL']),
							   'KREDIT' => '0',
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );			 
			$execjur= $db->insert($tabel, $datakas);
			}			
		//----- isi jurnal detail debet
			
		//----- isi jurnal detail kredit
			$dat2 = $db -> select ("ak_parameterjur","acc_code","id_m_parameterjur = '24'");
			foreach ($dat2 as $data2){};		
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['acc_code'],
							   'DEBET' => 0,
							   'KREDIT' => str_replace(',','',$_POST['kaskecil']),
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);		
		

		//----- isi jurnal detail kredit sisa
			$dat2 = $db -> select ("kas_kecil","*","ID = $_POST[idku]");
			foreach ($dat2 as $data2){};		
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $data2['ACCOUNT'],
							   'DEBET' => 0,
							   'KREDIT' => abs(str_replace(',','',$_POST['sisa'])),
							   'KET_DTL' => 'AUTO JURNAL KAS KECIL',
							   'TGL_JURNAL' => date("Y-m-d H:i:s"),
							   'TGL_INVOICE' => date("Y-m-d H:i:s"),
							   'NO_INVOICE' => $_POST['no'],
							   'TANGGAL' => date("Y-m-d H:i:s"),
							   'ID_CAB' => $_SESSION ['ID_CABANG'],
							  );				  
			$execjur= $db->insert($tabel, $datakas);		
		//----- /isi jurnal detail kredit sisa	
		}
		
		//----- update kas kecil kalo sdh d close
			
			$data = array(  'STATUS' => '2',
							'TANGGAL_SETOR' => date("Y-m-d H:i:s"),
							'SETOR' => str_replace(',','',$_POST['total']),		
							'SISA' =>  str_replace(',','',$_POST['sisa']),
			 							   
							  );				  
			$execjur= $db->update("kas_kecil", $data,"ID = $_POST[idku]");		
		//----- /update kas kecil kalo sdh d close
		echo "<script>window.location='index.php?x=kaskecil_d&id=$_POST[idku]'</script>";
		
?>