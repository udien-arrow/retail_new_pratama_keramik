<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "hr_m_tunjangan";
	  if($_POST['kode']==''){
		  $max=$db->select("hr_m_tunjangan","max(id_tunjangan)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 'id_tunjangan' => $id, 
				 		'tunjangan' => $_POST['nama'],
						'userid_tunjangan' => $_SESSION['ID_LOGIN'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=tunjangan'</script>";
	  }else{
		  $data = array( 'tunjangan' => $_POST['nama'], 
			 );
		  $exec= $db->update($tabel, $data, "id_tunjangan='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=tunjangan'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	$tabel = "hr_tunjangan";
		
	  if($_POST['kode']==''){
		  $max=$db->select("hr_tunjangan","max(id_tdtunjangan)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  if($_POST['tunj']==1){
		  	$tm=" and id_tingkat_gol='$_POST[id_golongan]'";	
		  }
		  if($_POST['tunj']==2){
		  	$tm=" and id_pangkat='$_POST[pangkat]' and idm_jabatan='$_POST[jabatan]'";	
		  }
		  if($_POST['tunj']==3){
		  	$tm=" and id_tingkat_gol='$_POST[id_golongan]'";	
		  }
		  if($_POST['tunj']==4){
		  	$tm=" and id_pangkat='$_POST[pangkat]' and idm_jabatan='$_POST[jabatan]'";	
		  }
		  if($_POST['tunj']==5){
		  	$tm=" and id_cabang='$_POST[cabang]'";	
		  }
		  $tgl=date("Y-m-d",strtotime($_POST['tgl']));
		  $jum=count($db->select("hr_tunjangan","*","id_tunjangan='$_POST[tunj]' and tgl_berlaku='$tgl' $tm"));
		 // echo $jum;
		  //die();
		  if($jum==0){
			  $data = array( 
					 'id_tdtunjangan' => $id, 
					 'id_tunjangan' => $_POST['tunj'], 
					 'id_tingkat_gol' => $_POST['id_golongan'],
					 'tgl_berlaku' => date("Y-m-d",strtotime($_POST['tgl'])), 
					 'nominal' => str_replace(",","",$_POST['nama']),
					 'idm_jabatan' => $_POST['jabatan'],
					 'id_pangkat' => $_POST['pangkat'],
					 'id_cabang' => $_POST['cabang'],
					);
			  $exec= $db->insert($tabel, $data);
		  }else{
			  echo "<script>alert('Data sudah pernah diinputkan!');</script>";
				  
		  }
		  
		  echo "<script>window.location='index.php?x=tunjangan&slug=$_POST[slug]'</script>";
	  }else{
		  $data = array( 
		  		 'id_tunjangan' => $_POST['tunj'], 
				 'id_tingkat_gol' => $_POST['id_golongan'], 
				 'tgl_berlaku' => date("Y-m-d",strtotime($_POST['tgl'])), 
				 'nominal' => str_replace(",","",$_POST['nama']),
				 'idm_jabatan' => $_POST['jabatan'],
				 'id_pangkat' => $_POST['pangkat'],
				 'id_cabang' => $_POST['cabang'],
			 );
		  $exec= $db->update($tabel, $data, "id_tdtunjangan='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=tunjangan&slug=$_POST[slug]'</script>";
	  }
		
}

?>