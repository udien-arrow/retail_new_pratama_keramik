<?php
$tabel = "m_negara";
if($_POST[kode]==''){
		$max=$db->select("m_negara","max(id_negara)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_negara' => $id, 
				 'nama_negara' => $_POST['nama'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=negara'</script>";
}else{
	$data = array( 'nama_negara' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_negara='$_POST[kode]'");
	echo "<script>window.location='index.php?x=negara'</script>";
}


?>