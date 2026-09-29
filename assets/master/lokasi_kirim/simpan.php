<?php
$tabel = "ex_lokasi_kirim";
if($_POST[kode]==''){
		$max=$db->select("ex_lokasi_kirim","max(id)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id' => $id, 
				'lokasi_kirim' => $_POST['lokasi'],
				'kota' => $_POST['kota'],
				'status' => 1,
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=lokkir'</script>";
}else{
	$data = array( 
				'lokasi_kirim' => $_POST['lokasi'],
				'kota' => $_POST['kota'],
		 );
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=lokkir'</script>";
}


?>