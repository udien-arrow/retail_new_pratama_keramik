<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "am_deployed";
//echo"here";
if($_POST[kode]!=''){
	//echo"here";
		$max=$db->select("am_deployed","*","ID_DEPLOY='$_POST[kode]'");
		foreach($max as $val){}
		$ex=explode("/",$_POST[tgldep]);
		$data = array( 
					   'ID_ALOKASI' => $val['ID_ALOKASI'],
					   'ID_AMASSET' => $val['ID_AMASSET'],
					   'ID_REQ' => $_POST['kode'], 
					   'DEPLOY_DATE' => $ex[2]."-".$ex[0]."-".$ex[1],
					   'STAMPDATE' => $tgl,
					   'DEPLOY_KETERANGAN' => $_POST['catdep'], 
					   'DEPLOY_PEGAWAI' => $_SESSION['ID_LOGIN'],
					   'STATUS' => '2', 
					   'ST2' => '1', 
				);
		$exec= $db->insert($tabel, $data);
		if($exec){
			$data = array( 
					  		 'ST2' => '2', 
					);
			$exec1= $db->update("am_deployed", $data,"ID_DEPLOY='$_POST[kode]'");
			$data = array( 
					  		 'ASSET_STATUS' => '3', 
					);
			$exec2= $db->update("am_asset", $data,"ID_AMASSET='$val[ID_AMASSET]'");		
			}
/*	*/echo "<script>window.location='index.php?x=deployin'</script>"; 
}


?>