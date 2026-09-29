<?php
$tabel = "m_jenis_kendaraan_dtl";
if($_POST[kode]==''){
		$max=$db->select("m_jenis_kendaraan_dtl","max(id_dtl)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_dtl' => $id, 
				 'id_jenis' => $_POST['id_jenis'],
				 'bbm' => $_POST['bbm'],
				 'muatan' => $_POST['muatan']
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=jen_kend_d&id_jen=$_POST[id_jenis]'</script>";
}else{
	$data = array( 
			'id_jenis' => $_POST['id_jenis'],
				 'bbm' => $_POST['bbm'],
				 'muatan' => $_POST['muatan']
		 );
	$exec= $db->update($tabel, $data, "id_dtl='$_POST[kode]'");
	echo "<script>window.location='index.php?x=jen_kend_d&id_jen=$_POST[id_jenis]'</script>";
}


?>