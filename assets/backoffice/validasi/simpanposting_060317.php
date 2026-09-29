<?php
session_start();
$acc = explode("-",$_POST['acc']);
$idgen=$db->nourut('no_validasi', 'bo_validasi', 'VL', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
$idgenj=$db->nourut('no_jurnal', 'ak_jurnal', 'VL', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
if($acc[1]=='1'){
	$idkm=$db->nourut('IDKM', 'ak_kas_masuk', 'KM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
} else {
	$idkm=$db->nourut('IDKM', 'ak_kas_masuk', 'BM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
}

//======================= Jenis 1 / Credit Card
if($_POST[jenis]==1){
	$dj1=$db->select("ak_parameterjur","*","id_m_parameterjur='6'");
	foreach($dj1 as $vdj1){}
	
	$dtv=array("no_validasi"=>$idgen,
			"cabang"=>$_SESSION['ID_CABANG'],
			"unit"=>$_POST['unit'],
			"cabang"=>$_SESSION['ID_CABANG'],
			"id_user"=>$_SESSION['ID_LOGIN'],
			"tgl_trx"=>$_POST['tgl'],
			"tgl_val"=>date("Y-m-d H:i:s"),
			//"acc_code"=>$_POST['acc'],
			"acc_code"=>$vdj1['acc_code'],
			"jenis_val"=>$_POST['jenis'],
			"qty"=>$_POST['qty'],
			"dpp"=>$_POST['total'],
			"ppn"=>"0",
			"total"=>$_POST['total'], 
			);
	$iv=$db->insertID("bo_validasi",$dtv);
	$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idkm,
				"tgl_jurnal"=>date("Y-m-d H:i:s"),
				"debet"=>$_POST[total],
				"kredit"=>$_POST[total],
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$_SESSION['ID_CABANG'],
				"uraian"=>"Penerimaan Pendapatan Credit Card",
	);
	$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
	$dj1=$db->select("ak_parameterjur","*","id_m_parameterjur='6'");
	foreach($dj1 as $vdj1){}	
			
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj1['acc_code'],
					    'DEBET' => $_POST['total'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Credit Card",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idkm,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
	
	$dj=$db->select("ak_parameterjur","*","id_m_parameterjur='14'");
	foreach($dj as $vdj){}
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['acc_code'],
					    'DEBET' => "0",
					    'KREDIT' => $_POST['total'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Credit Card",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		
   foreach($db->select("bo_validasi_tmp","*","substr(no_trx,1,2)='CC'") as $dtv){
	$data=array("id_trx"=>$dtv[id_trx],
				"no_trx"=>$idgen,
				"tgl_trx"=>$_POST[tgl],
				"tgl_val"=>date("Y-m-d H:i:s"),
				"id_user"=>$_SESSION['ID_LOGIN'],
				"unit"=>$dtv['unit'],
				"cabang"=>$dtv['cabang'],
				);
	$db->insert("bo_validasi_dtl",$data);
	$del=array("id_validasi"=>$dtv[id_validasi]);
	$db->delete("bo_validasi_tmp",$del);
	}
   
echo "<script>
		window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'
	  </script>";			
}
//======================= End jenis 1 / Credit Card

//======================= Jenis 3 / Cash
if($_POST[jenis]==3){
	$dtv=array("no_validasi"=>$idgen,
			"cabang"=>$_SESSION['ID_CABANG'],
			"unit"=>$_POST['unit'],
			"cabang"=>$_SESSION['ID_CABANG'],
			"id_user"=>$_SESSION['ID_LOGIN'],
			"tgl_trx"=>$_POST['tgl'],
			"tgl_val"=>date("Y-m-d H:i:s"),
			//"acc_code"=>$_POST['acc'],
			"acc_code"=>$acc[0],
			"jenis_val"=>$_POST['jenis'],
			"qty"=>$_POST['qty'],
			"dpp"=>$_POST['total'],
			"ppn"=>"0",
			"total"=>$_POST['total'],
			);
	$iv=$db->insertID("bo_validasi",$dtv);
	$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idkm,
				"tgl_jurnal"=>date("Y-m-d H:i:s"),
				"debet"=>$_POST[total],
				"kredit"=>$_POST[total],
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$_SESSION['ID_CABANG'],
				"uraian"=>"Penerimaan Pendapatan CP",
	);
	$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
	$tabelkm="ak_kas_masuk";
	$dttime=date("Y-m-d H:i:s");
	$datakm = array(  
					   'IDKM' => $idkm,
					   'USD' => "0",
					   'KURS' => "0",
					   'URAIAN' => "Pendapatan Cash Payment",
					   'TGL_TRAN' => date("Y-m-d H:i:s"),
					   'TGL' => date("Y-m-d H:i:s"),
					   'JUMLAH' => $_POST['total'],
					   'ID_CAB' => $_POST['cabang'],
					   'TYPE' => $_POST['aruskas'],
					  );
	$execjur= $db->insert($tabelkm, $datakm);
	
	$dj=$db->select("ak_parameterjur","*","id_m_parameterjur='16'");
	foreach($dj as $vdj){}
		
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $acc[0],
					    'DEBET' => $_POST['total'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Cash",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idkm,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['acc_code'],
					    'DEBET' => "0",
					    'KREDIT' => $_POST['total'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Cash",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		
   foreach($db->select("bo_validasi_tmp","*","substr(no_trx,1,2)='CH'") as $dtv){
	$data=array("id_trx"=>$dtv[id_trx],
				"no_trx"=>$idgen,
				"tgl_trx"=>$_POST[tgl],
				"tgl_val"=>date("Y-m-d H:i:s"),
				"id_user"=>$_SESSION['ID_LOGIN'],
				"unit"=>$dtv['unit'],
				"cabang"=>$dtv['cabang'],
				);
	$db->insert("bo_validasi_dtl",$data);
	$del=array("id_validasi"=>$dtv[id_validasi]);
	$db->delete("bo_validasi_tmp",$del);
	}
   
echo "<script>
		window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'
	  </script>";			
}
//======================= End jenis 3 / Cash

//======================= Jenis 2 / Debit Card
if($_POST[jenis]==2){
	$dtv=array("no_validasi"=>$idgen,
			"cabang"=>$_SESSION['ID_CABANG'],
			"unit"=>$_POST['unit'],
			"cabang"=>$_SESSION['ID_CABANG'],
			"id_user"=>$_SESSION['ID_LOGIN'],
			"tgl_trx"=>$_POST['tgl'],
			"tgl_val"=>date("Y-m-d H:i:s"),
			"acc_code"=>$acc[0],
			"jenis_val"=>$_POST['jenis'],
			"qty"=>$_POST['qty'],
			"dpp"=>$_POST['total'],
			"ppn"=>"0",
			"total"=>$_POST['total'],
			);
	$iv=$db->insertID("bo_validasi",$dtv);
	$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idkm,
				"tgl_jurnal"=>date("Y-m-d H:i:s"),
				"debet"=>$_POST[total],
				"kredit"=>$_POST[total],
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$_SESSION['ID_CABANG'],
				"uraian"=>"Penerimaan Pendapatan Debit Card",
	);
	$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
	$tabelkm="ak_kas_masuk";
	$dttime=date("Y-m-d H:i:s");
	$datakm = array(  
					   'IDKM' => $idkm,
					   'USD' => "0",
					   'KURS' => "0",
					   'URAIAN' => "Pendapatan Debit Card Payment",
					   'TGL_TRAN' => date("Y-m-d H:i:s"),
					   'TGL' => date("Y-m-d H:i:s"),
					   'JUMLAH' => $_POST['total'],
					   'ID_CAB' => $_POST['cabang'],
					   'TYPE' => $_POST['aruskas'],
					  );
	$execjur= $db->insert($tabelkm, $datakm);
	
	$dj=$db->select("ak_parameterjur","*","id_m_parameterjur='18'");
	foreach($dj as $vdj){}
		
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $acc[0],
					    'DEBET' => $_POST['total'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Debit Card",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idkm,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['acc_code'],
					    'DEBET' => "0",
					    'KREDIT' => $_POST['total'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Debit Card",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		
   foreach($db->select("bo_validasi_tmp","*","substr(no_trx,1,2)='DC'") as $dtv){
	$data=array("id_trx"=>$dtv[id_trx],
				"no_trx"=>$idgen,
				"tgl_trx"=>$_POST[tgl],
				"tgl_val"=>date("Y-m-d H:i:s"),
				"id_user"=>$_SESSION['ID_LOGIN'],
				"unit"=>$dtv['unit'],
				"cabang"=>$dtv['cabang'],
				);
	$db->insert("bo_validasi_dtl",$data);
	$del=array("id_validasi"=>$dtv[id_validasi]);
	$db->delete("bo_validasi_tmp",$del);
	}
   
echo "<script>
		window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'
	  </script>";			
}
//======================= End jenis 2 / Debit Card

//======================= Jenis 6 / Reflexy
if($_POST[jenis]==6){
	$dtv=array("no_validasi"=>$idgen,
			"cabang"=>$_SESSION['ID_CABANG'],
			"unit"=>$_POST['unit'],
			"cabang"=>$_SESSION['ID_CABANG'],
			"id_user"=>$_SESSION['ID_LOGIN'],
			"tgl_trx"=>$_POST['tgl'],
			"tgl_val"=>date("Y-m-d H:i:s"),
			"acc_code"=>$acc[0],
			"jenis_val"=>$_POST['jenis'],
			"qty"=>$_POST['qty'],
			"dpp"=>$_POST['total'],
			"ppn"=>"0",
			"total"=>$_POST['total'],
			);
	$iv=$db->insertID("bo_validasi",$dtv);
	$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idkm,
				"tgl_jurnal"=>date("Y-m-d H:i:s"),
				"debet"=>$_POST[total],
				"kredit"=>$_POST[total],
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$_SESSION['ID_CABANG'],
				"uraian"=>"Penerimaan Pendapatan Reflexy",
	);
	$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
	$tabelkm="ak_kas_masuk";
	$dttime=date("Y-m-d H:i:s");
	$datakm = array(  
					   'IDKM' => $idkm,
					   'USD' => "0",
					   'KURS' => "0",
					   'URAIAN' => "Pendapatan Reflexy",
					   'TGL_TRAN' => date("Y-m-d H:i:s"),
					   'TGL' => date("Y-m-d H:i:s"),
					   'JUMLAH' => $_POST['total'],
					   'ID_CAB' => $_POST['cabang'],
					   'TYPE' => $_POST['aruskas'],
					  );
	$execjur= $db->insert($tabelkm, $datakm);
	
	$dj=$db->select("ak_parameterjur","*","id_m_parameterjur='15'");
	foreach($dj as $vdj){}
		
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $acc[0],
					    'DEBET' => $_POST['total'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Reflexy",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idkm,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['acc_code'],
					    'DEBET' => "0",
					    'KREDIT' => $_POST['total'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Reflexy",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		
   foreach($db->select("bo_validasi_tmp","*","substr(no_trx,1,2)='RF'") as $dtv){
	$data=array("id_trx"=>$dtv[id_trx],
				"no_trx"=>$idgen,
				"tgl_trx"=>$_POST[tgl],
				"tgl_val"=>date("Y-m-d H:i:s"),
				"id_user"=>$_SESSION['ID_LOGIN'],
				"unit"=>$dtv['unit'],
				"cabang"=>$dtv['cabang'],
				);
	$db->insert("bo_validasi_dtl",$data);
	$del=array("id_validasi"=>$dtv[id_validasi]);
	$db->delete("bo_validasi_tmp",$del);
	}
   
echo "<script>
		window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'
	  </script>";			
}
//======================= End jenis 6 / Reflexy

//======================= Jenis 5 / Mitra Lain
if($_POST[jenis]==5){
	$dtv=array("no_validasi"=>$idgen,
				"cabang"=>$_SESSION['ID_CABANG'],
				"unit"=>$_POST['unit'],
				"cabang"=>$_SESSION['ID_CABANG'],
				"id_user"=>$_SESSION['ID_LOGIN'],
				"tgl_trx"=>$_POST['tgl'],
				"tgl_val"=>date("Y-m-d H:i:s"),
				"acc_code"=>$acc[0],
				"jenis_val"=>$_POST['jenis'],
				"qty"=>$_POST['qty'],
				"dpp"=>$_POST['total'],
				"ppn"=>"0",
				"total"=>$_POST['total'],
			);
	$iv=$db->insertID("bo_validasi",$dtv);
	$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idkm,
				"tgl_jurnal"=>date("Y-m-d H:i:s"),
				"debet"=>$_POST[total],
				"kredit"=>$_POST[total],
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$_SESSION['ID_CABANG'],
				"uraian"=>"Penerimaan Pendapatan Mitra Lain",
	);
	$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
	
	
	$dj=$db->select("ak_parameterjur","*","id_m_parameterjur='6'");
	foreach($dj as $vdj){}
	$dj1=$db->select("ak_parameterjur","*","id_m_parameterjur='7'");
	foreach($dj1 as $vdj1){}
		
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['acc_code'],
					    'DEBET' => $_POST['total'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Mitra Lain",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idkm,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj1['acc_code'],
					    'DEBET' => "0",
					    'KREDIT' => $_POST['total'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Pendapatan Mitra Lain",
					    'TGL_JURNAL' => date("Y-m-d H:i:s"),
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
						'TYPE_ARUSKAS' => "0",
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		
   foreach($db->select("bo_validasi_tmp","*","substr(no_trx,1,2)='MT'") as $dtv){
	$data=array("id_trx"=>$dtv[id_trx],
				"no_trx"=>$idgen,
				"tgl_trx"=>$_POST[tgl],
				"tgl_val"=>date("Y-m-d H:i:s"),
				"id_user"=>$_SESSION['ID_LOGIN'],
				"unit"=>$dtv['unit'],
				"cabang"=>$dtv['cabang'],
				);
	$db->insert("bo_validasi_dtl",$data);
	$del=array("id_validasi"=>$dtv[id_validasi]);
	$db->delete("bo_validasi_tmp",$del);
	}
   
echo "<script>
		window.location='index.php?x=vdasi&jenis=$_POST[jenis]&tgl=".$_POST[tgl]."&unit=$_POST[unit]'
	  </script>";			
}
//======================= End jenis 5 / Mitra Lain
?>