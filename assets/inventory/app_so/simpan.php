f<?php
$tabel = "tx_mutasi";
$tabel2 = "m_barang_gudang";
$tabel3 = "tx_stok_opname";
$tabel4 = "tx_stok_opname_dtl";
$tanggal=date('Y-m-d H:i:s');

$idso=explode("_",$_POST[id_stok]);
foreach($db->select("tx_stok_opname a JOIN m_gudang b ON a.id_gudang=b.id_gudang","b.id_gudang,b.id_cabang","id_stok_opname='$idso[0]'") as $vst){}
// ----------- start header jurnal ---------------------------------------
$idgenj=$db->nourut('no_jurnal', 'ak_jurnal', 'AJ', sprintf("%02s", $vst['id_cabang']), date('Y-m-d'));
$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idso[0],
				"tgl_jurnal"=>$tanggal,
				"debet"=>'0',
				"kredit"=>'0',
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$vst['id_cabang'],
				"id_gud"=>$vst['id_gudang'],
);
$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
//------------- end header jurnal -----------------------------------------
 foreach ($_POST['cek'] as $key) {
	 $ak=$db->select("tx_mutasi","max(id_mutasi)as id");
	 foreach($ak as $ka){}
	 $idn=$ka['id']+1;
	 $as=$db->select("tx_stok_opname_dtl","*","id_stok_opname='$_POST[idnya]' and kd_brg='$key'");
	 $cek=$db->select("tx_mutasi","*","id_gudang='$_POST[inigudang]' and id_barang='$key' ORDER BY id_mutasi DESC LIMIT 0,1");
	 foreach($cek as $mutan){}
	 //------------------ kode rekening group barang --------------------------------------------
	 foreach($db->select("m_barang","id_sub","id_barang='$key'") as $vgroup){}
	 $dj=$db->select("m_grup","*","id_sub='$vgroup[id_sub]'");
	 foreach($dj as $vdj){}
		
	 //-------------------- edn kode rekening group barang ---------------------------------------	
	 foreach($as as $dnj){
		 
	 if($dnj['selisih']<0){
		 $akhir=$mutan['akhir']-abs($dnj['selisih']);
		 ////ambill mutasi
			$mutasi=$db->cek_mutasi_riject($key,$_POST['inigudang']);
			if($mutasi['akhir']==''){
				$mutasi['akhir']=0;
			}else{
				$mutasi['akhir']=$mutasi['akhir'];
			}
			//end ambil
		 
		 $total=($akhir+$mutasi['akhir'])*$dnj['hpp_akhir'];
		 $data = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $_POST['idnya'],
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' => abs($dnj['selisih']),
				'akhir' => $akhir,
				'hpp' => $dnj['hpp_akhir'],
				'tgl_mutasi' => $tanggal,
				'jenis_mutasi' => 0,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $_POST['inigudang'],
				'id_barang' => $key
				);
		$barang = array( 
				'stok' => $akhir+$mutasi['akhir'],
				'total' => $total,
				);
		$updates = array( 
				'status' => 1,
				);
		$exec= $db->insert($tabel, $data);
		//----------------- start detail jurnal -------------------------------
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['cogs'],
					    'DEBET' => abs($dnj['selisih'])*$dnj['hpp_akhir'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Stock Opname",
					    'TGL_JURNAL' => $tanggal,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $vst['id_cabang'],
					    'NO_INVOICE' => $_POST['idnya'],
					    'ID_GUD' => $_POST['inigudang'],
					  );
		
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['intransit'],
					    'DEBET' => "0",
					    'KREDIT' => abs($dnj['selisih'])*$dnj['hpp_akhir'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Stock Opname",
					    'TGL_JURNAL' => $tanggal,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $vst['id_cabang'],
					    'NO_INVOICE' => $_POST['idnya'],
					    'ID_GUD' => $_POST['inigudang'],
					  );
					 
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		//----------------- end detail jurnal ----------------------------------	
	}else{
		$akhir=$mutan['akhir']+$dnj['selisih'];
		////ambill mutasi
			$mutasi=$db->cek_mutasi_riject($key,$_POST['inigudang']);
			if($mutasi['akhir']==''){
				$mutasi['akhir']=0;
			}else{
				$mutasi['akhir']=$mutasi['akhir'];
			}
			//end ambil 
		$total=($akhir+$mutasi['akhir'])*$dnj['hpp_akhir'];
		$data = array( 
				'id_mutasi' => $idn,
				'no_ref' => $_POST['idnya'],
				'awal' => $mutan['akhir'],
				'masuk' => $dnj['selisih'],
				'keluar' => 0,
				'akhir' => $akhir,
				'hpp' => $dnj['hpp_akhir'],
				'tgl_mutasi' => $tanggal,
				'jenis_mutasi' => 0,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $_POST['inigudang'],
				'id_barang' => $key
				);
		$updates = array( 
				'status' => 1,
				);
		$barang = array( 
				'stok' => $akhir+$mutasi['akhir'],
				'total' => $total,
				);
			$exec= $db->insert($tabel, $data);
			//----------------- start detail jurnal -------------------------------
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['cogs'],
					    'DEBET' => "0",
					    'KREDIT' => abs($dnj['selisih'])*$dnj['hpp_akhir'],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Stock Opname",
					    'TGL_JURNAL' => $tanggal,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $vst['id_cabang'],
					    'NO_INVOICE' => $_POST['idnya'],
					    'ID_GUD' => $_POST['inigudang'],
					  );
		
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['intransit'],
					    'DEBET' => abs($dnj['selisih'])*$dnj['hpp_akhir'],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Stock Opname",
					    'TGL_JURNAL' => $tanggal,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $vst['id_cabang'],
					    'NO_INVOICE' => $_POST['idnya'],
					    'ID_GUD' => $_POST['inigudang'],
					  );
					 
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		
		//----------------- end detail jurnal ----------------------------------	
		}
		
		$exc= $db->update($tabel3,$updates,"id_stok_opname='$_POST[idnya]'");
		$exc= $db->update($tabel4,$updates,"id_stok_opname='$_POST[idnya]' and kd_brg='$key'");
		$exc= $db->update($tabel2,$barang,"id_barang='$key' and id_gudang='$_POST[inigudang]'");
		}	
	
 }		
	echo "<script>window.location='index.php?x=appso'</script>";
?>