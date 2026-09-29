<?php
$tabel = "am_asset";
$date=date("Y-m-d");
$date2=date("Y-m-d H:i:s");
		
		$ex=explode("/",$_POST['pselesai']);
		$data = array( 'COMPLETE_MAINT' => $ex[2]."-".$ex[0]."-".$ex[1], 
					   'COST_MAINT' => str_replace(",","",$_POST['cost']),
					   'USERID_MAINT2' => $_SESSION['ID_LOGIN'],
					   'KET_KEMBALI' => $_POST['kethapus'],
					   'STAMP_COMPLETE' => $date2,
					   'STATUS_MAINT' => '2',
				);
		$exec= $db->update("am_maintenance", $data,"ID_MAINT='$_POST[kode]'");
		if($exec){
			$data = array( 'ASSET_STATUS' => 3
						);
			$exec= $db->UPDATE($tabel, $data,"ID_AMASSET='$_POST[kode3]'");
			}
/*	*/ echo "<script>window.location='index.php?x=mainasset'</script>"; 
?>