<?php
$tabel = "m_manualbook";
if($_POST[kode]==''){
		$max=$db->select("m_manualbook","max(id)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$fileName = $_FILES['image']['name'];
		$data = array( 'id' => $id, 
				 'nama' => $_POST['nama'],
				 'file' => $fileName,
				 'tgl' => date('Y-m-d'),
				);
		$exec= $db->insert($tabel, $data);
		move_uploaded_file($_FILES['image']['tmp_name'], "assets/master/manualbook/upload/".$_FILES['image']['name']);
	echo "<script>window.location='index.php?x=manualb'</script>";
}else{
	$data = array( 'nama_profit' => $_POST['nama'], 
	 			   'kode_profit' => $_POST['kode2'],
		 );
	$exec= $db->update($tabel, $data, "id_profit='$_POST[kode]'");
	echo "<script>window.location='index.php?x=manualb'</script>";
}


?>