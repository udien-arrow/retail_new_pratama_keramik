<?php
if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=bankkeluar'</script>";
}
else{
	$tabelbk = "ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$tgl = date('Y-m-d H:i:s');
	$total = $_POST['total'];
	$max=$db->select($tabelbk,"max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;		  
	$tgls=explode("-",$_POST['tgl_trans']);	
	$databk = array( 'IDJ' => $id,
					'NO_JURNAL' => $idj,
					'IDKM' => $idkm,
					'TGL_JURNAL' => $_POST['tgl_trans'],
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],
					'ID_CAB' => $_POST['cabang'],					
				);
	$exec= $db->insert($tabelbk, $databk);
	
	foreach	($db->select("ak_jurnal_dtl_tmp","*","TIPE='BK'") as $bk){
	$tabel_dtl = "ak_jurnal_dtl";
		//buat debet	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $bk['ACC_CODE'],
						'DEBET'=> $bk['DEBET'],
						'KREDIT'=> $bk['KREDIT'],
						'KET_DTL' => $bk['KET_DTL'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo'])),
						'TANGGAL' => $tgl,
						'ID_CAB' => $_POST['cabang'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		
		$tabel = "ak_jurnal_dtl_tmp";
		$where1 = array("IDX"=>$bk['IDX']);
		$exec = $db-> delete($tabel,$where1);
	}
	
	// buat total(balance) 
	$acc=explode("-",$_POST['group']);
	$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => trim($acc[0]," "),
						'KREDIT' => $total,
						'KET_DTL' => $_POST['cacat'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo'])),
						
						'TANGGAL' => $tgl,
						'ID_CAB' => $_POST['cabang'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
	//simpan kas_keluar
	$data_dtl_kk = array('IDKK' => $idkm,
						'TGL' => $tgl,
						'TGL_TRAN' => $_POST['tgl_trans'],
						'JUMLAH' => $total,
						'URAIAN' => $_POST['cacat'],
						'id_cabang' => $_POST['cabang'],
						'type' => $_POST['aruskas'],
						);
	$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
	if($kas[c] ==0){
				$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => "0",
							   'KREDIT' => $_POST['cacat'],
							  
							  );
				$execjur= $db->insert("ak_aruskas", $datakasm);
				} else {
					$datakasm = array(  
							   'JENIS' => $_POST[aruskas],
							   'TAHUN' => $tgls[0],
							   'CABANG' => $_POST['cabang'],
							   'DEBET' => $kas['DEBET']+0,
							   'KREDIT' => $kas['KREDIT']+$_POST['cacat'],
							  );
					$execjur= $db->update("ak_aruskas", $datakasm,"JENIS='$_POST[aruskas]' AND TAHUN='$tgls[0]' AND CABANG='$_POST[cabang]'");
					}	
		
	echo "<script>window.location='index.php?x=bankkeluar'</script>";		  
	  }


?>


