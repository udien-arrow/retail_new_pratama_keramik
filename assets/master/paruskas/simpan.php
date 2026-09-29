<?php
$tabel = "ak_paruskas";
	$jenis=$_POST[type];
	$nama=$_POST[nama];
	$data = array( 'jenis' => $jenis, 
				   'nama' => $nama, 
				   'status' => "1",
				    
		 );
	$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=paramarus'</script>";



?>