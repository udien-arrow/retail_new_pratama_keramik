<?php
$tabel = "m_regional";
if($_POST[kode]==''){
		$max=$db->select("m_regional","max(id)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id' => $id, 
				 'id_pegawai' => $_POST['pegawai'],
				 'id_wilayah' => $_POST['wilayah'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=regavp'</script>";
}else{
	$data = array(  
	'id_pegawai' => $_POST['pegawai'],
				 	'id_wilayah' => $_POST['wilayah'],
		 );
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=regavp'</script>";
}


?>