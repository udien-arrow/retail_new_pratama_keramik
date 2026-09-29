<?php
$tabel = "m_pegawai_habor";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id");
		$data = array( 
				'id' => $id, 
				'id_cabang' => $_SESSION['ID_CABANG'],
				'id_jabatan' => $_POST['jabatan'],
				'no_ktp' => $_POST['no_ktp'],
				'id_status' => $_POST['statuspeg'],
				'tgl_mulai' => date("Y-m-d",strtotime($_POST['tgl_mulai'])),
				'nama_pegawai' => $_POST['nama'],
				'jenis' => 1,
				'status' => 0,
				'alamat' => $_POST['alamat']
				);
		
		$exec= $db->insert($tabel, $data);
		//var_dump($data);
		//die();
	echo "<script>window.location='index.php?x=peghabor'</script>";
}
?>