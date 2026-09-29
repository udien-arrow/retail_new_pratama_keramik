<?php
$tabel = "m_kendaraan";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id");
		$data = array( 
				'id' => $id, 
				'nia' => $_POST['nia'],
				'nopol' => $_POST['nopol'],
				'nik' => $_POST['nik'],
				'id_jenis' => $_POST['id_jenis'],
				'milik' => '',
				'jasa' => '',
				'tahunbuat' => $_POST['tahunbuat'],
				'merek' => '',
				'nomesin' => $_POST['nomesin'],
				'nosasis' => $_POST['nosasis'],
				'stnk' => $_POST['stnk'],
				'kir' => '',
				'id_cabang' => $_POST['id_cabang'],
				'id_pegawai' => $_POST['id_supir'],
				'km' => $_POST['km'],
				'muatan' => $_POST['muatan'],
				'jenis_angkutan' => $_POST['jenis_angkutan']
				);
		
		$exec= $db->insert($tabel, $data);
		
	echo "<script>window.location='index.php?x=kendaraan'</script>";
}else{
	$data = array( 
				'nia' => $_POST['nia'],
				'nopol' => $_POST['nopol'],
				'nik' => $_POST['nik'],
				'id_jenis' => $_POST['id_jenis'],
				'milik' => '',
				'jasa' => '',
				'tahunbuat' => $_POST['tahunbuat'],
				'merek' => '',
				'nomesin' => $_POST['nomesin'],
				'nosasis' => $_POST['nosasis'],
				'stnk' => $_POST['stnk'],
				'kir' => '',
				'id_cabang' => $_POST['id_cabang'],
				'id_pegawai' => $_POST['id_supir'],
				'km' => $_POST['km'],
				'muatan' => $_POST['muatan'],
				'jenis_angkutan' => $_POST['jenis_angkutan']
				);
		
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=kendaraan'</script>";
}
?>