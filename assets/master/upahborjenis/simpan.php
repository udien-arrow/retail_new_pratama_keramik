<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "m_bbm";
	  if($_POST['kode']==''){
		  $max=$db->select("m_bbm","max(id_bbm)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 'id_bbm' => $id, 
				 'id_cabang' => $_POST['cabang'],
				 'keterangan' => $_POST['ket'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=hargabbm'</script>";
	  }else{
		  $data = array( 
		  		 'id_cabang' => $_POST['cabang'],
				 'keterangan' => $_POST['ket'],
			 );
		  $exec= $db->update($tabel, $data, "id_bbm='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=hargabbm'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	$tabel = "m_bbm_dtl";
	  if($_POST['kode']==''){
		  $max=$db->select("m_bbm_dtl","max(id_dtl)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_dtl' => $id, 
				 'id_bbm' => $_POST['kode_dep'], 
				 'harga' => $_POST['nama'],
				 'tgl_berlaku' => $_POST['tgl'], 
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=hargabbm&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  }else{
		  $data = array( 
		  		'harga' => $_POST['nama'],
				'tgl_berlaku' => $_POST['tgl'], 
			 );
		  $exec= $db->update($tabel, $data, "id_dtl='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=hargabbm&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  }
		
}

?>