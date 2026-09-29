<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_koreksi', 'tx_koreksi', 'KP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	/*$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$nofj=$db->nourut('no_faktur_jual', 'tx_piutang', 'FJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	*/
	$dttmp=$db->select("tx_koreksi_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		$gudang=$db->select("tx_do","id_gudang,id_cus","no_spj='$vals[no_piutang]'");
		foreach($gudang as $gud){}
		$k=explode("_",$_POST['kepala']);
		$id=$db->idurut("tx_koreksi","id_koreksi");
		$b=explode("-",$_POST['tgl']);
		$cab1=explode("/",$k[1]);
		$cab=intval($cab1[1]);
		if($vals['harga_ganti']>$vals['harga_awal']){$typ=0;}else{$typ=1;}
		$data = array( 
					'id_koreksi' => $id, 
					'no_koreksi' => $idgen, 
					'id_gudang' => $gud['id_gudang'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_cabang' => $cab,
					'status' => 0,
					'ket' => $_POST['kets'],
					'tgl_koreksi' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'no_ref' => $k[1],
					'no_fj' => $k[0],
					'jenis' => $vals['jenis'],
					'id_cus' => $gud['id_cus'],
					'type' => $typ, 
					'total' => $vals['harga_ganti'], 
					'total_sebelumnya' => $vals['harga_awal'],
					);
		$exec= $db->insert("tx_koreksi", $data);

		$where = array("id_user" => $_SESSION['ID_LOGIN']);
		$db->delete("tx_koreksi_tmp",$where);
		//=============================piutang=========================================
		$dataup = array( 
				'no_koreksi' => $idgen,
				);
		$exc= $db->update("tx_do",$dataup,"no_spj='$vals[no_piutang]'");
	}//end if jumlahx
	echo "<script>window.location='index.php?x=korpiutang'</script>";
?>