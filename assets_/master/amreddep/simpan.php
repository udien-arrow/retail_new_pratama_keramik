<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "am_deployed";
if($_POST[kode]!=''){
		$max=$db->select("am_reqdeploy","*","ID_REQDEPLOY='$_POST[kode]'");
		foreach($max as $val){}
		$ex=explode("/",$_POST[tgldep]);
		$data = array( 
					   'ID_ALOKASI' => $val['ID_ALOKASI'],
					   'ID_AMASSET' => $val['ID_AMASSET'],
					   'ID_REQ' => $_POST['kode'], 
					   'DEPLOY_DATE' => $ex[2]."-".$ex[0]."-".$ex[1],
					   'DEPLOY_KETERANGAN' => $_POST['catdep'], 
					   'DEPLOY_PEGAWAI' => $_SESSION['ID_LOGIN'],
					   'STATUS' => '1', 
					   'ST2' => '1',
				);
		$exec= $db->insert($tabel, $data);
		if($exec){
			$data = array( 
					  		 'STATUS' => '3', 
					);
			$exec1= $db->update("am_reqdeploy", $data,"ID_REQDEPLOY='$_POST[kode]'");
			$data = array( 
					  		 'ASSET_STATUS' => '3', 
					);
			$exec2= $db->update("am_asset", $data,"ID_AMASSET='$val[ID_AMASSET]'");		
			}
/*	*/echo "<script>window.location='index.php?x=reddep'</script>"; 
}


?>