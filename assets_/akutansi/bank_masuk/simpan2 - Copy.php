<?php

if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=bankmasuk'</script>";
	}
else{
	$tabelbm="ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'BM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'BM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$max=$db->select($tabel,"max(IDX)as id");
	$dttime=date("Y-m-d H:i:s");
	$tot=$_POST['totk'];
	$tgls=explode("-",$_POST['tgl_transaksi']);
	$max=$db->select($tabelkas,"max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
	$databm = array(  'IDJ' => $id,
					   'NO_JURNAL' => $idj,
					   'IDKM' => $idkm,
					   'DEBET' => '0',
					   'KREDIT' => $_POST['totk'],
					   'URAIAN' => $_POST['cat'],
					   'TGL_JURNAL' => $_POST['tgl_transaksi'],
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_POST['cabang'],
					  );
	$execjur= $db->insert($tabelbm, $databm);
	
	
		foreach($db->select("ak_jurnal_dtl_tmp","*","TIPE='BM'") as $bm){
			$tabelbm="ak_jurnal_dtl";
			$dttime=date("Y-m-d H:i:s");
			$databm = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bm['ACC_CODE'],
							   'KREDIT' => $bm['KREDIT'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $bm['KET_DTL'],
							   'TGL_JURNAL' => $_POST['tgl_transaksi'],
							   'TANGGAL' => $dttime,		  
							   'ID_CAB' => $_POST['cabang'],
							  );
							
	$execjur= $db->insert($tabelbm, $databm);
		   
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $bm['IDX']); 
			$exec= $db->delete($tabel, $where);
	
		}
			
			$acc=explode("-",$_POST[group]);
			$data_dtl_ttl = array('NO_JURNAL' => $idj,
						   'ACC_CODE' => trim($acc[0]," "),
						'DEBET' => $tot,
						'KET_DTL' => 'Total',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_transaksi'])),
						'TANGGAL' => $dttime,
						'ID_CAB' => $_POST['cabang'],
			);
			
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
		
			$tabelbm="ak_kas_masuk";
			$dttime=date("Y-m-d H:i:s");
			$databm = array(  
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
							
			$execjur= $db->insert($tabelbm, $databm);
			foreach($db->select("ak_aruskas","ifnull(count(*),0) as c, DEBET, KREDIT","TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]' AND JENIS='$_POST[aruskas]'") as $kas)
			{}
			
			
			if($kas[c] ==0){
				$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => $_POST['totk'],
							   'KREDIT' => "0",
							  
							  );
				$execjur= $db->insert("ak_aruskas", $datakasm);
				} else {
					$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => $kas['DEBET']+$_POST['totk'],
							   'KREDIT' => "0",
							  
							  );
					$execjur= $db->update("ak_aruskas", $datakasm,"JENIS='$_POST[aruskas]' AND TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]'");
					
					}

 
echo "<script>window.location='index.php?x=bankmasuk'</script>";
}

?>