<?php
$tabel = "m_retribusi";
if($_POST[kode]==''){
		$max=$db->select("m_retribusi","max(id_retribusi)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 
				'id_retribusi' => $id, 
				 'nama_retribusi' => $_POST['nama'],
				 'st_franco' => $_POST['franco'],
				 'st_locco' => $_POST['locco'],
				 'st_da' => $_POST['da'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=retribusi'</script>";
}else{
	$data = array( 
				 'nama_retribusi' => $_POST['nama'],
				 'st_franco' => $_POST['franco'],
				 'st_locco' => $_POST['locco'],
				 'st_da' => $_POST['da'],
				);
	$exec= $db->update($tabel, $data, "id_retribusi='$_POST[kode]'");
	echo "<script>window.location='index.php?x=retribusi'</script>";
}


?>