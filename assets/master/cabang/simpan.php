<?php
$tabel = "m_cabang";
if($_POST[kode]==''){
		$max=$db->select("m_cabang","max(id_cabang)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_cabang' => $id, 
				 'kode_cabang' => $_POST['kode1'],
				 'nama_cabang' => $_POST['nama'],
				 'no_telp' => $_POST['no_telp'],
				 'no_fax' => $_POST['no_fax'],
				 'alamat' => $_POST['alamat'],
				 'npwp' => $_POST['npwp'],
				 'status' => 1,
				 'email' => $_POST['email'],
				 'kordinat' => $_POST['kordinat'],
				 'id_wilayah_pem' => $_POST['wilayah_pem']
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=cabang'</script>";
}else{
	$data = array( 
				 'kode_cabang' => $_POST['kode1'],
				 'nama_cabang' => $_POST['nama'],
				 'no_telp' => $_POST['no_telp'],
				 'no_fax' => $_POST['no_fax'],
				 'alamat' => $_POST['alamat'],
				 'npwp' => $_POST['npwp'],
				 'email' => $_POST['email'],
				 'kordinat' => $_POST['kordinat'],
				 'id_wilayah_pem' => $_POST['wilayah_pem'] 
		 );
	$exec= $db->update($tabel, $data, "id_cabang='$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=cabang'</script>";
}


?>