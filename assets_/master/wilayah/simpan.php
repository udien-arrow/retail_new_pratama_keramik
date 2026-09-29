<?php
$tabel = "m_wilayah";


	$cek=count($db->select("m_wilayah","*","id_wilayah='$_POST[kode]'"));
	if($cek==0){
		$data = array( 
				 'id_wilayah' => $_POST['kode'], 
				 'nama_wilayah' => $_POST['nama'],
				);
		$exec= $db->insert($tabel, $data);
	}else{
		$data = array( 
			'nama_wilayah' => $_POST['nama'], 
			 );
		$exec= $db->update($tabel, $data, "id_wilayah='$_POST[kode]'");
	}
	echo "<script>window.location='index.php?x=wilayah'</script>";



?>