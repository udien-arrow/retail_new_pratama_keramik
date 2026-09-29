<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_claim', 'ex_claim_pab', 'CP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("ex_claim_pab_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		$id=$db->idurut("ex_claim_pab","id_claim");
		$b=explode("-",$_POST['tgl']);
		foreach($kep as $pala){}
		$data = array( 
					'id_claim' => $id, 
					'no_claim' => $idgen, 
					'id_gudang' => $vals['id_gudang'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'status' => 0,
					'ket' => $_POST['kets'],
					'tgl_claim' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'no_ref' => $_POST['kepala'],
					);
		$exec= $db->insert("ex_claim_pab", $data);
		foreach($dttmp as $valtmp){
			$id=$db->idurut("ex_claim_pab_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $id, 
					'no_claim' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'sat' => $valtmp['sat'], 
					'qty_retur' => $valtmp['qty_retur'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'qty_claim' => $valtmp['qty_claim'],
					'id_gudang' => $valtmp['id_gudang'],
					'total' => $valtmp['total'],
					'id_sup' => $valtmp['id_sup'],
					'status' => 0,
					);
			
			$exec= $db->insert("ex_claim_pab_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("ex_claim_pab_tmp",$where);
		}	
	}//end if jumlah
	echo "<script>window.location='index.php?x=claimpb'</script>";
?>