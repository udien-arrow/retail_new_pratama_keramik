<?php
$tabel = "hr_divisi";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_divisi");
		$data = array( 'id_divisi' => $id, 
				 'nama_divisi' => $_POST['nama'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=divisi'</script>";
}else{
	$data = array( 'nama_divisi' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_divisi='$_POST[kode]'");
	echo "<script>window.location='index.php?x=divisi'</script>";
}


?>