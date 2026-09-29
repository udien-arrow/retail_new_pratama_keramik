<?php
$tabel = "m_klaim_ktg";
if($_POST[kode]==''){
		$max=$db->select("m_klaim_ktg","max(id)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$ex=explode("/",$_POST['tgl_berlaku']);
		$data = array( 'id' => $id, 
				 'harga' => $_POST['harga'],
				 'tgl_berlaku' => $ex[2].'-'.$ex[0].'-'.$ex[1],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=klaimktg'</script>";
}


?>