<?php
$tabel = "m_jenis_kendaraan";
if($_POST[kode]==''){
		$max=$db->select("m_jenis_kendaraan","max(id_jenis)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_jenis' => $id, 
				 'nama' => $_POST['nama']
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=jen_kend'</script>";
}else{
	$data = array( 
			'nama' => $_POST['nama'] 
		 );
	$exec= $db->update($tabel, $data, "id_jenis='$_POST[kode]'");
	echo "<script>window.location='index.php?x=jen_kend'</script>";
}


?>