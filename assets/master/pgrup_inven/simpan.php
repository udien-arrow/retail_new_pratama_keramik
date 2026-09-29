<?php
$tabel = "m_grup";
	$per=explode("-",$_POST[persediaan]);
	$cogs=explode("-",$_POST[cogs]);
	$intran=explode("-",$_POST[intransit]);
	$intranc=explode("-",$_POST[intransitcabang]);
	$sales=explode("-",$_POST[sales]);
	$bongkar=explode("-",$_POST[waste]);
	$riject=explode("-",$_POST[riject]);
	$muat=explode("-",$_POST[muat]);
	$pok=explode("-",$_POST[pok]);
	
	$jum=count($db->select("m_grup","*","id_sub='$_POST[jen]'"));
	if($jum==0){
		$data = array( 
					'inventory' => $per[0], 
					'cogs' => $cogs[0], 
					'intransit' => $intran[0],
					'intransitcabang' => $intranc[0],
					'bongkar' => $bongkar[0],
					'id_sub' => $_POST['jen'], 
					'jenis' => $_POST['nama'], 
			 );
		$exec= $db->insert($tabel, $data);
	}else{
		$data = array( 
					'inventory' => $per[0], 
					'cogs' => $cogs[0],
					'intransit' => $intran[0],
					'intransitcabang' => $intranc[0],
					'bongkar' => $bongkar[0], 
					'jenis' => $_POST['nama'], 
			 );
		$exec= $db->update($tabel, $data, "id_grup='$_POST[kode]'");
	}
	
	echo "<script>window.location='index.php?x=pbar'</script>";



?>