<?php
	$tgl=date('Y-m-d');
	$idgen=$db->nourut('no_koreksi', 'tx_koreksi_habel', 'KHB', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
	$dttmp=$db->select("tx_koreksi_habel_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	$jumlah=count($dttmp);
	if($jumlah>0){
		foreach($dttmp as $vals){}
		$k=explode("_",$_POST['kepala']);
		$gudang=$db->select("tx_brg_masuk","id_gudang,id_supp,jenis","no_masuk='$k[0]'");
		foreach($gudang as $gud){}
		$id=$db->idurut("tx_koreksi_habel","id_koreksi");
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
					'tgl_koreksi' => date("Y-m-d",strtotime($_POST['tgl'])),
					'stampdate' => date('Y-m-d H:i:s'),
					'no_ref' => $k[0],
					'id_supp' => $gud['id_supp'],
					);
		$exec= $db->insert("tx_koreksi_habel", $data);
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
					   'ID_GUD' => $gud['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		foreach($dttmp as $valtmp){
			$supp=$valtmp['id'];
			$idl=$db->idurut("tx_koreksi_habel_dtl","id_dtl");
			$data = array( 
					'id_dtl' => $idl, 
					'no_koreksi' => $idgen,
					'id_barang' => $valtmp['id_barang'],
					'sat' => $valtmp['id_satuan'], 
					'harga_awal' => $valtmp['harga_awal'],
					'harga_ganti' => $valtmp['harga_ganti'],
					'ket' => $valtmp['ket'],
					'qty' => $valtmp['qty'],
					'total' => $valtmp['qty']*($valtmp['harga_awal']-$valtmp['harga_ganti']),
					'status' => 0,
					);
			//var_dump($data);
			$exec= $db->insert("tx_koreksi_habel_dtl", $data);
			$where = array("id_user" => $_SESSION['ID_LOGIN']);
			$totawal=$totawal+($valtmp['harga_awal']*$valtmp['qty']);
			$totganti=$totganti+($valtmp['harga_ganti']*$valtmp['qty']);
			$selisih=$valtmp['harga_ganti']-$valtmp['harga_awal'];
			
			//=====================hpp===================
			$cekm2=$db->cek_mutasi($valtmp['id_barang'],$gud['id_gudang']);
			if($cekm2['hpp']!=''){
				$totaltbl_stok=$cekm2['hpp']*$cekm2['akhir']; 
				$hpp=round(($totaltbl_stok+($valtmp['qty']*$selisih))/$cekm2['akhir'], 4);
				$datai = array( 
					'no_ref' => $idgen,
					'awal' => $cekm2['akhir'],
					'masuk' => 0,
					'keluar' =>  0,
					'akhir' => $cekm2['akhir'],
					'hpp' => $hpp,
					'tgl_mutasi' => date("Y-m-d H:i:s"),
					'jenis_mutasi' => 10,
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_gudang' => $gud['id_gudang'],
					'id_barang' => $valtmp['id_barang']
					);
				$exec= $db->insert("tx_mutasi", $datai);
				include('jurnal_dtl.php');
			}	
			
			$db->delete("tx_koreksi_habel_tmp",$where);
		}
		//=============================piutang=========================================
		if($totganti>$totawal){$typ=0;}else{$typ=1;}
		$data = array( 
					'type' => $typ, 
					'total' => $totganti, 
					'total_sebelumnya' => $totawal, 
					);
		$exec= $db->update("tx_koreksi_habel", $data,"no_koreksi='$idgen'");
		
		
		
	}//end if jumlahx
	echo "<script>window.location='index.php?x=korhabel'</script>";
?>