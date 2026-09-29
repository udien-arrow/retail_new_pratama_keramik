<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_retur', 'tx_retur_pem', 'RT', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_retur_pem_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => '0',
					   'KREDIT' => '0',
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $_SESSION['ID_GUDANG'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		foreach($dttmp as $vals){}
		$id=$db->idurut("tx_retur_pem","id_retur");
		$k=explode("_",$_POST['kepala']);
		$kep=$db->select("tx_brg_masuk","*","no_masuk='$k[0]'");
		$b=explode("-",$_POST['tgl']);
		foreach($kep as $pala){}
		$data = array( 
					'id_retur' => $id, 
					'no_retur' => $idgen, 
					'id_gudang' => $vals['id_gudang'],
					'kpd_id_supp' => $vals['id_sup'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'status' => 1,
					'ket' => $_POST['kets'],
					'tgl_retur' => $b[2]."-".$b[1]."-".$b[0],
					'stampdate' => date('Y-m-d H:i:s'),
					'no_ref' => $k[0],
					'no_spj' => $pala['surat_jalan'],
					);
		$exec= $db->insert("tx_retur_pem", $data);
		
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$id=$db->idurut("tx_retur_pem_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $id, 
					'no_retur' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'sat' => $valtmp['sat'], 
					'qty_terima' => $valtmp['qty_terima'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'hpp' => $valtmp['hpp'],
					'qty_kembali' => $valtmp['qty_kembali'],
					'ket' => $valtmp['ket'],
					'id_gudang' => $valtmp['id_gudang'],
					'harga_beli' => $valtmp['harga_beli'],
					'id_sup' => $valtmp['id_sup'],
					'status' => 1,
					);
			
			$exec= $db->insert("tx_retur_pem_dtl", $data);
			//======================mutasi===============================
			$cek=$db->select("tx_mutasi","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
			 foreach($cek as $mutan){}
			$akhir=$mutan['akhir']-$valtmp['qty_kembali'];
			$idn=$db->idurut("tx_mutasi","id_mutasi");
			$data = array( 
		 		'id_mutasi' => $idn,
				'no_ref' =>  $idgen,
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' => $valtmp['qty_kembali'],
				'akhir' => $akhir,
				'hpp' => $valtmp['hpp'],
				'tgl_mutasi' => date("Y-m-d H:i:s"),
				'jenis_mutasi' => 10,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
				
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
				$barang = array( 
						'stok' => $akhir+$mutasi['akhir'],
						'total' => $total,
						);
				$updates = array( 
						'status' => 1,
						);
				//var_dump($data);
				//die();		
						
				$exec= $db->insert("tx_mutasi", $data);
				$exc= $db->update("m_barang_gudang",$barang,"id_barang='$valtmp[id_barang]' and id_gudang='$valtmp[id_gudang]'");
			
				//start auto jurnal
				$dpp=$valtmp['harga_beli']/1.1;
				$ppn=$dpp*(10/100)*$valtmp['qty_kembali'];				
				$hrgbeli=$dpp*$valtmp['qty_kembali'];
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","inventory","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				$tppn+=$ppn;
				$thutang+=$ppn+$hrgbeli;
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => "0",
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Barang Keluar(Retur)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
					
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//end auto jurnal
				$suppp=$valtmp['id_sup'];
				$where = array("id_user" => $_SESSION['ID_LOGIN']);
				$db->delete("tx_retur_pem_tmp",$where);
			
		}	
		//start auto jurnal ppn
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  	'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $tppn,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Barang PPN",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal ppn
			//start auto jurnal hutang
			$s=$db->select("m_supplier","ifnull(pph,0) as pph,ifnull(account,0) as account","id_supp='$suppp'");
			foreach($s as $pps){}
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => $thutang,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Barang Hutang",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );	
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang
		
	}//end if jumlah
	echo "<script>window.location='index.php?x=retur'</script>";
?>