<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_pangkat";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_pangkat");
		$data = array( 'id_pangkat' => $id, 
					   'pangkat' => $_POST['nama'],
					   'status_pangkat' => '1',
					   'tgl_pangkat' => $tgl,
					   'userid_pangkat' => $_SESSION['ID_LOGIN']
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=pangkat'</script>";
}else{
	$data = array( 'pangkat' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_pangkat='$_POST[kode]'");
	echo "<script>window.location='index.php?x=pangkat'</script>";
}


?>