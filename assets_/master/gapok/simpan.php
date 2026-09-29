<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_indeks_gapok";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_index");
		$data = array( 'id_index' => $id, 
				 	   'nilai_index' => $_POST['nama'],
					   'tglinput_input' => $tgl,
					   'tgl_berlaku' => date("Y-m-d",strtotime($_POST[tgl])),
					   'userid_index' => $_SESSION['ID_LOGIN'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=gapok'</script>";
}else{
	$data = array( 
					   'nilai_index' => $_POST['nama'],
					   'tglinput_input' => $tgl,
					   'tgl_berlaku' => date("Y-m-d",strtotime($_POST[tgl])),
		 );
	$exec= $db->update($tabel, $data, "id_index='$_POST[kode]'");
	echo "<script>window.location='index.php?x=gapok'</script>";
}


?>