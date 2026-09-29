<?php
$tabel = "am_asset";
$date=date("Y-m-d");
$tahun=date("Y");
$bulan=date("m");
		$ks=$db->select("am_maintenance","max(NO_AMM) as has","SUBSTR(NO_AMM,5,4)='$tahun' and SUBSTR(NO_AMM,9,2)='$bulan'");
		foreach($ks as $kas){}
		$pl=explode(".",$kas['has']);
		$jad=$pl['2']+1;
		$generate="AMM".".".date("Y").date("m").".".sprintf("%08s", $jad);
		$ex=explode("/",$_POST[date]);
		$data = array( 'ID_AMASSET' => $_POST['kode'], 
					   'TGL_MAINT' => $date,
					   'KET_MAINT' => $_POST['kethapus'], 
					   'USERID_MAINT' => $_SESSION['ID_LOGIN'],
					   'ST_ASSET' => $_SESSION['kode2'],
					   'NO_AMM' => $generate,
				);
		$exec= $db->insert("am_maintenance", $data);
		if($exec){
			$data = array( 'ASSET_STATUS' => '4'
						);
			$exec= $db->UPDATE($tabel, $data,"ID_AMASSET='$_POST[kode]'");
			
			}
/*	 */echo "<script>window.location='index.php?x=mainasset'</script>";
?>