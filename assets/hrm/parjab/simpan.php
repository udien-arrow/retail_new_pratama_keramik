<?php
$tabel = "hr_param_fasjab";
if($_POST[kode]==''){
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=parjab'</script>";
}else{	
	$data = array(  
				 'nominal' => $_POST['nominal'],
				);
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=parjab'</script>";
}


?>