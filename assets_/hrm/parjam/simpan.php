<?php
$tabel = "hr_m_jamsos";
if($_POST[kode]==''){
		$max=$db->select("hr_m_jamsos","max(id_jamsos)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$tgl=explode("/",$_POST['berlaku']);
		$data = array( 'id_jamsos' => $id, 
				 'tarif_perusahaan' => $_POST['per'],
				 'umr' => $_POST['umr'],
				 'tarif_bayar' => $_POST['bayar'],
				 'tgl_berlaku' => $tgl[2].'-'.$tgl[0].'-'.$tgl[1],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=parjam'</script>";
}else{
	$tgl=explode("/",$_POST['berlaku']);	
	$data = array(  
				 'tarif_perusahaan' => $_POST['per'],
				 'umr' => $_POST['umr'],
				 'tarif_bayar' => $_POST['bayar'],
				 'tgl_berlaku' => $tgl[2].'-'.$tgl[0].'-'.$tgl[1],
				);
	$exec= $db->update($tabel, $data, "id_jamsos='$_POST[kode]'");
	echo "<script>window.location='index.php?x=parjam'</script>";
}


?>