<?php

if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=jurum'</script>";
}else{
	
 if($_POST['totk']==$_POST['totd']){	
	$tabeljur="ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'JU', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'JU', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$max=$db->select($tabel,"max(IDX)as id");
	$dttime=date("Y-m-d H:i:s");
	$max=$db->select($tabeljur,"max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
	$datajur = array(  'IDJ' => $id,
						'IDKM'=> $idkm,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $_POST['totd'],
					   'KREDIT' => $_POST['totd'],
					   'URAIAN' => $_POST['cat'],
					   'TGL_JURNAL' => $_POST['tanggal_transaksi'],
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_POST['cabang'],
					  );
	$execjur= $db->insert($tabeljur, $datajur);
	
		foreach($db->select("ak_jurnal_dtl_tmp","*","TIPE='JU'") as $jur){
			$tabeljur="ak_jurnal_dtl";
			$dttime=date("Y-m-d H:i:s");
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $jur['ACC_CODE'],
							   'DEBET' => $jur['DEBET'],
							   'KREDIT' => $jur['KREDIT'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $jur['KET_DTL'],
							   'TGL_JURNAL' => $_POST['tanggal_transaksi'],
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_POST['cabang'],
							  );
							
			$execjur= $db->insert($tabeljur, $datajur);
				   
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $jur['IDX']); 
			$exec= $db->delete($tabel, $where);
		}
 }else{
	 
	echo "<script>alert('Nilai Tidak Balance!');</script>";	 
 }

 
echo "<script>window.location='index.php?x=jurum'</script>";
}

?>
