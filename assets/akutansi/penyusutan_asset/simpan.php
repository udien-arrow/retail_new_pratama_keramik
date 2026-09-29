	<?php
$m=date("m");
$y=date("Y");
$ce=$db->select("am_deployed group by ID_AMASSET","*");
foreach($ce as $cek){}
if($cek['ID_AMASSET']!=''){
$ck=$db->select("am_asset a
JOIN am_model b ON a.ID_AMODEL = b.ID_AMODEL
","a.*,b.ID_DEPRESIASI","b.JENIS_DEPRESIASI = 1
AND a.DEPRESIASI_KE < a.MASA_EKONOMIS
AND (
	a.ASSET_STATUS = '3'
	OR a.ASSET_STATUS = '4'
)");
foreach($ck as $cak){
	$sp=$db->select("am_depresiasi_in","*","ID_ASSET='$cak[ID_AMASSET]' and MONTH(STAMPDATE)='$m' and YEAR(STAMPDATE)='$y'");
	foreach($sp as $spc){}
	if(count($sp)=='0'){
	$data = array(  
				'ID_ASSET' => $cak['ID_AMASSET'], 
				'DEPRESIASI_KE' => $cak['DEPRESIASI_KE']+1,
				'BIAYA_PENYUSUTAN' => $cak['BIAYA_PENYUSUTAN'],
				'HARGA_BELI' => $cak['ASSET_HARGABELI'],
				'ID_DEPRESIASI' => $cak['ID_DEPRESIASI'],
				'STAMPDATE' => date("Y-m-d H:i:s"),
		);
			$execjur= $db->insert("am_depresiasi_in", $data);
			
			
		$data = array(  
				'DEPRESIASI_KE' => $cak['DEPRESIASI_KE']+1,
		);
			$execjur= $db->update("am_asset ", $data,"ID_AMASSET='$cak[ID_AMASSET]'");	
			
		$data = array(  
				'STATUS' => "1",
		);
			$execjur= $db->update("am_depresiasi_in", $data,"STATUS='0'");
			echo "<script>window.location='index.php?x=pensut'</script>";	
	
	
}else{
	
	echo "<script>window.location='index.php?x=pensut'</script>";
}
}
}
?>
