<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "hr_penghargaan";
	  if($_POST['kode']==''){
		  $max=$db->select("hr_penghargaan","max(id_penghargaan)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  				'id_penghargaan' => $id, 
				 		'id_pegawai' => $_POST['pegawai'],
						'jenis_penghargaan' => $_POST['penghargaan'],
						'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
						'stampdate' => date("Y-m-h H:i:s"),
						'sk_penghargaan' => $_POST['skpel'],
						'ket_penghargaan' => $_POST['ket'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=penghargaan'</script>";
	  }else{
		  $data = array( 
			  			'id_pegawai' => $_POST['pegawai'],
						'jenis_penghargaan' => $_POST['penghargaan'],
						'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
						'stampdate' => date("Y-m-h H:i:s"),
						'sk_penghargaan' => $_POST['skpel'],
						'ket_penghargaan' => $_POST['ket'],
			 );
		  $exec= $db->update($tabel, $data, "id_penghargaan='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=penghargaan'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	$tabel = "hr_m_penghargaan";
	  if($_POST['kode']==''){
		  $max=$db->select("hr_m_penghargaan","max(id_jenispeng)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_jenispeng' => $id, 
				 'nama_jenispeng' => $_POST['nama'], 
				 'ket' => $_POST['ket'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=penghargaan&slug=$_POST[slug]'</script>";
	  }else{
		   $data = array( 
		  		 'nama_jenispeng' => $_POST['nama'], 
				 'ket' => $_POST['ket'],
			 );
		   $exec= $db->update($tabel, $data, "id_jenispeng='$_POST[kode]'");
		   //die();
		   echo "<script>window.location='index.php?x=penghargaan&slug=$_POST[slug]'</script>";
	  }
		
}

?>