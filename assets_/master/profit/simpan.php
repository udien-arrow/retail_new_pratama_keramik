<?php
$tabel = "m_profit";
if($_POST[kode]==''){
		$max=$db->select("m_profit","max(id_profit)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_profit' => $id, 
				 'nama_profit' => $_POST['nama'],
				 'kode_profit' => $_POST['kode2'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=profit'</script>";
}else{
	$data = array( 'nama_profit' => $_POST['nama'], 
	 			   'kode_profit' => $_POST['kode2'],
		 );
	$exec= $db->update($tabel, $data, "id_profit='$_POST[kode]'");
	echo "<script>window.location='index.php?x=profit'</script>";
}


?>