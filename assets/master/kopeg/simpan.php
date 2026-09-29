<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_kontrakpeg";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_status");
		$data = array( 'id_status' => $id, 
						'nama_kontrak' => $_POST['nama'], 
					   'gaji_pokok' => $_POST['gaji_pokok'],
					   'tunj_umum' => $_POST['tunj_umum'],
					   'tunj_repre' => $_POST['tunj_repre'],
					   'tunj_fungsi' => $_POST['tunj_fungsi'],
					   'tunj_presensi' => $_POST['tunj_presensi'],
					   'tunj_penem' => $_POST['tunj_penem'],
					   'status_kontrak' => '1',
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=kopeg'</script>";
}else{
	$data = array( 
					   'nama_kontrak' => $_POST['nama'], 
					   'gaji_pokok' => $_POST['gaji_pokok'],
					   'tunj_umum' => $_POST['tunj_umum'],
					   'tunj_repre' => $_POST['tunj_repre'],
					   'tunj_fungsi' => $_POST['tunj_fungsi'],
					   'tunj_presensi' => $_POST['tunj_presensi'],
					   'tunj_penem' => $_POST['tunj_penem'],
		 );
	$exec= $db->update($tabel, $data, "id_status='$_POST[kode]'");
	echo "<script>window.location='index.php?x=kopeg'</script>";
}


?>