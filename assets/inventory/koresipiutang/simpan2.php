<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_koreksi', 'tx_koreksi_piutang', 'KH', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	/*$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$nofj=$db->nourut('no_faktur_jual', 'tx_piutang', 'FJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	*/
	$dttmp=$db->select("tx_koreksi_piutang_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		
		$gudang=$db->select("pj_penjualan","*","no_penjualan='$idgud[1]'");	
		foreach($gudang as $gud){}	
				
		///
		$k=explode("_",$_POST['kepala']);
		$id=$db->idurut("tx_koreksi_piutang","id_koreksi");
		$b=explode("-",$_POST['tgl']);
		$cab1=explode("/",$k[1]);
		$cab=intval($cab1[1]);
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
					);
		$exec= $db->insert("tx_koreksi_piutang", $data);
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$idl=$db->idurut("tx_koreksi_piutang_dtl","id_dtl");
			$total_piutang=$total_piutang+($valtmp['qty']*$valtmp['harga_awal']);
			$data = array( 
					'id_dtl' => $idl, 
					'no_piutang' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'sat' => $valtmp['id_satuan'], 
					'harga_awal' => $valtmp['harga_awal'],
					'hpp_akhir' => $valtmp['hpp'],
					'harga_ganti' => $valtmp['harga_ganti'],
					'ket' => $valtmp['ket'],
					'id_gudang' =>  $gud['id_gudang'],
					'qty' => $valtmp['qty'],
					'status' => 0,
					);
			$exec= $db->insert("tx_koreksi_piutang_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			
			
			
			
			
			$totawal=$totawal+($valtmp['harga_awal']*$valtmp['qty']);
			$totganti=$totganti+($valtmp['harga_ganti']*$valtmp['qty']);
			$db->delete("tx_koreksi_piutang_tmp",$where);
		}
		//=============================piutang=========================================
		if($totganti>$totawal){$typ=0;}else{$typ=1;}
		$data = array( 
					'type' => $typ, 
					'total' => $totganti, 
					'total_sebelumnya' => $total_piutang, 
					);
		$exec= $db->update("tx_koreksi_piutang", $data,"no_koreksi='$idgen'");
		//=============================piutang =========================================

		$data = array( 
					'total_piutang' => $totganti, 
					);
		$exec= $db->update("tx_piutang", $data,"no_faktur_jual='$vals[no_piutang]'");		
		//===============update===================//
		$dataup = array( 
				'no_faktur' => $idgen,
				);
		$exc= $db->update("pj_penjualan",$dataup,"no_penjualan='$vals[no_piutang]'");
	}//end if jumlahx
	echo "<script>window.location='index.php?x=korpi'</script>";
?>