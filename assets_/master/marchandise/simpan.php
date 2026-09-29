<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "m_dep";
	  if($_POST['kode']==''){
		  $max=$db->select("m_dep","max(id_dep)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 'id_dep' => $id, 
				 'nama_dep' => $_POST['nama'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=marchandise'</script>";
	  }else{
		  $data = array( 'nama_dep' => $_POST['nama'], 
			 );
		  $exec= $db->update($tabel, $data, "id_dep='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=marchandise'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	$tabel = "m_subdep";
	  if($_POST['kode']==''){
		  $max=$db->select("m_subdep","max(id_sub)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_sub' => $id, 
				 'id_dep' => $_POST['kode_dep'], 
				 'nama_sub' => $_POST['nama'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=marchandise&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  }else{
		  $data = array( 
		  		'nama_sub' => $_POST['nama'], 
			 );
		  $exec= $db->update($tabel, $data, "id_sub='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=marchandise&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  }
		
}
//==================================================kat====================================================
if($_POST['slug']==2){
	$tabel = "m_kat";
	  if($_POST['kode']==''){
		  $max=$db->select("m_kat","max(id_kat)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_kat' => $id, 
				 'id_sub' => $_POST['kode_sub'], 
				 'nama_kat' => $_POST['nama'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=marchandise&slug=$_POST[slug]&id=$_POST[kode_dep]&idsub=$_POST[kode_sub]'</script>";
	  }else{
		  $data = array( 
		  		'nama_kat' => $_POST['nama'], 
			 );
		  $exec= $db->update($tabel, $data, "id_kat='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=marchandise&slug=$_POST[slug]&id=$_POST[kode_dep]&idsub=$_POST[kode_sub]'</script>";
	  }
		
}
?>