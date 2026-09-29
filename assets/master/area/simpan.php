<?php
$tabel = "m_area";
if($_POST[kode]==''){
		$max=$db->select("m_area","max(id_area)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_area' => $id, 
				 'nama_area' => $_POST['nama'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=area'</script>";
}else{
	$data = array( 'nama_area' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_area='$_POST[kode]'");
	echo "<script>window.location='index.php?x=area'</script>";
}


?>