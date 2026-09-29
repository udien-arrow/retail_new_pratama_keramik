<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "m_umur";
	  if($_POST['kode']==''){
		  $max=$db->select("m_umur","max(id_aging)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_aging' => $id, 
				 'nama_aging' => $_POST['nama'],
				 'jenis' => $_POST['jenis'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=umuraging'</script>";
	  }else{
		  $data = array(  
		  		 'nama_aging' => $_POST['nama'],
				 'jenis' => $_POST['jenis'],
			 );
		  $exec= $db->update($tabel, $data, "id_aging='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=umuraging'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	  $tabel = "m_umur_dtl";
	  for($i=1;$i<=6;$i++){
		$urut=$_POST['urut'.$i];
	  	foreach($db->select("m_umur_dtl","*","id_aging='$_POST[kode_dep]' and urut='$urut'")as $ak);
		if($ak['id_dtl']==''){
		  $data = array( 
		  		 'awal' => $_POST['awal'.$i], 
				 'akhir' => $_POST['akhir'.$i], 
				 'urut' => $i, 
				 'id_aging' => $_POST['kode_dep'], 
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=umuraging&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
		  
	 	 }else{
		  $data = array( 
		  		 'awal' => $_POST['awal'.$i], 
				 'akhir' => $_POST['akhir'.$i], 
			 );
		  $exec= $db->update($tabel, $data, "id_aging='$_POST[kode_dep]' and urut='$i'");
		  echo "<script>window.location='index.php?x=umuraging&slug=$_POST[slug]&id=$_POST[kode_dep]'</script>";
	  	}
	  }//end for
}
//==================================================kat====================================================
?>