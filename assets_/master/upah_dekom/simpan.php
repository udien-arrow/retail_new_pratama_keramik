<?php
$tabel = "hr_upah_dekom";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"id");
		$data = array( 
		
		
		
		
		
		
		
				 'id' => $id, 
				 'id_jabatan' => $_POST['jabatan'],
				 'nominal' => $_POST['nominal'],
				 
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=upahdekom'</script>";
}else{
	$data = array( 
				'nominal' => $_POST['nominal'], 
				'id_jabatan' => $_POST['jabatan'],
		 );
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=upahdekom'</script>";
}


?>