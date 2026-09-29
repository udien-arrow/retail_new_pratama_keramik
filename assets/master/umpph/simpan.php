<?php
$tabel = "ak_umpph";
if(!empty($_POST[kode])){

	$data = array( 'st' => "2",
		 );
	$exec= $db->update($tabel, $data, "id_jenisum='$_POST[kode]'");
	
}
	$tgl=date("Y-m-d H:i:s");
	$per=explode("-",$_POST[akun]);
	$data = array( 'jenis_um' => $_POST[nama], 
					'account' => $per[0],
					'tgli' => $tgl
		 );
	$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=pph'</script>";
	
	


?>