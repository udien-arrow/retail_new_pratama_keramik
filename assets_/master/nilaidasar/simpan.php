<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_nilaidasar";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_nilaidasar");
		$data = array( 'id_nilaidasar' => $id, 
				 	   'id_tingkat_gol' => $_POST['gol'],
					   'tgl_berlaku' => date("Y-m-d",strtotime($_POST['tgl'])),
					   'nilaidasar' => $_POST['nama'],
					   'tglnilaidasar' => $tgl,
					   'useridnilai' => $_SESSION['ID_LOGIN'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=nilaidasar'</script>";
}else{
	$data = array( 
			'nilaidasar' => $_POST['nama'], 
			'tgl_berlaku' => date("Y-m-d",strtotime($_POST['tgl'])),
			'id_tingkat_gol' => $_POST['gol'],
		 );
	$exec= $db->update($tabel, $data, "id_nilaidasar='$_POST[kode]'");
	echo "<script>window.location='index.php?x=nilaidasar'</script>";
}


?>