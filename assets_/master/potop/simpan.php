<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_potongan_opr";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_jenis");
		$data = array( 'id_jenis' => $id, 
				 	   'nama_jenis' => $_POST['nama'],
					   'type' =>  $_POST['jenis'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=potop'</script>";
}else{
	$data = array( 
					   'nama_jenis' => $_POST['nama'],
					   'type' => $_POST['jenis'],
		 );
	$exec= $db->update($tabel, $data, "id_jenis='$_POST[kode]'");
	echo "<script>window.location='index.php?x=potop'</script>";
}


?>