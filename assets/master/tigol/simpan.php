<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_tingkat_golongan";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_tingkat_gol");
		
		$data = array( 'id_tingkat_gol' => $id, 
					   'tingkat_golongan' => $_POST['nama'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=tigol'</script>";
}else{
	$data = array( 'tingkat_golongan' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_tingkat_gol='$_POST[kode]'");
	echo "<script>window.location='index.php?x=tigol'</script>";
}


?>