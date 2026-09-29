<?php
$tabel = "m_grup";
if($_POST[kode]==''){

}else{
	$data = array( 
				 'inventory' => $_POST['inven1'],
				 'jenis' => $_POST['jenis'],
				 'cogs' => $_POST['cogs'],
				 'inventory_afk' => $_POST['invent'],
				 'intransit' => $_POST['intransit']
		 );
	$exec= $db->update($tabel, $data, "id_grup='$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=parju'</script>";
}


?>