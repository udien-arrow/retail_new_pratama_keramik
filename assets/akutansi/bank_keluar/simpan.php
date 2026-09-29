<?php


$tabel = "ak_jurnal_dtl_tmp";	
	if($_POST[kode]==''){
		  $max=$db->select($tabel,"max(IDX)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $jml = $_POST['jml'];
		
		  
		  if($_POST['posisi']=="debet"){
		  $new_jml = str_replace(',', '',$jml);
		  $new_jml1 = 0;
		
		  }
		  else{
			  $new_jml1 = str_replace(',', '',$jml);
		  	  $new_jml = 0;
		
			  }
		  
		 $acc=explode("-",$_POST['norek']);
		 if($_POST['jenjur']=="ba"){ 
			$data = array( 'IDX' => $id, 
				 		'ACC_CODE' => trim($acc[0]," "),
						'KET_DTL' => $_POST['ket'],
						'DEBET' => $new_jml,
						'KREDIT' => $new_jml1,
						'TIPE' =>'BK',
						'TYPE_AR' => $_POST['aruskas'],
						'ID_USER' => $_SESSION['ID_LOGIN']
						
				);
				$exec= $db->insert($tabel, $data);
				}elseif($_POST['jenjur']=="pu"){
					$data = array( 'IDX' => $id, 
									 'ACC_CODE' => $_POST['norek1'],
									 'NO_INVOICE' => $_POST['j'],
									 'KET_DTL' => $_POST['ket1'],
									 'DEBET' => str_replace(",","",$_POST[jml1]),
									 'TIPE' => "BK" ,
									 'JN' => $_POST['jenjur'],
									 'TYPE_AR' => $_POST['aruskas1'],
									 'ID_USER' => $_SESSION['ID_LOGIN']);
									 $exec= $db->insert($tabel, $data);
				}elseif($_POST['jenjur']=="bag"){
				$data = array( 'IDX' => $id, 
						'ACC_CODE' => trim($acc[0]," "),
						'NO_INVOICE' => $_POST['j'],
						'KET_DTL' => $_POST['ket'],
						'DEBET' => $new_jml,
				 		'KREDIT' => $new_jml1,
						'TIPE' => "BK" ,
						'JN' => $_POST['jenjur'],
						'TYPE_AR' => $_POST['aruskas'],
						'JENIST' => $_POST['jenjur'],
						'ID_USER' => $_SESSION['ID_LOGIN'],
						'CAB' => $_POST['cabangsn'],);
				$exec= $db->insert($tabel, $data);
				$ck=$db->select("m_cabang","*","id_cabang='$_POST[cabangsn]'");
				foreach($ck as $cak){}
				if($cak['kode_cabang']=='00'){
				$hd=$db->select("ak_parameterjur","*","id_akunparam='11'");
				foreach($hd as $hda){}
				$max=$db->select("ak_jurnal_dtl_tmp","max(IDX)as id");
				foreach($max as $val){}
				$ids=$val['id']+1;
				$data = array( 'IDX' => $ids, 
						'ACC_CODE' => $hda['acc_code'],
						'NO_INVOICE' => $_POST['j'],
						'KET_DTL' => "Biaya Antar Cabang ( ".$_POST['ket']." )",
						'DEBET' => $new_jml,
				 		'KREDIT' => $new_jml1,
						'TIPE' => "BK" ,
						'JN' => $_POST['jenjur'],
						'TYPE_AR' => $_POST['aruskas'],
						'HD' => $id,
						'URUT' => 1,
						'JENIST' => $_POST['jenjur'],
						'ID_USER' => $_SESSION['ID_LOGIN']);
				$exec= $db->insert($tabel, $data);
				
				$hd=$db->select("ak_parameterjur","*","id_akunparam='10'");
				foreach($hd as $hda){}
				$max=$db->select("ak_jurnal_dtl_tmp","max(IDX)as id");
				foreach($max as $val){}
				$ids=$val['id']+1;
				$data = array( 'IDX' => $ids, 
						'ACC_CODE' => $hda['acc_code'],
						'NO_INVOICE' => $_POST['j'],
						'KET_DTL' => "Biaya Antar Cabang ( ".$_POST['ket']." )",
						'DEBET' => $new_jml,
				 		'KREDIT' => $new_jml1,
						'TIPE' => "BK" ,
						'JN' => $_POST['jenjur'],
						'TYPE_AR' => $_POST['aruskas'],
						'HD' => $id,
						'URUT' => 2,
						'JENIST' => $_POST['jenjur'],
						'CAB' => $_POST['cabangsn'],
						'ID_USER' => $_SESSION['ID_LOGIN']);
				$exec= $db->insert($tabel, $data);
				
				
				}else{
				$hd=$db->select("ak_parameterjur","*","id_akunparam='10'");
				foreach($hd as $hda){}
				$max=$db->select("ak_jurnal_dtl_tmp","max(IDX)as id");
				foreach($max as $val){}
				$ids=$val['id']+1;
				$data = array( 'IDX' => $ids, 
						'ACC_CODE' => $hda['acc_code'],
						'NO_INVOICE' => $_POST['j'],
						'KET_DTL' => "Biaya Antar Cabang ( ".$_POST['ket']." )",
						'DEBET' => $new_jml,
				 		'KREDIT' => $new_jml1,
						'TIPE' => "BK" ,
						'JN' => $_POST['jenjur'],
						'TYPE_AR' => $_POST['aruskas'],
						'HD' => $id,
						'URUT' => 1,
						'JENIST' => $_POST['jenjur'],
						'ID_USER' => $_SESSION['ID_LOGIN']);
				$exec= $db->insert($tabel, $data);
				
				
				$hd=$db->select("ak_parameterjur","*","id_akunparam='11'");
				foreach($hd as $hda){}
				$max=$db->select("ak_jurnal_dtl_tmp","max(IDX)as id");
				foreach($max as $val){}
				$ids=$val['id']+1;
				$data = array( 'IDX' => $ids, 
						'ACC_CODE' => $hda['acc_code'],
						'NO_INVOICE' => $_POST['j'],
						'KET_DTL' => "Biaya Antar Cabang ( ".$_POST['ket']." )",
						'DEBET' => $new_jml,
				 		'KREDIT' => $new_jml1,
						'TIPE' => "BK" ,
						'JN' => $_POST['jenjur'],
						'TYPE_AR' => $_POST['aruskas'],
						'HD' => $id,
						'URUT' => 2,
						'JENIST' => $_POST['jenjur'],
						'CAB' => $_POST['cabangsn'],
						'ID_USER' => $_SESSION['ID_LOGIN']);
				$exec= $db->insert($tabel, $data);
				}
		}
		
		else if($_POST['jenjur']=="bma"){ 
			$data = array( 'IDX' => $id, 
				 'ACC_CODE' => trim($acc[0]," "),
				 'KET_DTL' => $_POST['ket'],
				 'DEBET' => $new_jml,
				 'KREDIT' => $new_jml1,
				 'TIPE' => "BK" ,
				 'JN' => $_POST['jenjur'],
				 'TYPE_AR' => $_POST['aruskas'],
				 'JENIST' => $_POST['jenjur'],
				 'NO_AMM' => $_POST['no_amm']);
				$exec= $db->insert($tabel, $data);
				}
		  echo "<script>window.location='index.php?x=bankkeluar'</script>";
	  }
?>