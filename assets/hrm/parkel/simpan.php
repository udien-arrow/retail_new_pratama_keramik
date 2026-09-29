<?php
$tabel = "hr_param_tunjkel";
if($_POST[kode]==''){
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=parkel'</script>";
}else{	
	$data = array(  
				 'id_wilayah' => $_POST['wilayah'],
				 'nominal' => $_POST['nominal'],
				);
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=parkel'</script>";
}


?>