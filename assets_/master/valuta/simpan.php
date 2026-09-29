<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "m_valuta";
	  if($_POST['kode']==''){
		  $max=$db->select("m_valuta","max(id_valuta)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 'id_valuta' => $id, 
				 'nama_valuta' => $_POST['nama'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=valuta'</script>";
	  }else{
		  $data = array( 'nama_valuta' => $_POST['nama'], 
			 );
		  $exec= $db->update($tabel, $data, "id_valuta='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=valuta'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	$tabel = "m_valuta_dtl";
	  if($_POST['kode']==''){
		  $max=$db->select("m_valuta_dtl","max(id_dtl)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_dtl' => $id, 
				 'id_valuta' => $_POST['kode_dep'], 
				 'kurs' => $_POST['nama'],
				 'tgl_berlaku' => $_POST['tgl'], 
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=valuta&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  }else{
		  $data = array( 
		  		'kurs' => $_POST['nama'],
				'tgl_berlaku' => $_POST['tgl'], 
			 );
		  $exec= $db->update($tabel, $data, "id_dtl='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=valuta&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  }
		
}

?>