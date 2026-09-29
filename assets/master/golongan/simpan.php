<?php
$tabel = "m_golongan";
if($_POST[jenis]==''){
	$dt= $db->select($tabel,"*","kode='$_POST[kode]'");
	foreach($dt as $valdt){}
	if($valdt['id_golongan']==''){	
			$data = array( 
					 'id_golongan' => $_POST['kode'], 
					 'nama_golongan' => $_POST['nama'],
					);
			$exec= $db->insert($tabel, $data);
		echo "<script>window.location='index.php?x=golongan'</script>";
	}else{
		echo "<script>alert('Kode Sudah ada!');</script>";	
	}
}
if($_POST[jenis]=='ubah'){
		$data = array( 'nama_golongan' => $_POST['nama'], 
			 );
		$exec= $db->update($tabel, $data, "id_golongan='$_POST[kode]'");
		echo "<script>window.location='index.php?x=golongan'</script>";
}
?>