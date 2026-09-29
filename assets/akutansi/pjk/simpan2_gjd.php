<?php
if($_POST['aksi']=='hapus'){
	$where = array("ID" => $_POST['id']);
	$db->delete("ak_pjk_tmp",$where);
	echo "<script>window.location='index.php?x=pjk&pum=$_POST[pums]&jen=$_POST[jums]'</script>";
	}else
if($_POST['aksi']=='simpan'){
$cektutup=$db->tutupbuku($_SESSION['ID_CABANG'],$_POST['tgl_transaksi']);
if($cektutup==0){	
	$tabelkas="ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'PJK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'PJK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$max=$db->select($tabelkas,"max(IDJ)as id");
	foreach($max as $val){}
	$ids=$val['id']+1;
	$dttime=date("Y-m-d H:i:s");
	$tglt=date("Y-m-d",strtotime($_POST['tgl_transaksi']));
	
	$ck=$db->select("ak_pum","*","NO_PUM='$_POST[pums]' and TIPE='$_POST[jums]'");
	foreach($ck as $cas){}
	$datakas = array(  'IDJ' => $ids,
					   'NO_JURNAL' => $idj,
					   'IDKM' => $idkm,
					   'DEBET' => '0',
					   'KREDIT' => "0",
					   'URAIAN' => $_POST['cat'],
					   'TGL_JURNAL' => $tglt,
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $cas['CABANG'],
					  );
	$execjur= $db->insert($tabelkas, $datakas);
	
	$tmp=$db->select("ak_pjk_tmp","*","USER='$_SESSION[ID_LOGIN]'");
	foreach($tmp as $temp){
		$tabelkm="ak_jurnal_dtl";
		if($temp['ST']=='debet'){
			
			$jumd=$temp['JUMLAH'];
			$jumk=0;		
			$pjk=$temp['JUMLAH'];
		}elseif($temp['ST']=='kredit'){
			$jumk=abs($temp['JUMLAH']);
			$jumd=0;
			$pjk=$temp['JUMLAH'];
		}
		
		$datakm = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $temp['ACC_CODE'],
							   'DEBET' => $jumd,
							   'KREDIT' => $jumk,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $temp['KETERANGAN'],
							   'TGL_JURNAL' => $tglt,
							   'TANGGAL' => $dttime,
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'ID_CAB' => $cas['CABANG'],
							   'TYPE_ARUSKAS' => $_POST['aruskas'],
							  );
			$execjur= $db->insert($tabelkm, $datakm);
		
			$max=$db->select("ak_pjk_dtl","max(ID)as id");
			foreach($max as $val){}
			$id=$val['id']+1;
			$tabel="ak_pjk_dtl";
			$data = array( 'ID' => $id, 
				 'KETERANGAN' => $temp['KETERANGAN'],
				 'ACC_CODE' => $temp['ACC_CODE'],
				 'NO_PUM' => $temp['NO_PUM'],
				 'JUMLAH' =>  $pjk,
				 'USER' => $temp['USER'],
				 'STAMPDATE' => date("Y-m-d H:i:s"),
				 'TGL' => $tglt,
				 'STATUS' => "0"
				);
		$exec= $db->insert($tabel, $data);
		$tot+=$temp['JUMLAH'];
	}
	
	
	$fi=$db->select("ak_pjk_tmp","sum(JUMLAH)as jum","USER='$_SESSION[ID_LOGIN]'");
	foreach($fi as $dk){}
	
	if($dk['jum']<$cas['TOTAL']){
		$jad=$cas['TOTAL']-$dk['jum'];
		$ce=$db->select("ak_pum a join ak_jurnal_dtl b on a.IDKM=B.NO_JURNAL","b.*","a.NO_PUM='$_POST[pums]' and ifnull(TYPE_ARUSKAS,'0')='0'");
		foreach($ce as $cak){}
		$datakm = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $cak['ACC_CODE'],
							   'DEBET' => $jad,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $_POST['cat'],
							   'TGL_JURNAL' => $tglt,
							   'TANGGAL' => $dttime,
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'ID_CAB' => $cas['CABANG'],
							  );
			$execjur= $db->insert($tabelkm, $datakm);
		
			$datakm = array(  
							   'IDKM' => $idkm,
							   'USD' => "0",
							   'KURS' => "0",
							   'URAIAN' => $_POST['cat'],
							   'TGL_TRAN' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'TGL' => $dttime,
							   'JUMLAH' => $tot,
							   'ID_CAB' => $cas['CABANG'],
							   'type' => "1"
							  );
			$execjur= $db->insert("ak_kas_masuk", $datakm);
	}elseif($dk['jum']>$cas['TOTAL']){
		$jad=$dk['jum']-$cas['TOTAL'];
		$ce=$db->select("ak_pum a join ak_jurnal_dtl b on a.IDKM=B.NO_JURNAL","b.*","a.NO_PUM='$_POST[pums]' and ifnull(TYPE_ARUSKAS,'0')='0'");
		foreach($ce as $cak){}
		$datakm = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $cak['ACC_CODE'],
							   'KREDIT' => $jad,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $_POST['cat'],
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'ID_CAB' => $cas['CABANG'],
							  );
			$execjur= $db->insert($tabelkm, $datakm);
		
			$datakm = array(  
							   'IDKK' => $idkm,
							   'USD' => "0",
							   'KURS' => "0",
							   'URAIAN' => $_POST['cat'],
							   'TGL_TRAN' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'TGL' => $dttime,
							   'JUMLAH' => $jad,
							   'id_cabang' => $cas['CABANG'],
							   'type' => "3"
							  );
			$execjur= $db->insert("ak_kas_keluar", $datakm);
	}


	$ce=$db->select("ak_pum a join ak_jurnal_dtl b on a.IDKM=b.NO_JURNAL","b.*","a.NO_PUM='$_POST[pums]' and TYPE_ARUSKAS<>''");
	echo "select b.* from ak_pum a join ak_jurnal_dtl b on a.IDKM=b.NO_JURNAL where a.NO_PUM='$_POST[pums]' and TYPE_ARUSKAS<>''";
		foreach($ce as $cak){}
		echo $cak;
		die();
	$datakm = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $cak['ACC_CODE'],
							   'KREDIT' => $cas['TOTAL'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => $_POST['cat'],
							   'TGL_JURNAL' => $tglt,
							   'TANGGAL' => $dttime,
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							   'ID_CAB' => $cas['CABANG'],
							  );
			$execjur= $db->insert($tabelkm, $datakm);

	
			

	$data = array( 
				 'SISA' =>  $tot-$jad,
				);
	$exec= $db->update("ak_pum", $data,"NO_PUM='$_POST[pums]'");
	
	$where = array("USER" => $_SESSION['ID_LOGIN']);
	$db->delete("ak_pjk_tmp",$where);

	echo "<script>
	window.open('cetak.php?page=v_kasmasuk&id=$idkm');
	'</script>";

echo "<script>window.location='index.php?x=pjk'</script>";

}else{//end tutup
		echo "<script>alert('Sudah Tutup Buku!'); window.location='index.php?x=pjk';</script>";
	}
	
}

?>