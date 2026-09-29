<?php

if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=kmbm'</script>";
	}
else{
	$tabelkas="ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'KM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'KM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$max=$db->select($tabel,"max(IDX)as id");
	$dttime=date("Y-m-d H:i:s");
	$tot=$_POST['totk'];
	$max=$db->select($tabelkas,"max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;

	$datakas = array(  'IDJ' => $id,
					   'NO_JURNAL' => $idj,
					   'IDKM' => $idkm,
					   'DEBET' => '0',
					   'KREDIT' => $_POST['totk'],
					   'URAIAN' => $_POST['cat'],
					   'TGL_JURNAL' => $_POST['tgl_transaksi'],
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_POST['cabang'],
					  );
	$execjur= $db->insert($tabelkas, $datakas);
	$tgls=explode("-",$_POST['tgl_transaksi']);
	
		foreach($db->select("ak_jurnal_dtl_tmp","*","TIPE='KM'") as $km){
			$tabelkm="ak_jurnal_dtl";
			$dttime=date("Y-m-d H:i:s");
			$datakm = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $km['ACC_CODE'],
							   'KREDIT' => $km['KREDIT'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $km['KET_DTL'],
							   'TGL_JURNAL' => $_POST['tgl_transaksi'],
							   'TANGGAL' => $dttime,
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_invoice'])),
							   'ID_CAB' => $_POST['cabang'],
							  );
			$execjur= $db->insert($tabelkm, $datakm);
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $km['IDX']); 
			$exec= $db->delete($tabel, $where);
	
		}
			
			$acc=explode("-",$_POST['group']);
			$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => trim($acc[0]," "),
						'DEBET' => $tot,
						'KET_DTL' => $_POST['cat'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_transaksi'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invoice'])),
						'TANGGAL' => $dttime,
						'ID_CAB' => $_POST['cabang'],
			);
			
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);

	
			$tabelkm="ak_kas_masuk";
			$dttime=date("Y-m-d H:i:s");
			$datakm = array(  
							   'IDKM' => $idkm,
							   'USD' => "0",
							   'KURS' => "0",
							   'URAIAN' => $_POST['cat'],
							   'TGL_TRAN' => $_POST['tgl_transaksi'],
							   'TGL' => $dttime,
							   'JUMLAH' => $_POST['totk'],
							   'ID_CAB' => $_POST['cabang'],
							   'TYPE' => $_POST['aruskas'],
							  );
			$execjur= $db->insert($tabelkm, $datakm);
			
			foreach($db->select("ak_aruskas","ifnull(count(*),0) as c, DEBET, KREDIT","TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]' AND JENIS='$_POST[aruskas]'") as $kas)
			{}
			
			
			if($kas[c] ==0){
				$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_SESSION['ID_CABANG'],
							   'DEBET' => $_POST['totk'],
							   'KREDIT' => $kas['KREDIT']+0,
							  
							  );
				$execjur= $db->insert("ak_aruskas", $datakasm);
				} else {
					$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => $kas['DEBET']+$_POST['totk'],
							   'KREDIT' => $kas['KREDIT']+0,
							  
							  );
					$execjur= $db->update("ak_aruskas", $datakasm,"JENIS='$_POST[aruskas]' AND TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]'");
					
					}
echo "<script>window.location='index.php?x=kmbm'</script>";
}

?>