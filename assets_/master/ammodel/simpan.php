<?php
$tabel = "am_model";
if($_POST[kode]==''){
		$max=$db->select("am_model","max(ID_AMODEL)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'ID_AMODEL' => $id, 
				'ID_AKATAGORI' => $_POST['kat'],
				'NAMA_AMODEL' => $_POST['nama'],
				'NOMOR_AMODEL' => $_POST['nomo'],
				'KETERANGAN_AMODEL' => $_POST['ketmo'],
				'EOL_AMODEL' => $_POST['eolmo'],
				'ID_DEPRESIASI' => $_POST['depres'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=asetmodel'</script>";
}else{
	$ck=$db->select("am_model","*","ID_AMODEL='$_POST[kode]'");
	foreach($ck as $cek){}
	if($cek['EOL_AMODEL']==$_POST['eolmo'])
	{
		$has=$_POST['eolmo'];
	}else{
		//cek aset
		$has=$_POST['eolmo'];
		$ks=$db->select("am_asset","*","ID_AMODEL='$_POST[kode]'");
		foreach($ks as $wp){
		//cek depresiasi
		$dp=$db->select("am_depresiasi_in","*,sum(BIAYA_PENYUSUTAN) as biaya","ID_ASSET='$wp[ID_AMASSET]'");
		foreach($dp as $dep){
		$nilai=round($dep['biaya']);
		//echo $nilai." - ".$wp['ASSET_HARGABELI']."<br>";
		if($wp['ASSET_HARGABELI']<>$nilai){	
			$ok=$wp['ASSET_HARGABELI']-$nilai;
			//echo $wp['DEPRESIASI_KE']."<br>";
			//echo $_POST['eolmo']."<br>";
			$eol=$_POST['eolmo']-$wp['DEPRESIASI_KE'];
			$sil=$ok/$eol;
			//echo $sil." - ".$wp['ID_AMASSET']."<br>";
			$data = array( 
				'BIAYA_PENYUSUTAN' => $sil,
		 	);
			$exec= $db->update("am_asset", $data, "ID_AMASSET='$wp[ID_AMASSET]'");
		}
			}
		}
	}
	$data = array( 
				'ID_AKATAGORI' => $_POST['kat'],
				'NAMA_AMODEL' => $_POST['nama'],
				'NOMOR_AMODEL' => $_POST['nomo'],
				'KETERANGAN_AMODEL' => $_POST['ketmo'],
				'EOL_AMODEL' => $has,
		 );
	$exec= $db->update($tabel, $data, "ID_AMODEL='$_POST[kode]'");
	echo "<script>window.location='index.php?x=asetmodel'</script>";
}


?>