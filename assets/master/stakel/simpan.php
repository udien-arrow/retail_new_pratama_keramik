<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_statuskel";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_statuskel");
		$data = array( 'id_statuskel' => $id, 
				 	   'statuskel' => $_POST['nama'],
					   'tglstatus' => $tgl,
					   'ket' => $_POST['ket'],
					   'useridstatuskel' => $_SESSION['ID_LOGIN'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=stakel'</script>";
}else{
	$data = array( 
					'statuskel' => $_POST['nama'], 
					'ket' => $_POST['ket'],
		 );
	$exec= $db->update($tabel, $data, "id_statuskel='$_POST[kode]'");
	echo "<script>window.location='index.php?x=stakel'</script>";
}


?>