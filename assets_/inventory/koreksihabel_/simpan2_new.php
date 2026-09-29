<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_koreksi', 'tx_koreksi_piutang', 'KP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$nofp=$db->nourut('no_faktur_pajak', 'tx_piutang', 'FP', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$nofj=$db->nourut('no_faktur_jual', 'tx_piutang', 'FJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	
	$dttmp=$db->select("tx_koreksi_piutang_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		$gudang=$db->select("tx_do","*","no_spj='$vals[no_piutang]'");
		foreach($gudang as $gud){}
		$k=explode("_",$_POST['kepala']);
		$piut=$db->select("tx_piutang","*","no_ref='$k[1]' ORDER BY id_piutang DESC limit 0,1");
		foreach($piut as $tang){}
		if($vals['jenis']==0){
			$fjn=$tang['no_faktur_jual'];
			$fpn=$tang['no_faktur_pajak'];	
		}else{
		  if($vals['harga_ganti'] > $vals['harga_awal']){	
			$fjn=$nofj;
			$fpn=$nofp;
			$typ=0;  
		  }else{
			$fjn=$tang['no_faktur_jual'];
			$fpn=$tang['no_faktur_pajak'];	
			$typ=1;
		  }
		}
		if($vals['harga_ganti'] > $vals['harga_awal']){
			$stb=0;
		}if($vals['harga_ganti'] < $vals['harga_awal']){
			$stb=$tang['status_bayar'];
		}
		
		///
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
					'jenis' => $vals['jenis'],
					'id_cus' => $gud['id_cus'],
					'type' => $typ,
					);
		$exec= $db->insert("tx_koreksi_piutang", $data);
		//echo $typ.'-'.$vals['harga_awal'].'-'.$stb;
		//die();
		foreach($dttmp as $valtmp){
			//$hap=$db->select("tx_do_dtl","*","no_spj='$vals[no_piutang]' and id_barang='$valtmp[id_barang]'");
			//foreach($hap as $hp){}
			//$hapr=$db->select("tx_retur_pen_dtl a lef join b on a.no_retur=b.no_retur","a.qty_kembali","b.no_ref='$vals[no_piutang]' and id_barang='$valtmp[id_barang]'");
			//foreach($hapr as $hpr){}
			$supp=$valtmp['id'];
			$idl=$db->idurut("tx_koreksi_piutang_dtl","id_dtl");
			$total_piutang=$total_piutang+($valtmp['qty']*$valtmp['harga_ganti']);
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
		$db->delete("tx_koreksi_piutang_tmp",$where);
		}
		
		$ret = array( 
				'status' => 0,
				);
		$exc= $db->update("tx_piutang",$ret,"no_ref='$k[1]'");
		$idp=$db->idurut("tx_piutang","id_piutang");
		//=============================piutang=========================================
			
		
		$dataj = array(
			'id_piutang' => $idp,
			'no_faktur_jual' => $fjn, 
			'no_faktur_pajak' => $fpn,
			'no_ref' => $k[1],
			'status' => 1,
			'tgl' => $tgl,
			'total_piutang' => $total_piutang,
			'id_cus' => $gud['id_cus'],
			'id_user' => $_SESSION['ID_LOGIN'],
			'tempo_normal' => $tang['tempo_normal'], 
			'tempo_tambahan' => $tang['tempo_tambahan'],		
			'jenis_jual' => $tang['jenis_jual'], 
			'jenis_kirim' => $tang['jenis_kirim'], 
			'status_bayar' => $stb, 
			'id_cabang' => $tang['id_cabang'],
			'n_tempo_n' => $tang['n_tempo_n'], 
			'n_tempo_t' => $tang['n_tempo_t'],
			'stampdate' => date("Y-m-d H:i:s"),
			);
		$exc= $db->insert("tx_piutang",$dataj);
		$dataup = array( 
				'no_koreksi' => $idgen,
				);
		$exc= $db->update("tx_do",$dataup,"no_spj='$vals[no_piutang]'");
	}//end if jumlahx
	echo "<script>window.location='index.php?x=korpi'</script>";
?>