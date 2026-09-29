<?php
if($_POST['aksi']=='hapus'){
	$where = array("HD" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=bankkeluar'</script>";
}
else{
	
	$tgx=explode("-",$_POST['tgl_trans']);
	$akhir=$db->checksaldo($tgx[1],$tgx[0],$_POST[cabang],$_POST[group]);
	
	if($_POST['total']<=$akhir){

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
					'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],
					'ID_CAB' => $_POST['cabang'],					
				);
	$exec= $db->insert($tabelbk, $databk);
	
	foreach	($db->select("ak_jurnal_dtl_tmp","*","TIPE='BK' and IFNULL(HD,0)='0'") as $bk){
		if($bk['JENIST']!='bag'){
		$tabel_dtl = "ak_jurnal_dtl";
		//buat debet	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $bk['ACC_CODE'],
						'DEBET'=> $bk['DEBET'],
						'KREDIT'=> $bk['KREDIT'],
						'KET_DTL' => $bk['KET_DTL'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TANGGAL' => $tgl,
						'ID_CAB' => $_POST['cabang'],
						'TYPE_ARUSKAS' => $bk['TYPE_AR'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		
		if($bk['JENIST']=='bma'){
			if($bk['NO_AMM']!=''){
				$ck=$db->select("am_maintenance","*","NO_AMM='$bk[NO_AMM]'");
				foreach($ck as $cak){}
				$data = array( 
					'id_am_main' => $cak['ID_MAINT'],
					'no_reff' => $idj,
					'no_maintenance' => $bk['NO_AMM'],
					'harga' => $bk['DEBET'],
					'tanggal' => date("Y-m-d"),
					'stampdate' => date("Y-m-d H:i:s"),
					'status' => 1,
					);
			$exec= $db->insert("am_maintenance_dtl", $data);
			}
		}
		if($bk[JN]=='pu'){
				$pum = array(  
							   'IDKM' => $idkk,
							   'STATUS' => "9",
							  );				  
				$execjur= $db->update("ak_pum", $pum,"NO_PUM='$bk[NO_INVOICE]'");
			}
		$tabel = "ak_jurnal_dtl_tmp";
		$where1 = array("IDX"=>$bk['IDX'],
			'ID_USER' => $_SESSION['ID_LOGIN']);
		$exec = $db-> delete($tabel,$where1);
	}
	
	
		
	//simpan kas_keluar
	$data_dtl_kk = array('IDKK' => $idkm,
						'TGL' => $tgl,
						'TGL_TRAN' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'JUMLAH' => $total,
						'URAIAN' => $_POST['cacat'],
						'id_cabang' => $_POST['cabang'],
						'type' => $_POST['aruskas'],
						);
	$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
	}
	if($bk['JENIST']=='bag'){
			$ck=$db->select("ak_jurnal_dtl_tmp","*","TIPE='BK' and IFNULL(HD,0)='0'");
			foreach($ck as $cak){
			$dttime=date("Y-m-d H:i:s");
			$tabelkas="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $cak['ACC_CODE'],
							   'DEBET' => $cak['DEBET'],
							   'KREDIT' => $cak['KREDIT'],
							   'KET_DTL' => $cak['KET_DTL'],
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $cak['CAB'],
							   'TYPE_ARUSKAS' => $cak['TYPE_AR'],
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			
			$ck1=$db->select("ak_jurnal_dtl_tmp","*","TIPE='BK' and HD='$cak[IDX]' and URUT='1'");
			foreach($ck1 as $cak1){}
			$dttime=date("Y-m-d H:i:s");
			$tabelkas="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $cak1['ACC_CODE'],
							   'DEBET' => $cak1['DEBET'],
							   'KET_DTL' => $cak1['KET_DTL'],
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_POST['cabang'],
							   'TYPE_ARUSKAS' => $cak1['TYPE_AR'],
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			
			
			$ck1=$db->select("ak_jurnal_dtl_tmp","*","TIPE='BK' and HD='$cak[IDX]' and URUT='2'");
			foreach($ck1 as $cak1){}
			$dttime=date("Y-m-d H:i:s");
			$tabelkas="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $cak1['ACC_CODE'],
							   'KREDIT' => $cak1['DEBET'],
							   'KET_DTL' => $cak1['KET_DTL'],
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $cak1['CAB'],
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("HD" => $cak['IDX'],
				'ID_USER' => $_SESSION['ID_LOGIN']); 
			$exec= $db->delete($tabel, $where);
			
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $cak['IDX'],
				'ID_USER' => $_SESSION['ID_LOGIN']); 
			$exec= $db->delete($tabel, $where);
			}
		}
	// buat total(balance) 
	$acc=explode("-",$_POST['group']);
	$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => trim($acc[0]," "),
						'KREDIT' => $total,
						'KET_DTL' => $_POST['cacat'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TANGGAL' => $tgl,
						'ID_CAB' => $_POST['cabang'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
	
	echo "
	<script>
	window.open('cetak.php?page=v_bankkeluar&id=$idkm&user=$_SESSION[ID_LOGIN]');
	window.location='index.php?x=bankkeluar'</script>";	  
	  }
 else {
	echo "
	<script>
	alert('Saldo Tidak Mencukupi!!!');
	window.location='index.php?x=bankkeluar'</script>"; 
	 }
	 
	 }

?>


