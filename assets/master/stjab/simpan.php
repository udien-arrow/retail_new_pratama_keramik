<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_st_jabatan";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_st_jabatan");
		$data = array( 
					   'id_st_jabatan' => $id, 
					   'st_jabatan' => $_POST['nama'],
					   'stampdate' => $tgl,
					   'user_id' => $_SESSION['ID_LOGIN']
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=stjab'</script>";
}else{
	$data = array( 'st_jabatan' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_st_jabatan='$_POST[kode]'");
	echo "<script>window.location='index.php?x=stjab'</script>";
}


?>