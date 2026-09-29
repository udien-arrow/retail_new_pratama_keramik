<?php
$expl=explode("_",$_POST['nopt']);
$c=$db->select("tx_order_tagihan","*","no_pt='$expl[0]'");
foreach($c as $cks){}
if(date("Y-m-d", strtotime($_POST['tgl_trans']))<$cks['tgl_pt'] or date("Y-m-d", strtotime($_POST['tgl_invo']))<$cks['tgl_pt']){ 
echo "<script>alert('Maaf Tangal Transaksi dan invoice tidak boleh lebih kecil dari tanggal Permintaan Tagihan')</script>";
echo "<script>window.location='index.php?x=pembsupp'</script>";	
}else{


	$tabelbk = "ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'JU', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$tgl = date('Y-m-d H:i:s');
	$total = $_POST['total'];
	$expl=explode("_",$_POST['nopt']);
	$max=$db->select($tabelbk,"max(IDJ)as id");
	$su=$db->select("m_supplier","ifnull(account,0) as account","id_supp=$expl[2]");
	foreach($su as $sup){}
	
	if($sup['account']!='0'){
		foreach($max as $val){}
		$id=$val['id']+1;		  
		$databk = array( 'IDJ' => $id,
					'NO_JURNAL' => $idj,
					'IDKM' => $idkm,
					'TGL_JURNAL' => $tgl,
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_SESSION['ID_CABANG']					
				);
	//$exec= $db->insert($tabelbk, $databk);
	
	//foreach	($db->select("ak_jurnal_dtl_tmp","*","TIPE='BK'") as $bk){
	//================ pembalik (debet)=============================================================================
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $sup['account'],
						'DEBET'=> $total,
						'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].'',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo'])),
						'NO_INVOICE' => $expl[0],
						'TANGGAL' => $tgl
			);
		//$exec= $db->insert($tabel_dtl, $datadtl);
		
		$tabel = "ak_jurnal_dtl_tmp";
		$where1 = array('IDX' => $bk['IDX']);
		$exec = $db-> delete($tabel,$where1);
	//}
	//================ end pembalik=============================================================================
	// buat total(balance) 
	
	$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $total,
						'KET_DTL' => 'Pembayaran Supplier NO.REF '.$expl[0].'',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo'])),
						'NO_INVOICE' => $expl[0],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG']
			);
	//$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
	//simpan kas_keluar
	
	$data_dtl_kk = array('IDKK' => $idkm,
						'TGL' => $tgl,
						'TGL_TRAN' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'JUMLAH' => $total,
						'URAIAN' => $_POST['cacat'],
						'KD_SUPP' => $expl[2],
						'KET' => $expl[0],
						'id_cabang' => $_SESSION['ID_CABANG'],
						'type' => $_POST['aruskas'],
						);
	//$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
	//===================dtl========================
	foreach ($_POST['no_ex'] as $key => $value) {
			 if(str_replace(",","",$_POST['dibayar'][$key])!="0"){
				
				 if(str_replace(",","",round($_POST['dibayar'][$key]))>round($_POST['totalk'][$key])){
					echo "<script>alert('Maaf Melebihi')</script>"; 
				 }else{
			  $ks=$db->idurut("ex_pembayaran_ex","id");
			  $k=explode("_",$_POST['no_pt']);
			  $data = array('id' => $ks,
			  'no_tagihan' => $k['0'],
			  'jumlah_tagihan' =>  round($_POST['totalk'][$key]),
			  'dibayar' => str_replace(",","",$_POST['dibayar'][$key]),
			  'stampdate' => date("Y-m-d H:i:s"),
			  'id_user' => $_SESSION['ID_LOGIN'],
			  'no_expediture' => $value
				);
	//var_dump($data);
	$execf= $db->insert("ex_pembayaran_ex", $data);
				 }
	$ce=$db->select("ex_pembayaran_ex","sum(dibayar) as dibayarn","no_tagihan='$_POST[links]' and no_expediture='$value'");
	foreach($ce as $cek){}		
		
	$hut=$db->select("ex_expediture","*","no_expediture='$value'");
	foreach($hut as $hat){}
	
	$wp=$db->select("ex_order_tagihan_dtl","*","no_expediture='$value'");
	foreach($wp as $wps){}
	
	$jad=round($hat['total_ao'])-round($wps['retur']);
	if($jad==$cek['dibayarn']){
	$data = array(
				'status' => 1,
				);
	$execf= $db->update("ex_expediture", $data,"no_expediture='$value'");
	}
				 
	
			}else{}
		}  
	
	
	
	$ce=$db->select("ex_pembayaran_ex","sum(dibayar) as dibayar","no_tagihan='$_POST[links]'");
	foreach($ce as $cek){}
	$al=$db->select("ex_order_tagihan","*","no_pt='$_POST[links]'");
	foreach($al as $all){}
	//echo round($all['total_tag'])."<br>".$cek['dibayar'];
	if(round($all['total_tag'])==$cek['dibayar']){
	$data = array(
				'status' => 1,
				);
	$execf= $db->update("ex_order_tagihan", $data,"no_pt='$_POST[links]'");
	}
	
	//die();
	//===================dtl========================	
	echo "<script>window.location='index.php?x=pembex'</script>";	
	}else{
	echo "<script>alert('Maaf kode rekening belum di set pada master supplier');window.location='index.php?x=pembex'</script>";		 
	}
}
?>


