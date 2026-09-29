<?php
if($_POST['jenis_s']==1){
$tgl=date('Y-m-d');
	$idcab=$db->select("r_user_login a
	JOIN m_pegawai b ON a.ID_PEGAWAI = b.id_pegawai
	JOIN m_gudang d ON b.id_cabang = d.id_cabang
	JOIN m_cabang c ON b.id_cabang = c.id_cabang","d.id_gudang,
	nama_gudang,
	b.id_cabang,
	c.kode_cabang","ID='$_SESSION[ID_LOGIN]'");
	foreach($idcab as $valcab){}
	$idgen=$db->nourut('no_keluar', 'tx_brg_keluar', 'IK', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_brg_keluar_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$sa=$db->select("tx_transit","*","no_transit='$_POST[no_ref]'");
	foreach($sa as $as){}
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("tx_brg_keluar","id_keluar");
		$data = array( 
					'id_keluar' => $id, 
					'no_keluar' => $idgen, 
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'kpd_id_gudang' => $_POST['kegudang'],
					'tgl' => $_POST['tgl'],
					'stampdate' => $as['stampdate'],
					'no_ref' => $as['no_transit'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => $_POST['keterangan'],
					'status' => 0,
					);
		$exec= $db->insert("tx_brg_keluar", $data);
		foreach($dttmp as $valtmp){
			$dtk=$db->select("m_konversi","*","id_barang='$valtmp[id_barang]' and sat2='$valtmp[sat]'");
			foreach($dtk as $dtkk){}
			if($dtkk['konv']!=''){
				$hpp=$valtmp['hpp']*$dtkk['konv'];
			}else{
				$hpp=$valtmp['hpp'];
			}//===end konv====	
			
			$supp=$valtmp['id'];
			$ids=$db->idurut("tx_brg_keluar_dtl","id_dtl");
			$total=$valtmp['qty_beri']*$hpp;
			$data = array( 
					'id_dtl' => $ids, 
					'id_keluar' =>$id, 
					'no_keluar' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'qty' => $valtmp['qty_beri'],
					'hpp' => $hpp,
					'total' => $total,
					'status' => 0,
					'sat' => $valtmp['sat'],
					);
			
			$exec= $db->insert("tx_brg_keluar_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("tx_brg_keluar_tmp",$where);
			$data = array( 
					'status' => 1, 
					);
			$exec= $db->update("tx_transit_dtl", $data,"no_transit='$_POST[no_ref]' and id_barang='$valtmp[id_barang]'");
		}
		$data2 = array( 
					'status' => 3, 
					);
		$exec= $db->update("tx_transit", $data2,"no_transit='$_POST[no_ref]'");
			
			
	}//end if jumlah
	echo "<script>window.location='index.php?x=appbrgkel&id=$idgen';</script>";
}
elseif($_POST['jenis_s']==2){
$tgl=date('Y-m-d');
$idcab=$db->select("r_user_login a
	JOIN m_pegawai b ON a.ID_PEGAWAI = b.id_pegawai
	JOIN m_gudang d ON b.id_cabang = d.id_cabang
	JOIN m_cabang c ON b.id_cabang = c.id_cabang","d.id_gudang,
	nama_gudang,
	b.id_cabang,
	c.kode_cabang","ID='$_SESSION[ID_LOGIN]'");
	foreach($idcab as $valcab){}
	$idgen=$db->nourut('no_keluar', 'tx_brg_keluar', 'IK', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_brg_keluar_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$sa=$db->select("tx_pengbum","*","no_pengbum='$_POST[no_ref]'");
	foreach($sa as $as){}
	$jumlah=count($dttmp);
	if($jumlah>0){
		$id=$db->idurut("tx_brg_keluar","id_keluar");
		$data = array( 
					'id_keluar' => $id, 
					'no_keluar' => $idgen, 
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'tgl' => $_POST['tgl'],
					'stampdate' => $as['stampdate'],
					'no_ref' => $as['no_pengbum'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => $_POST['keterangan'],
					'status' => 1,
					);
		$exec= $db->insert("tx_brg_keluar", $data);
		//start auto jurnal total
		$max=$db->select("ak_jurnal","max(IDJ)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$datajur = array(  'IDJ' => $id,
			   'IDKM'=> $idgen,
			   'NO_JURNAL' => $idj,
			   'DEBET' => "0",
			   'KREDIT' => "0",
			   'TGL_JURNAL' => date("Y-m-d"),
			   'USER' => $_SESSION['ID_LOGIN'],
			   'ID_CAB' => $_SESSION['ID_CABANG'],
			   'ID_GUD' => $valtmp['id_gudang'],
			  );
		$execjur= $db->insert("ak_jurnal", $datajur);
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$ids=$db->idurut("tx_brg_keluar_dtl","id_dtl");
			$total=$valtmp['qty_beri']*$valtmp['hpp'];
			$data = array( 
					'id_dtl' => $ids, 
					'id_keluar' =>$id, 
					'no_keluar' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'qty' => $valtmp['qty_beri'],
					'hpp' => $valtmp['hpp'],
					'total' => $total,
					'status' => 0,
					'sat' => $valtmp['sat'],
					'nopol' => $valtmp['nopol'],
					'sn' => $valtmp['sn'],
					);
			$exec= $db->insert("tx_brg_keluar_dtl", $data);
			
			//jurnal
			$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","*","a.id_barang='$valtmp[id_barang]'");
			foreach($ba as $bar){}
			//auto jurnal cogs
			$dttime=date("Y-m-d H:i:s");
			$cogs=$valtmp['qty_beri']*$valtmp['hpp'];
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['cogs'],
							   'DEBET' => $cogs,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal COGS ",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
							  
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => "0",
							   'KREDIT' => $cogs,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Persediaan ",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			
			$data = array( 
					'status' => 1, 
					);
			$exec= $db->update("am_maintenance_dtl", $data,"no_reff='$_POST[no_ref]'");
			
			if($valtmp['jenis']==5){
				$data = array( 
					'qty_pakai' => $valtmp['qty_beri'], 
					);
				$exec= $db->update("tx_brg_masuk_dtl_non", $data,"id_barang='$valtmp[id_barang]' and sn='$valtmp[sn]'");
				
				$ces=$db->select("tx_brg_masuk_dtl_non a join tx_brg_masuk b on a.no_masuk=b.no_masuk","sum(qty_terima) as tot,qty_pakai","sn='$valtmp[sn]' and id_barang='$valtmp[id_barang]' and b.id_gudang='$valtmp[id_gudang]'");
				foreach($ces as $cas){}
				$s=$cas['tot']-$cas['qty_pakai'];
				if($s==0)
				{
					  $sta=0;	
					  }else
					  {
					$sta=1;
				}
				$data = array( 
					'status' => $sta
					);
			$exec= $db->update("tx_brg_masuk_dtl_non", $data,"id_barang='$valtmp[id_barang]' and sn='$valtmp[sn]'");
				
			}
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$db->delete("tx_brg_keluar_tmp",$where);
			$data = array( 
					'status' => 1, 
					);
			$exec= $db->update("tx_pengbum_dtl", $data,"no_pengbum='$_POST[no_ref]' and id_barang='$valtmp[id_barang]'");
		}
		$data2 = array( 
					'status' => 3, 
					);
		$exec= $db->update("tx_pengbum", $data2,"no_pengbum='$_POST[no_ref]'");
		//mutasi
		$dttmp=$db->select("tx_brg_keluar a
JOIN tx_brg_keluar_dtl b ON a.no_keluar = b.no_keluar
JOIN m_barang_gudang c ON b.id_barang = c.id_barang AND a.id_gudang = c.id_gudang","a.id_keluar,
b.no_keluar,
a.id_gudang,
a.kpd_id_gudang,
a.id_user,
a.`status`,
a.ket,
a.tgl,
a.stampdate,
a.no_ref,
b.qty,
c.kode_barang,
c.nama_barang,
b.id_barang,
b.hpp","b.no_keluar='$idgen'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $valtmp){
		$cek=$db->select("tx_mutasi","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
			foreach($cek as $mutan){}
			$ak=$db->select("tx_mutasi","max(id_mutasi)as id");
		    foreach($ak as $ka){}
		    $idn=$ka['id']+1;
			$akhir=$mutan['akhir']-$valtmp['qty'];
			$tglmutasi=date("Y-m-d H:i:s");
			$datai = array( 
		 		'id_mutasi' => $idn,
				'no_ref' => $idgen,
				'awal' => $mutan['akhir'],
				'masuk' => 0,
				'keluar' =>  $valtmp['qty'],
				'akhir' => $akhir,
				'hpp' => $valtmp['hpp'],
				'tgl_mutasi' => $tglmutasi,
				'jenis_mutasi' => 1,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $valtmp['id_gudang'],
				'id_barang' => $valtmp['id_barang']
				);
			$exec= $db->insert("tx_mutasi", $datai);
			$vv=$db->select("m_barang_gudang","*","id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
		    foreach($vv as $vw){}
			$total=$akhir*$vw['hpp'];
			$data33 = array( 
					'stok' => $akhir, 
					'total' => $total, 
					);
		$exec= $db->update("m_barang_gudang", $data33,"id_gudang='$valtmp[id_gudang]' and id_barang='$valtmp[id_barang]'");
			}
			
	}		
	}//end if jumlah
	echo "<script>alert('Sukses Simpan Data Dengan Nomer IK $idgen');window.location='index.php?x=brgkeluar'</script>";
}
?>