<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no', 'tx_buku_tagihan', 'BT', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_buku_tagihan_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("tx_buku_tagihan","id");
		$b=explode("-",$_POST['tgl']);
		$data = array( 
					'id' => $id, 
					'no' => $idgen, 
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'status' => 0,
					'ket' => $_POST['kets'],
					'tgl' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					);
		$exec= $db->insert("tx_buku_tagihan", $data);
		foreach($dttmp as $valtmp){
			$id=$db->idurut("tx_buku_tagihan_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $id, 
					'no' => $idgen,
					'status' => 0,
					'total_piutang' => $valtmp['total_piutang'],
					'no_spj' => $valtmp['no_spj'],
					'no_fj' => $valtmp['no_fj'],
					'id_cus' => $valtmp['id_cus'],
					'tempo_normal' => $valtmp['tempo_normal'],
					'tempo_tambahan' => $valtmp['tempo_tambahan'],
					'tgl_spj' => $valtmp['tgl_spj'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'n_tempo_n' => $valtmp['n_tempo_n'],
					'n_tempo_t' => $valtmp['n_tempo_t'],
					'tgl' => $valtmp['tgl']
					);
		$exec= $db->insert("tx_buku_tagihan_dtl", $data);
		$where = array("id_user" => $_SESSION['ID_LOGIN']);
		$db->delete("tx_buku_tagihan_tmp",$where);
		}
	}//end if jumlahx
	echo "<script>window.location='index.php?x=bukta'</script>";
?>