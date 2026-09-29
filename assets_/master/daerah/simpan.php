<?php
$tabel = "m_daerah";
if($_POST[kode]==''){
		$max=$db->select("m_daerah","max(id_daerah)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_daerah' => $id, 
				'id_wilayah' => $_POST['wilayah'],
				'id_cabang' => $_POST['cabang'],
				'id_area' => $_POST['area'],
				'id_gudang' => $_POST['gudang'],
				'kode_daerah' => $_POST['kode2'],
				'nama_daerah' => $_POST['nama'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=daerah'</script>";
}else{
	$data = array( 
				'id_wilayah' => $_POST['wilayah'],
				'id_cabang' => $_POST['cabang'],
				'id_area' => $_POST['area'],
				'id_gudang' => $_POST['gudang'],
				'kode_daerah' => $_POST['kode2'],
				'nama_daerah' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_daerah='$_POST[kode]'");
	echo "<script>window.location='index.php?x=daerah'</script>";
}


?>