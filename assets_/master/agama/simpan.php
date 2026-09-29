<?php
$tabel = "hr_m_agama";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_agama");
		$data = array( 'id_agama' => $id, 
				 'm_agama' => $_POST['nama'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=agama'</script>";
}else{
	$data = array( 'm_agama' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_agama='$_POST[kode]'");
	echo "<script>window.location='index.php?x=agama'</script>";
}


?>