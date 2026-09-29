<?php
$tabel = "m_wilayah_pem";
if($_POST[kode]==''){
		$max=$db->select("m_wilayah_pem","max(id_wilayah)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_wilayah' => $id, 
				 'nama_wilayah' => $_POST['nama'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=wilayahpem'</script>";
}else{
	$data = array( 'nama_wilayah' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_wilayah='$_POST[kode]'");
	echo "<script>window.location='index.php?x=wilayahpem'</script>";
}


?>