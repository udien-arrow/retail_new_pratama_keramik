<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_expediture', 'ex_expediture', 'EX', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("ex_expediture_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		$id=$db->idurut("ex_expediture","id_expediture");
		$k=explode("_",$_POST['links']);
		$b=explode("-",$_POST['tgl']);
		$expl=explode("/",$_POST['nos']);
		if(substr($expl[0],0,3)=='JWA'){
			$table = 'v_tx_expediture_jwa';
		}else{
			$table = 'v_tx_expediture';
		}
		$gg=$db->select($table,"*","no_so='$_POST[nos]'");
		foreach($gg as $wp){}
		$cek=$db->select("ex_customer","*","id_supp='$vals[id_supp]'");
		foreach($cek as $cak){}
		$data = array( 
					'id_expediture' => $id, 
					'no_expediture' => $idgen, 
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'ket' => $_POST['kets'],
					'tgl' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'id_lokasi' => $vals['id_tarifoa'],
					'no_so' => $wp['no_so'],
					'no_spj' => $wp['no_spj'],
					'id_kendaraan' => $vals['id_kendaraan'],
					'id_supp' => $vals['id_supp'],
					'n_tempo_n' => $cak['tempo_normal'], 
					'n_tempo_t' => $cak['tempo_tambahan'], 
					'tempo_normal' => date('Y-m-d', strtotime($cak['tempo_normal'].'days', strtotime($tgl))), 
					'tempo_tambahan' => date('Y-m-d', strtotime($cak['tempo_normal']+$cak['tempo_tambahan'].'days', strtotime($tgl))),
					);
		$exec= $db->insert("ex_expediture", $data);
	
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$id=$db->idurut("ex_expediture_dtl","id_dtl");
			$ggs=$db->select("ex_tarif_oa","*","id='$valtmp[id_tarifoa]'");
			foreach($ggs as $wps){}
			$nilai=$valtmp['qty_do']*$valtmp['berat']*$wps['tarif_oa'];
			$totaloa=$totaloa+($nilai=$valtmp['qty_do']*$valtmp['berat']*$wps['tarif_oa']);
			$data = array( 
					'id_dtl' => $id, 
					'no_expediture' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'id_satuan' => $valtmp['id_satuan'], 
					'id_gudang' => $valtmp['id_gudang'],
					'qty' => $valtmp['qty_do'],
					'status' => 0,
					'nilai_ao' => $nilai,
					'berat' => $valtmp['berat']
					);
			
			$exec= $db->insert("ex_expediture_dtl", $data);
		}
		$id=$db->idurut("ex_expediture_biaya_dtl","id");
		$data = array( 
					'id' => $id, 
					'no_expediture' => $idgen,
					'tgl' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'id_user' => $_SESSION['ID_LOGIN'],
					'gaji_sopir' => $wps['gaji_sopir'],
					'gaji_kernet' => $wps['gaji_kernet'],
					'ujs' => $wps['ujs'],
					'kosongan' => $wps['kosongan'],
					'premi' => $wps['premi'],
					);
		$exec= $db->insert("ex_expediture_biaya_dtl", $data);
		$data = array( 
					'tarif_ao' => $wps['tarif_oa'],
					'total_ao' => $totaloa,
					);
			$exec= $db->update("ex_expediture", $data,"no_expediture='$idgen'");
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("ex_expediture_tmp",$where);
	}
	echo "<script>window.location='index.php?x=txex'</script>";
?>