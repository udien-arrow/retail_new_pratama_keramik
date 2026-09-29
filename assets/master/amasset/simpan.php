<?php
$tabel = "am_asset";
if($_POST[kode]==''){		
		$max=$db->select("am_asset","max(ID_AMASSET)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$ex=explode("/",$_POST[date]);
		$sk=$db->select("am_model","*","ID_AMODEL='$_POST[mod]'");
		foreach($sk as $ks){}
		$k=sprintf("%02s", $_POST['mod']);
		$tahun=date("Y");
		$bulan=date("m");
		$ce=$db->select("am_asset","max(ID_NIA) as ID_NIA","substr(ID_NIA,1,2)='$k' and SUBSTR(ID_NIA,4,4)='$tahun' and SUBSTR(ID_NIA,8,2)='$bulan'");
		foreach($ce as $cek){}
		$pl=explode(".",$cek['ID_NIA']);
		$jad=$pl[2]+1;
		$hit=str_replace(",","",$_POST['pri'])/$ks['EOL_AMODEL'];
		$generate=sprintf("%02s",$_POST['mod']).".".date("Y").date("m").".".sprintf("%08s", $jad);
		//echo $generate;
		$data = array( 'ID_AMASSET' => $id, 
					   'ID_NIA' => $generate,
					   'ID_AMODEL' => $_POST['mod'],
					   'ASSET_TAG' => $_POST['tag'], 
					   'ASSET_STATUS' => '1',
					   'ASSET_SN' => $_POST['sn'], 
					   'ASSET_NAME' => $_POST['nama'], 
					   'ASSET_PURCHASE' => $ex[2]."-".$ex[0]."-".$ex[1],
					   'ASSET_HARGABELI' => str_replace(",","",$_POST['pri']), 
					   'ASSET_WARRANTY' => $_POST['wa'],
					   'ASSET_KETERANGAN' => $_POST['ket'], 
					   'BIAYA_PENYUSUTAN' => $hit, 
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=asset'</script>";
}else{
	$data = array( 
					   'ID_AMASSET' => $id, 
					   'ID_AMODEL' => $_POST['mod'],
					   'ASSET_TAG' => $_POST['tag'], 
					   'ASSET_SN' => $_POST['sn'], 
					   'ASSET_NAME' => $_POST['nama'], 
					   'ASSET_PURCHASE' => $ex[2]."-".$ex[0]."-".$ex[1],
					   'ASSET_HARGABELI' => $_POST['pri'], 
					   'ASSET_WARRANTY' => $_POST['wa'],
					   'ASSET_KETERANGAN' => $_POST['ket'], 
		 );
	$exec= $db->update($tabel, $data, "ID_AMASSET='$_POST[kode]'");
	echo "<script>window.location='index.php?x=asset'</script>";
}


?>