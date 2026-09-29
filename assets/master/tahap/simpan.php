<?php
$tabel = "m_tahap";
if($_POST[kode]==''){
		$max=$db->select("m_tahap","max(id_tahap)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_tahap' => $id, 
				 'nama_tahap' => $_POST['nama'],
				 'tgl_awal' => $_POST['awal'],
				 'tgl_akhir' => $_POST['akhir'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=tahap'</script>";
}else{
	$data = array( 'nama_tahap' => $_POST['nama'], 
	 '				tgl_awal' => $_POST['awal'],
				 	'tgl_akhir' => $_POST['akhir'],
		 );
	$exec= $db->update($tabel, $data, "id_tahap='$_POST[kode]'");
	echo "<script>window.location='index.php?x=tahap'</script>";
}


?>