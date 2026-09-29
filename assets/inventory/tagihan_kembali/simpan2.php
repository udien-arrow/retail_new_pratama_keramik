<?php
	$tgl=date('Y-m-d');
	$temp=$db->select("tx_tagihan_kembali_tmp","*","id_user='$_SESSION[ID_LOGIN]' and no_tagihan='$_POST[links]'");
	foreach($temp as $tak){}		
		$idgen=$db->nourut('no_ta', 'tx_tagihan_kembali', 'TK', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
		$id=$db->idurut("tx_tagihan_kembali","id");
		$b=explode("-",$_POST['tgl']);
		$data = array( 
					'id' => $id, 
					'no_ta' => $idgen, 
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'ket' => $_POST['kets'],
					'tgl' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'no_ref' => $_POST['links']
					);
		$exec= $db->insert("tx_tagihan_kembali", $data);		
		$b=explode("-",$_POST['jatuhtem']);
		//update buku tagihan
		
		foreach($temp as $tmp){
		$iddtl=$db->idurut("tx_tagihan_kembali_dtl","id_dtl");
		$data = array( 
					'id_dtl' => $iddtl, 
					'no_ta' => $idgen, 
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => 0,
					'no_spj' => $tmp['no_spj'],
					'no_fj' => $tmp['no_fj'],
					'total_piutang' =>  $tmp['total_piutang'],
					'dibayar' =>  $tmp['dibayar'],
					'jenis_pem' =>  $tmp['jenis_pem'],
					'nama_bank' =>  $tmp['nama_bank'],
					'jatuh_tempo' =>  $tmp['jatuh_tempo'],
					'no_seribg' =>  $tmp['no_seribg'],
					'no_rekening' =>  $tmp['no_rekening'],
					'id_cus' => $tmp['id_cus'],
					'tempo_normal' => $tmp['tempo_normal'],
					'tempo_tambahan' => $tmp['tempo_tambahan'],
					'urut' => $tmp['urut'],
					);
		$exec= $db->insert("tx_tagihan_kembali_dtl", $data);
		$where = array(
						"id_tmp" => $tmp['id_tmp']
						);
				$db->delete("tx_tagihan_kembali_tmp",$where);
		}
	echo "<script>window.location='index.php?x=tagkem&id=$_POST[links]'</script>";
?>