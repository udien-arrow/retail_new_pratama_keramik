<?php
$tabel = "ak_pum_tmp";
	$data = array( 
				 
				 'KEPERLUAN' => $_POST['keperluan'],
				 'JUMLAH' => str_replace(",","",$_POST['jml']),
				 'USER' => $_SESSION['ID_LOGIN'],
				
				
		 );
	$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=pum'</script>";

?>