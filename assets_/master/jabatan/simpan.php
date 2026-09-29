<?php
$tabel = "m_jabatan";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_jabatan");
		$data = array( 
				 'id_jabatan' => $id, 
				 'nama_jabatan' => $_POST['nama'],
				 'id_divisi' => $_POST['div'],
				 'status' => 0,
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=jabatan'</script>";
}else{
	$data = array( 
				'nama_jabatan' => $_POST['nama'], 
				'id_divisi' => $_POST['div'],
		 );
	$exec= $db->update($tabel, $data, "id_jabatan='$_POST[kode]'");
	echo "<script>window.location='index.php?x=jabatan'</script>";
}


?>