<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "am_reqdeploy";
if($_POST[kode]==''){
		$max=$db->select("am_reqdeploy","max(ID_REQDEPLOY)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$ex=explode("/",$_POST[date]);
		$data = array( 'ID_REQDEPLOY' => $id, 
					   'ID_ALOKASI' => $_POST['mod'],
					   'ID_AMASSET' => $_POST['na'], 
					   'REQDEPLOY_DATE' => $ex[2]."-".$ex[0]."-".$ex[1],
					   'STAMPDATE' => $tgl, 
					   'REQDEPLOY_KETERANGAN' => $_POST['ket'], 
					   'REQDEPLOY_PEGAWAI' => $_SESSION['ID_LOGIN'],
					   'STATUS' => '0', 
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=reqdeploy'</script>";
}else{
	$data = array( 
				
				'ID_ALOKASI' => $_POST['mod'],
					   'ID_AMASSET' => $_POST['na'], 
					   'REQDEPLOY_DATE' => $tgl,
					   'STAMPDATE' => $tgl, 
					   'REQDEPLOY_KETERANGAN' => $_POST['ket'], 
					   'REQDEPLOY_PEGAWAI' => $_SESSION['pegawai'],
					   'STATUS' => '0', 
		 );
	$exec= $db->update($tabel, $data, "ID_REQDEPLOY='$_POST[kode]'");
	echo "<script>window.location='index.php?x=reqdeploy'</script>";
}


?>