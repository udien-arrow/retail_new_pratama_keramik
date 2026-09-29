<?php
$tabel = "hr_param_ikbat";
if($_POST[kode]==''){
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=parban'</script>";
}else{	
	$data = array(  
				 'masa_kerja' => $_POST['masa'],
				 'masa_kerja_akhir' => $_POST['akhir'],
				 'nominal' => $_POST['nominal'],
				);
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=parban'</script>";
}


?>