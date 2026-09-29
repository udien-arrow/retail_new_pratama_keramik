<?php
$tabel = "preferences";
if($_POST[id_pref]==''){
		$max=$db->select("preferences","max(id_pref)as id");
		foreach($max as $val){}
		$folder ="logo/";
		$id=$val['id']+1;
		$logo = $_FILES['logo']['name'];
		$tmp = $_FILES['logo'] ['tmp_name'];
		$upload = $folder.$logo;
		move_uploaded_file($tmp,$upload);
		$data = array( 
				 'id_pref' => $id, 
				 'nopref' => $_POST['nopref'],
				 'nama_perusahaan' => $_POST['nama'],
				 'alamat' => $_POST['alamat'],
				 'npwp' => $_POST['npwp'],
				 'no_telp' => $_POST['telp'],
				 'logo' => $logo
				);
		$exec= $db->insert($tabel, $data);
		
	echo "<script>window.location='index.php?x=pref'</script>";
}else{
	
	$folder ="logo/$_POST[logo1]";
	unlink($folder);
		$folder1 ="logo/";
		$logo = $_FILES['logo']['name'];
		$tmp = $_FILES['logo'] ['tmp_name'];
		$upload = $folder1.$logo;
		move_uploaded_file($tmp,$upload);
	$data = array( 
				 'nopref' => $_POST['nopref'],
				 'nama_perusahaan' => $_POST['nama'],
				 'alamat' => $_POST['alamat'],
				 'npwp' => $_POST['npwp'],
				 'no_telp' => $_POST['telp'],
				 'logo' => $logo 
				 
		 );
	$exec= $db->update($tabel, $data, "id_pref='$_POST[id_pref]'");
	
	echo "<script>window.location='index.php?x=pref'</script>";
}


?>