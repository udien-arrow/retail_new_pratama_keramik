<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_retur', 'tx_retur_pen', 'RJ', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_retur_pen_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		$id=$db->idurut("tx_retur_pen","id_retur");
		$k=explode("_",$_POST['kepala']);
		$b=explode("-",$_POST['tgl']);
		foreach($dttmp as $valtmp){
		$jumlah_so=$jumlah_so+($valtmp['qty_kembali']*$valtmp['harga_jual']);
		}
		$data = array( 
					'id_retur' => $id, 
					'no_retur' => $idgen, 
					'id_gudang' => $vals['id_gudang'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'status' => 0,
					'ket' => $_POST['kets'],
					'tgl_retur' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'no_ref' => $k[0],
					'id_cus' => $vals['id_cus'],
					'jumlah_so' => $jumlah_so
					);
		$exec= $db->insert("tx_retur_pen", $data);
		//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$idn=$val['id']+1;
				$datajur = array(  'IDJ' => $idn,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $_POST['total'],
					   'KREDIT' => $_POST['total'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $valtmp['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$id=$db->idurut("tx_retur_pen_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $id, 
					'no_retur' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'sat' => $valtmp['sat'], 
					'qty_terima' => $valtmp['qty_terima'],
					'hpp' => $valtmp['hpp'],
					'qty_kembali' => $valtmp['qty_kembali'],
					'ket' => $valtmp['ket'],
					'id_gudang' => $valtmp['id_gudang'],
					'harga_jual' => $valtmp['harga_jual'],
					'id_cus' => $valtmp['id_cus'],
					'status' => 0,
					);
		
			$exec= $db->insert("tx_retur_pen_dtl", $data);
		//----------------------mutasi-------------------------------	
		if($_POST['jeniskem']==1){
			$tabel="tx_mutasi";	
		}elseif($_POST['jeniskem']==2){
			$tabel="tx_mutasi_reject";	
		}
	 	$cek=$db->select($tabel,"*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
		foreach($cek as $mutan){}
		$akhir=$mutan['akhir']+$valtmp['qty_kembali'];
		$idn=$db->idurut($tabel,"id_mutasi");
		$data = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $idgen,
				'awal' => $mutan['akhir'],
				'masuk' => $valtmp['qty_kembali'],
				'keluar' => 0,
				'akhir' => $akhir,
				'hpp' => $valtmp['hpp'],
				'tgl_mutasi' => date("Y-m-d H:i:s"),
				'jenis_mutasi' => 12,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
		$exec= $db->insert($tabel, $data);
		$hit=$db->select("m_barang_gudang","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
		foreach($hit as $dg){}
		
		////ambill mutasi
			$mutasi=$db->cek_mutasi_riject($valtmp['id_barang'],$valtmp['id_gudang']);
			if($mutasi['akhir']==''){
				$mutasi['akhir']=0;
			}else{
				$mutasi['akhir']=$mutasi['akhir'];
			}
			//end ambil
		$total=($akhir+$mutasi['akhir'])*$dg['hpp'];
		$total_piutang=$total_piutang+(($valtmp['qty_terima']-$valtmp['qty_kembali'])*$valtmp['harga_jual']);
		$barang = array( 
				'stok' => $akhir+$mutasi['akhir'],
				'total' => $total,
				);
		$exc= $db->update("m_barang_gudang",$barang,"id_barang='$valtmp[id_barang]' and id_gudang='$valtmp[id_gudang]'");
		//----------------------------end mutasi---------------------------------
		$where = array("id_user" => $_SESSION['ID_LOGIN']);
		$db->delete("tx_retur_pen_tmp",$where);
			include("jurnal_dtl.php");
		}//end foreach
		//=================================================================================================================
		
		$piut=$db->select("tx_piutang","*","no_ref='$k[0]' ORDER BY no_ref DESC limit 0,1");
		foreach($piut as $tang){}
		$ret = array( 
				'status' => 0,
				);
		$exc= $db->update("tx_piutang",$ret,"no_ref='$k[0]'");
		$dataj = array(
			'no_faktur_jual' => $tang['no_faktur_jual'], 
			'no_faktur_pajak' => $tang['no_faktur_pajak'],
			'no_ref' => $k[0],
			'status' => 1,
			'tgl' => $tgl,
			'total_piutang' => $total_piutang,
			'id_cus' => $tang['id_cus'],
			'stampdate' => date("Y-m-d H:i:s"),
			'id_user' => $_SESSION['ID_LOGIN'],
			'tempo_normal' => $tang['tempo_normal'], 
			'tempo_tambahan' => $tang['tempo_tambahan'],		
			'jenis_jual' => $tang['jenis_jual'], 
			'jenis_kirim' => $tang['jenis_kirim'], 
			'status_bayar' => 0, 
			'id_cabang' => $tang['id_cabang'],
			'n_tempo_n' => $tang['n_tempo_n'], 
			'n_tempo_t' => $tang['n_tempo_t'],
			);
		$exec= $db->insert("tx_piutang", $dataj);
		include("jurnal_lawan.php");
	}//end if jumlahx
	echo "<script>window.location='index.php?x=returpen'</script>";
?>