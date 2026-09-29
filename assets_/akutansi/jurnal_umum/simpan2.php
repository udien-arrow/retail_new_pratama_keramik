<?php

if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=jurum'</script>";
}else{
	
 if($_POST['totk']==$_POST['totd']){	
	//$tabeljur="ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'JU', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'JU', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$dttime=date("Y-m-d H:i:s");
	$tabeljur="ak_jurnal";
	
	$idjur=$db->idurut("ak_jurnal","IDJ");	
	$datajur = array(  	'IDJ' => $idjur,
						'NO_JURNAL' => $idj,
					   	'IDKM' => $idkm,
					   	'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
						'URAIAN' => $_POST['cat'],
					   	'DEBET' => $_POST['totd'],
					   	'KREDIT' => $_POST['totd'],
					   	'USER' => $_SESSION['ID_LOGIN'],
					   	'ID_CAB' => $_POST['cabang'],					   
					  );
					  
		$execjur = $db->insert($tabeljur, $datajur);
	
	
		foreach($db->select("ak_jurnal_dtl_tmp","*","TIPE='JU'") as $jur){
			$tabeljur1="ak_jurnal_dtl";
			$dttime=date("Y-m-d H:i:s");
			$datajur1 = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $jur['ACC_CODE'],
							   'DEBET' => $jur['DEBET'],
							   'KREDIT' => $jur['KREDIT'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $jur['KET_DTL'],
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_POST['cabang'],
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi']))
							   
							  );
							
			$execjur1 = $db->insert($tabeljur1, $datajur1);
				   
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $jur['IDX']); 
			$exec= $db->delete($tabel, $where);
			
		}
		
 }else{
	 
	echo "<script>alert('Nilai Tidak Balance!');</script>";	 
 }

 
echo "<script>
window.open('cetak.php?page=v_jurum&id=$idkm&user=$_SESSION[ID_LOGIN]');
window.location='index.php?x=jurum'</script>";
}

?>
