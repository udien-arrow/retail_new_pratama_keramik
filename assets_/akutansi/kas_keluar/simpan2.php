<?php
session_start();
if($_POST['aksi']=='hapus'){
	$where = array("IDX" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	
	$where = array("HD" => $_POST['id']);
	$db->delete("ak_jurnal_dtl_tmp",$where);
	
	echo "<script>window.location='index.php?x=kkbk'</script>";
	}
else{
	$tgx=explode("-",$_POST['tgl_trans']);
	$akhir=$db->checksaldo($tgx[1],$tgx[0],$_POST[cabang],$_POST[group]);
	
	//if($_POST['total']<=$akhir){
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
	
		foreach($db->select("ak_jurnal_dtl_tmp","*","TIPE='KK' and IFNULL(HD,0)='0' and ID_USER='$_SESSION[ID_LOGIN]'") as $kk){
			if($kk['JENIST']!='bag'){
			$dttime=date("Y-m-d H:i:s");
			$tabelkas="ak_jurnal_dtl";
			$datakas = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $kk['ACC_CODE'],
							   'DEBET' => $kk['DEBET'],
							   'KREDIT' => $kk['KREDIT'],
							   'KET_DTL' => $kk['KET_DTL'],
							   'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_POST['cabang'],
							   'TYPE_ARUSKAS' => $kk['TYPE_AR'],
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			//print_r($datakas);
			if($kk['JENIST']=='bma'){
			
			if($kk['NO_AMM']!=''){
				$ck=$db->select("am_maintenance","*","NO_AMM='$kk[NO_AMM]'");
				foreach($ck as $cak){}
				$data = array( 
					'id_am_main' => $cak['ID_MAINT'],
					'no_reff' => $idj,
					'no_maintenance' => $kk['NO_AMM'],
					'harga' => $kk['DEBET'],
					'tanggal' => date("Y-m-d"),
					'stampdate' => date("Y-m-d H:i:s"),
					'status' => 1,
					);
				//var_dump($data);
			$exec= $db->insert("am_maintenance_dtl", $data);
				
			}
		}
			
			if($kk[JN]=='pu'){
				$pum = array(  
							   'IDKM' => $idkk,
							   'STATUS' => "9",
							  );				  
				$execjur= $db->update("ak_pum", $pum,"NO_PUM='$kk[NO_INVOICE]'");
			}
			$tot=$tot+$kk['KET_DTL'];
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $kk['IDX'],
							"ID_USER" => $_SESSION['ID_LOGIN']); 
			$exec= $db->delete($tabel, $where);
	}
			
			
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
			
		}
		if($kk['JENIST']=='bag'){
			$ck=$db->select("ak_jurnal_dtl_tmp","*","TIPE='KK' and IFNULL(HD,0)='0'  and ID_USER='$_SESSION[ID_LOGIN]'");
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
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			
			$ck1=$db->select("ak_jurnal_dtl_tmp","*","TIPE='KK' and HD='$cak[IDX]' and URUT='1'  and ID_USER='$_SESSION[ID_LOGIN]'");
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
			
			
			$ck1=$db->select("ak_jurnal_dtl_tmp","*","TIPE='KK' and HD='$cak[IDX]' and URUT='2'  and ID_USER='$_SESSION[ID_LOGIN]'");
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
							   'TYPE_ARUSKAS' => $cak1['TYPE_AR'],
							  );				  
			$execjur= $db->insert($tabelkas, $datakas);
			
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("HD" => $cak['IDX'],
				"ID_USER" => $_SESSION['ID_LOGIN']); 
			$exec= $db->delete($tabel, $where);
			
			$tabel="ak_jurnal_dtl_tmp";
			$where = array("IDX" => $cak['IDX'],
					"ID_USER" => $_SESSION['ID_LOGIN']); 
			$exec= $db->delete($tabel, $where);
			}
		}
			$acc=explode("-",$_POST['group']);
			$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => trim($acc[0]," "),
						'KREDIT' => $_POST['totd'],
						'KET_DTL' => $_POST['cat'],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TANGGAL' => $dttime,
						'ID_CAB' => $_POST['cabang'],
			);
			$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		//die();
		//window.open('cetak.php?page=v_kaskeluar&id=$idkk');
		echo "<script>
		window.open('cetak.php?page=v_kaskeluar&id=$idkk&user=$_SESSION[ID_LOGIN]');
		window.location='index.php?x=kkbk'</script>";
/*} else {
	echo "
	<script>
	alert('Saldo Tidak Mencukupi!!!');
	window.location='index.php?x=bankkeluar'</script>";
	}*/

}

?>
