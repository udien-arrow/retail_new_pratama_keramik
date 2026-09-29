<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "hr_m_tunjsehat";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id_tunjsehat");
		$data = array( 
					   'id_tunjsehat' => $id, 
				 	   'id_pangkat' => $_POST['pangkat'],
					   'id_statuskel' => $_POST['statuskel'],
					   'nominal' => $_POST['nama'],
					   'tgl_berlaku' => date("Y-m-d",strtotime($_POST[tgl])),
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=tunsehat'</script>";
}else{
	$data = array( 
					   'id_pangkat' => $_POST['pangkat'],
					   'id_statuskel' => $_POST['statuskel'],
					   'nominal' => $_POST['nama'],
					   'tgl_berlaku' => date("Y-m-d",strtotime($_POST[tgl])),
		 );
	$exec= $db->update($tabel, $data, "id_tunsehat='$_POST[kode]'");
	echo "<script>window.location='index.php?x=tunsehat'</script>";
}


?>