<?php
$tabel = "m_perusahaan";
if($_POST[kode]==''){
		$max=$db->select("m_perusahaan","max(id_perusahaan)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 
				 'id_perusahaan' => $id, 
				 'kode_perusahaan' => $_POST['kode1'],
				 'nama_perusahaan' => $_POST['nama'],
				 'kota' => $_POST['kota'],
				 'fax' => $_POST['no_fax'],
				 'email' => $_POST['email'],
				 'alamat' => $_POST['alamat'],
				 'telp1' => $_POST['telp1'],
				 'telp2' => $_POST['telp2'],
				 'npwp' => $_POST['npwp'],
				 'siup' => $_POST['siup'],
				 'status' => 1
				);
		
		$exec= $db->insert($tabel, $data);
		
	echo "<script>window.location='index.php?x=perusahaan'</script>";
}else{
	$data = array( 
				 'kode_perusahaan' => $_POST['kode1'],
				 'nama_perusahaan' => $_POST['nama'],
				 'kota' => $_POST['kota'],
				 'fax' => $_POST['no_fax'],
				 'email' => $_POST['email'] ,
				 'alamat' => $_POST['alamat'],
				 'telp1' => $_POST['telp1'],
				 'telp2' => $_POST['telp2'],
				 'npwp' => $_POST['npwp'],
				 'siup' => $_POST['siup']
		 );
	$exec= $db->update($tabel, $data, "id_perusahaan='$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=perusahaan'</script>";
}


?>