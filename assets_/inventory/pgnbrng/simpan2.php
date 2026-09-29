<?php
//echo"qw disini";
session_start();
$ust=$db->select("tx_usage_tmp","*","id_gudang='$_SESSION[ID_GUDANG]'");
$idgen=$db->nourut('no_usage', 'tx_usage', 'US', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
$idgenj=$db->nourut('no_jurnal', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
$id=$db->idurut("tx_usage","id_usage");		
$db->beginTransaction();

$tabel2 = "m_barang_gudang";
$tgl=explode("/",$_POST[tglku]);
$tgl2=$tgl[2]."-".$tgl[1]."-".$tgl[0];

$dhusage=array(
				"no_usage"=>$idgen,
				"id_gudang"=>$_SESSION['ID_GUDANG'],
				"id_cabang"=>$_SESSION['ID_CABANG'],
				"tgl_input"=>$tgl,
				"user_input"=>$_SESSION['ID_LOGIN'],
);
$qhusage=$db->insertID("tx_usage",$dhusage);
$dhjurnal=array(
				"no_jurnal"=>$idgenj,
				"idkm"=>$idgen,
				"tgl_jurnal"=>$tgl2,
				"debet"=>'0',
				"kredit"=>'0',
				"user"=>$_SESSION['ID_LOGIN'],
				"id_cab"=>$_SESSION['ID_CABANG'],
				"id_gud"=>$_SESSION['ID_GUDANG'],
);
$qhjurnal=$db->insert("ak_jurnal",$dhjurnal);
//var_dump($dhjurnal);
foreach($ust as $vust){
	$cekm=$db->select("tx_mutasi","*","id_gudang='$vust[id_gudang]' and id_barang='$vust[id_barang]' ORDER BY id_mutasi DESC LIMIT 0,1");
	foreach($cekm as $vcekm){}
	foreach($db->select("m_barang","id_sub","id_barang='$vust[id_barang]'") as $vgroup){}
		//echo"id barang $vcekm[id_barang] $vcekm[id_gudang] stok akhir $vcekm[akhir]<br>";
		$ddusage=array(
					"id_usage"=>$qhusage,
					"no_usage"=>$idgen,
					"id_barang"=>$vust[id_barang],
					"qty_awal"=>$vust[qty_masuk],
					"qty_masuk"=>$vust[qty_masuk],
					"qty_keluar"=>$vust[qty_keluar],
					"qty_waste"=>$vust[qty_waste],
					"qty_sisa"=>$vust[qty_sisa],
					"hpp"=>$vust[hpp],
				 );
		$db->insert("tx_usage_dtl",$ddusage);	
		//echo"test<br>";
		//------------------- mutasi ---------------------------------
		$ak=$db->select("tx_mutasi","max(id_mutasi)as id");
		foreach($ak as $ka){}	 
		//echo"tx_mutasi<br>";
		$datai = array( 

				'no_ref' => $idgen,
				'awal' => $vcekm['akhir'],
				'masuk' => 0,
				'keluar' =>  ($vust['qty_keluar']+$vust['qty_waste']),
				'akhir' => $vcekm['akhir']-($vust['qty_keluar']+$vust['qty_waste']),
				'hpp' => $vust['hpp'],
				'tgl_mutasi' => $tgl2,
				'jenis_mutasi' => 13,
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $vust['id_gudang'],
				'id_barang' => $vust['id_barang']
				);
		$exec= $db->insert("tx_mutasi", $datai);
		//-----------------------------------------------
		$barang = array( 
				'stok' => $vcekm['akhir']-($vust['qty_keluar']+$vust['qty_waste']),
				'total' => ($vcekm['akhir']-($vust['qty_keluar']+$vust['qty_waste']))*$total,
				);
		
		$exc= $db->update($tabel2,$barang,"id_barang='$vust[id_barang]' and id_gudang='$vust[id_gudang]'");
		//-----------------------------------------------

		$dj=$db->select("m_grup","*","id_sub='$vgroup[id_sub]'");
		foreach($dj as $vdj){}
		
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['cogs'],
					    'DEBET' => $vust[qty_keluar]*$vust[hpp],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Usage form",
					    'TGL_JURNAL' => $tgl2,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
					    'ID_GUD' => $vust['id_gudang'],
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		//var_dump($dataj);
		//echo"<br>";
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['waste'],
					    'DEBET' => $vust[qty_waste]*$vust[hpp],
					    'KREDIT' => "0",
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Usage form",
					    'TGL_JURNAL' => $tgl2,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
					    'ID_GUD' => $vust['id_gudang'],
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
				//var_dump($dataj);
				//echo"<br>";
		$dataj = array( 
						'NO_JURNAL' => $idgenj, 
					    'ACC_CODE' => $vdj['intransit'],
					    'DEBET' => "0",
					    'KREDIT' => ($vust[qty_waste]+$vust[qty_keluar])*$vust[hpp],
					    'USD' => "0",
					    'KURS' => "0",
					    'KET_DTL' => "Auto Jurnal Usage form",
					    'TGL_JURNAL' => $tgl2,
					    'TANGGAL' => date("Y-m-d H:i:s"),
					    'ID_CAB' => $_SESSION['ID_CABANG'],
					    'NO_INVOICE' => $idgen,
					    'ID_GUD' => $vust['id_gudang'],
					  );
		$execj= $db->insert("ak_jurnal_dtl", $dataj);
		//var_dump($dataj);
		//echo"<br>";
		//delete temp usage
		$whtmp=array("id_usage"=>$vust[id_usage]);
		$del=$db->delete("tx_usage_tmp",$whtmp);
		
	}

$db->commit();
echo "<script>alert('Sukses Simpan Data Dengan Nomer $idgen');window.location='index.php?x=pgnbrng'</script>";
?>
