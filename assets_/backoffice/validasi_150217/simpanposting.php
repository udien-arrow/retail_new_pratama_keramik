<?php
session_start();
$idgen=$db->nourut('no_validasi', 'bo_validasi', 'VL', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
$idgenj=$db->nourut('no_jurnal', 'ak_jurnal', 'VL', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
$idkm=$db->nourut('IDKM', 'ak_kas_masuk', 'KM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	
if($_POST[jenis]==3){
	$dtv=array("no_validasi"=>$idgen,
			"cabang"=>$_SESSION['ID_CABANG'],
			"unit"=>$_POST['unit'],
			"cabang"=>$_SESSION['ID_CABANG'],
			"id_user"=>$_SESSION['ID_LOGIN'],
			"tgl_trx"=>$_POST['tgl'],
			"tgl_val"=>date("Y-m-d H:i:s"),
			"acc_code"=>$_POST['acc'],
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
					    'ACC_CODE' => $vdj['acc_code'],
					    'DEBET' => "0",
					    'KREDIT' => $_POST[total],
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
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $_POST['acc'],
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

?>