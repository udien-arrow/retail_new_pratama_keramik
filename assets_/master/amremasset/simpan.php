<?php
$tabel = "am_asset";
$date=date("Y-m-d");
		
		$ex=explode("/",$_POST[date]);
		$data = array( 'ID_AMASSET' => $_POST['kode'], 
					   'TGL_REMASSET' => $date,
					   'KET_REMASSET' => $_POST['kethapus'], 
					   'JENIS_REMASSET' => $_POST['jhapus'],
					   'USERID_REMASSET' => $_SESSION['ID_LOGIN']
				);
		$exec= $db->insert("am_remasset", $data);
		if($exec){
			$data = array( 'ASSET_STATUS' => '5'
						);
			$exec= $db->UPDATE($tabel, $data,"ID_AMASSET='$_POST[kode]'");
			
			}
	 echo "<script>window.location='index.php?x=remaset'</script>";
?>