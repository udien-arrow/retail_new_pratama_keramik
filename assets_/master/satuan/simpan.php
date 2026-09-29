<?php
$tabel = "m_satuan";
if($_POST[kode]==''){
		$max=$db->select("m_satuan","max(id_satuan)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_satuan' => $id, 
				 'nama_satuan' => $_POST['nama'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=satuan'</script>";
}else{
	$data = array( 'nama_satuan' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_satuan='$_POST[kode]'");
	echo "<script>window.location='index.php?x=satuan'</script>";
}


?>