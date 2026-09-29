<?php

if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=kkbk'</script>";
	}
else{
	$tabelkas="ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'KK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkk=$db->nourut('IDKM', 'ak_jurnal', 'KK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$max=$db->select($tabel,"max(IDX)as id");
	$dttime=date("Y-m-d H:i:s");
	$tgls=explode("-",$_POST['tgl_trans']);
	$max=$db->select($tabelkas,"max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$datakas = array(  'IDJ' => $id,
						   'NO_JURNAL' => $idj,
						   'IDKM' => $idkk,
						   'DEBET' => $_POST['totd'],
						   'KREDIT' => '0',
						   'URAIAN' => $_POST['cat'],
						   'TGL_JURNAL' => $_POST['tgl_trans'],
						   'USER' => $_SESSION['ID_LOGIN'],
						   'ID_CAB' => $_POST['cabang'],
						  );
		$execjur= $db->insert($tabelkas, $datakas);
	
	foreach($db->select("ak_jurnal_dtl_tmp","*","TIPE='KK'") as $kk){
			$dttime=date("Y-m-d H:i:s");
			$tabelkas="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $kk['ACC_CODE'],
							   'DEBET' => $kk['DEBET'],
							   'KREDIT' => $kk['KREDIT'],
							   'KET_DTL' => $kk['KET_DTL'],
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_invoice'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_POST['cabang'],
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			//print_r($datakas);
			if($kk[JN]=='pu'){
				$pum = array(  
							   'IDKM' => $idkk,
							   'STATUS' => "9",
							  );				  
				$execjur= $db->update("ak_pum", $pum,"NO_PUM='$kk[NO_INVOICE]'");
			}
			$tot=$tot+$kk['KET_DTL'];
			
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $kk['IDX']); 
			$exec= $db->delete($tabel, $where);
	}
			
			$acc=explode("-",$_POST['group']);
			$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => trim($acc[0]," "),
						'KREDIT' => $_POST['totd'],
						'KET_DTL' => $_POST['cat'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invoice'])),
						'TANGGAL' => $dttime,
						'ID_CAB' => $_POST['cabang'],
			);
			$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
			$tabelkas="ak_kas_keluar";
			$dttime=date("Y-m-d H:i:s");
			$datakas = array(  
							   'IDKK' => $idkk,
							   'USD' => "0",
							   'KURS' => "0",
							   'URAIAN' => $_POST['cat'],
							   'TGL_TRAN' => $_POST['tgl_trans'],
							   'TGL' => $dttime,
							   'JUMLAH' => $_POST['totd'],
							   'id_cabang' => $_POST['cabang'],
							   'type' => $_POST['aruskas'],
							  );
							
			$execjur= $db->insert($tabelkas, $datakas);
			foreach($db->select("ak_aruskas","ifnull(count(*),0) as c, DEBET, KREDIT","TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]' AND JENIS='$_POST[aruskas]'") as $kas)
			{}
			
			
			if($kas[c] ==0){
				$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => "0",
							   'KREDIT' => $_POST['totd'],
							  
							  );
				$execjur= $db->insert("ak_aruskas", $datakasm);
				} else {
					$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => $kas['DEBET']+0,
							   'KREDIT' => $kas['KREDIT']+$_POST['totd'],
							  
							  );
					$execjur= $db->update("ak_aruskas", $datakasm,"JENIS='$_POST[aruskas]' AND TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]'");
					
					}				
	
		echo "<script>window.location='index.php?x=kkbk'</script>";
}



?>
