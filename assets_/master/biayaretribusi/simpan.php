<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "m_biaya_retribusi";
	$tabel_dtl = "m_biaya_retribusi_dtl";
	  if($_POST['kode']==''){
		  foreach($db->select("m_biaya_retribusi","*","id_gudang='$_POST[gudang]' and id_cus='$_POST[cus]' and shipto_code='$_POST[shipto]' and id_jenis='$_POST[jenis]'") as $cek);	
		  if($cek[id_biaya]==''){		  
			  $id=$db->idurut("m_biaya_retribusi","id_biaya");	
			  $data = array( 
					 'id_biaya' => $id, 
					 'id_gudang' => $_POST['gudang'],
					 'id_cus' => $_POST['cus'],
					 'shipto_code' => $_POST['shipto'],
					 'id_jenis' => $_POST['jenis'],
					 'stampdate' => date("Y-m-d H:i:s"),
					);
			  $exec= $db->insert($tabel, $data);
		  }else{
			  $id=$cek[id_biaya];
	      }
		  
		  $tgl=date("Y-m-d",strtotime($_POST['tgl']))." ".date("H:i");
			  foreach($_POST['nilai'] as $key => $val){
					$id2=$db->idurut("m_biaya_retribusi_dtl","id_dtl");	
					$data = array( 
					 'id_dtl' => $id2, 
					 'id_biaya' => $id,
					 'nilai' => $_POST['nilai'][$key],
					 'tgl_berlaku' => $tgl,
					 'id_retribusi' => $_POST['id_ret'][$key],
					);
					$exec= $db->insert($tabel_dtl, $data);
			  }
		  echo "<script>window.location='index.php?x=biayaretribusi'</script>";
	  }else{
		 	  $id=$db->idurut("m_biaya_retribusi","id_biaya");	
			  $data = array( 
					 'id_biaya' => $id, 
					 'id_gudang' => $_POST['gudang'],
					 'id_cus' => $_POST['cus'],
					 'shipto_code' => $_POST['shipto'],
					 'id_jenis' => $_POST['jenis'],
					 'stampdate' => date("Y-m-d H:i:s"),
					);
			  $exec= $db->insert($tabel, $data);
		  $tgl=date("Y-m-d",strtotime($_POST['tgl']))." ".date("H:i");
			  foreach($_POST['nilai'] as $key => $val){
					$id2=$db->idurut("m_biaya_retribusi_dtl","id_dtl");	
					$data = array( 
					 'id_dtl' => $id2, 
					 'id_biaya' => $id,
					 'nilai' => $_POST['nilai'][$key],
					 'tgl_berlaku' => $tgl,
					 'id_retribusi' => $_POST['id_ret'][$key],
					);
					$exec= $db->insert($tabel_dtl, $data);
			  }
			echo "<script>window.location='index.php?x=biayaretribusi'</script>";
	  }
}


?>/