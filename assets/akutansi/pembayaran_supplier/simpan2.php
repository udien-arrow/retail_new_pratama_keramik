<?php
$cektutup=$db->tutupbuku($_SESSION['ID_CABANG'],$_POST['tgl_trans']);
if($cektutup==0){

$expl=explode("_",$_POST['nopt']);
$c=$db->select("tx_order_tagihan","*","no_pt='$expl[0]'");
foreach($c as $cks){}
/*if(date("Y-m-d", strtotime($_POST['tgl_trans']))<$cks['tgl_pt'] or date("Y-m-d", strtotime($_POST['tgl_invo']))<$cks['tgl_pt']){ 
echo "<script>alert('Maaf Tangal Transaksi dan invoice tidak boleh lebih kecil dari tanggal Permintaan Tagihan')</script>";
echo "<script>window.location='index.php?x=pembsupp'</script>";	
}else{**/
	$tgls=date("Y-m-d",strtotime($_POST['tgl_trans']));
	$tgx=explode("-",$tgls);
	$bul=$tgx[1];
	$tahun=$tgx[0];
	$dttime=date("Y-m-d H:i:s");
	$akhir=$db->checksaldo($bul,$tahun,$_SESSION['ID_CABANG'],$_POST['rekening']);
	if($_POST['dibayarnya']<=$akhir){
	$tabelbk = "ak_jurnal";
	$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'PS', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$idkm=$db->nourut('IDKM', 'ak_jurnal', 'PS', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
	$tgl = date('Y-m-d H:i:s');
	//$total = $_POST['total'];
	//$total = $_POST['dibayarnya'];
	$total = $_POST['dibayarnya'];
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
					'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_SESSION['ID_CABANG']					
				);
	$exec= $db->insert($tabelbk, $databk);
	
	//foreach	($db->select("ak_jurnal_dtl_tmp","*","TIPE='BK'") as $bk){	
	//=====================================jika kurang lebih===============================================
	$ckd=$db->select("tx_order_tagihan_bayar","*","no_pt='$expl[0]' and status='0' and selisih<>'0'");
	foreach($ckd as $ckdb){
		
	if($ckdb['no_pt']<>''){
		if($ckdb['selisih']>0){
			$kurangnya_d=$ckdb['selisih'];
			$kurangnya_k=0;
		}else{
			$kurangnya_d=0;
			$kurangnya_k=abs($ckdb['selisih']);
		}
		
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='45' and status='1'");
					  foreach($ckpph as $ckpph2){}
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $kurangnya_d,
							   'KREDIT' => $kurangnya_k,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Kurang/Lebih Pembayaran Supplier ".$expl[0],
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $_POST['rekening'],
							   'DEBET' => $kurangnya_k,
							   'KREDIT' => $kurangnya_d,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Kurang/Lebih Pembayaran Supplier ".$expl[0],
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				
		}
	}
		//==========================================end kurang lebih===========================================
		
	$sat=$db->select("tx_order_tagihan_dtl a
JOIN tx_order_tagihan_bayar b ON a.id_bill_dtl = b.id_bill_dtl","sum(b.dibayar) AS dibayar,sum(b.selisih) AS selisih,
	a.id_cabang","a.no_pt='$expl[0]' and b.status='0' GROUP BY a.id_cabang");
		foreach($sat as $val){  //if foreach
		
		$tabel_dtl = "ak_jurnal_dtl";	
						$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $sup['account'],
						'DEBET'=> $val['dibayar']-$val['selisih'],
						'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].'',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo1'])),
						'NO_INVOICE' => $expl[0],
						'TANGGAL' => $tgl,
						'ID_CAB' => $val['id_cabang'],
				);
			$exec= $db->insert($tabel_dtl, $datadtl);
		//R/k Lawan
		
		$ls=$db->select("ak_parameterjur","*","id_m_parameterjur='10' and status='1'");
		foreach($ls as $las){}
						$tabel_dtl = "ak_jurnal_dtl";	
						$datadtl = array(
						'NO_JURNAL' => $idj,
						'ACC_CODE' => $las['acc_code'],
						'KREDIT'=> $val['dibayar']-$val['selisih'],
						'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].' -a',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo1'])),
						'NO_INVOICE' => $expl[0],
						'TANGGAL' => $tgl,
						'ID_CAB' => $val['id_cabang'],
				);

			$exec= $db->insert($tabel_dtl, $datadtl);
			$sel+=$val['selisih'];
		} // end foreach	
				
			$ls=$db->select("ak_parameterjur","*","id_m_parameterjur='10' and status='1'");
		foreach($ls as $las){}
			$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $las['acc_code'],
						'DEBET'=> $total-$sel,
						'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].' -b',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo1'])),
						'NO_INVOICE' => $expl[0],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
						
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
	
	
	//===========================order tag kd========================
	$sat3=$db->select("tx_order_tagihan_dtl","*","no_pt='$expl[0]'");
	foreach($sat3 as $val){  //foreach
		$ce=$db->select("tx_billing_dtl a LEFT JOIN tx_brg_masuk b on a.no_spj=b.surat_jalan","a.*,b.no_masuk as masuk,b.id_cabang,b.id_gudang","a.no_spj='$val[no_spj]' and a.id_dtl='$val[id_bill_dtl]'");
  	 	foreach($ce as $cak){}
   
   		$cks=$db->select("tx_order_tagihan_kd","*","no_billing='$val[no_billing]' and no_spj='$val[no_spj]'");
   		foreach($cks as $caks){}
			if($cak['masuk']=='' && $caks['status_jurnal']=='0'){ //if 
				$s=$db->select("tx_billing a join m_supplier b on a.id_supp=b.id_supp","ifnull(b.pph,0) as pph,ifnull(b.account,0) as account,b.account_pph","a.no_billing='$val[no_billing]'");
				foreach($s as $pps){}
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","inventory","a.id_barang='$cak[id_barang]'");
				foreach($ba as $bar){}
				if($pps['pph']!=0){
					$th=$pps['pph']/100;	
				}else{
					$th=0;
				}
				
				$dpp=$cak['harga']/(1.1+$th);
				$ppn=$dpp*(10/100)*$cak['qty'];
				
				if($pps['pph']==0){
					$hrgbeli=$dpp*$cak['qty'];
					$pph=0;
				}else{
					$pph=($dpp*($pps['pph']/100))*$cak['qty'];
					$hrgbeli=($dpp*$cak['qty']);
				}
				
				$tppn=$ppn;
				$tpph=$pph;
				$thutang=$ppn+$pph+$hrgbeli;
				
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => "0",
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Persediaan Dalam Perjalanan No SPJ($val[no_spj])",
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $cak['ID_CABANG'],
							   'NO_INVOICE' => $expl[0],
							   'ID_GUD' => $cak['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				
				$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
				foreach($ckpph as $ckpph2){}
				$datajur = array(  'NO_JURNAL' => $idj, 
									   'ACC_CODE' => $ckpph2['acc_code'],
									   'DEBET' => "0",
									   'KREDIT' => $tppn,
									   'USD' => "0",
									   'KURS' => "0",
									   'KET_DTL' => "Auto Jurnal Persediaan dalam perjalanan PPN No SPJ($val[no_spj])",
									   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
									   'TANGGAL' => $dttime,
									   'NO_INVOICE' => $expl[0],
									   'ID_CAB' => $cak['ID_CABANG'],
									   'ID_GUD' => $cak['id_gudang'],
									  );
					$execjur= $db->insert("ak_jurnal_dtl", $datajur);
					
					if($pps['pph']==0){
					  }else{
						 $ckpph=$db->select("ak_umpph","*","id_jenisum='$pps[account_pph]'");
						foreach($ckpph as $ckpph2){}
					  $datajur = array(  'NO_JURNAL' => $idj, 
									 'ACC_CODE' => $ckpph2['account'],
									 'DEBET' => "0",
									 'KREDIT' => $tpph,
									 'USD' => "0",
									 'KURS' => "0",
									 'KET_DTL' => "Auto Jurnal PPH ($val[no_spj])",
									 'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
									 'TANGGAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
									 'NO_INVOICE' => $expl[0],
									 'ID_CAB' => $cak['ID_CABANG'],
									 'ID_GUD' => $cak['id_gudang'],
									);
							
					  $execjur= $db->insert("ak_jurnal_dtl", $datajur);
					  }
					  
					  
					  $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='37' and status='1'");
					  foreach($ckpph as $ckpph2){}
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $thutang,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Piutang DN ($val[no_spj])",
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $cak['ID_CABANG'],
							   'ID_GUD' => $cak['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		
				
				$up = array(
					'status_jurnal' => 1
				);
		$execf= $db->update("tx_order_tagihan_kd",$up,"no_billing='$val[no_billing]' and no_spj='$val[no_spj]'");
				
			}//end if
	}//end foreach
	//==================================end kd===============================================
	$cas=$db->select("tx_order_tagihan_kd","*","digunakan_bill='$val[no_billing]' and status_jurnal2='0'");
   	foreach($cas as $cask){
		 if($cask['digunakan_bill']!='' and $cask['status_jurnal2']=='0' and ($cask['jenis']=='1' or $cask['jenis']=='0')){ 
			if($cask['claim_utuh']!=''){
				$clam=$cask['claim_utuh']*$cask['harga'];
			}elseif($cask['claim_ktg']!=''){
				$ktg=$cask['claim_ktg']*1000;
			}elseif($cask['jenis']=='1'){
				$takditerima=$cask['total'];
			}
			$totalall=$total-$takditerima-$clam-$ktg;
		 }elseif($cask['digunakan_bill']!='' and $cask['status_jurnal2']=='0' and $cask['jenis']=='2'){
			 $sk=$cask['total'];
			 $totalall=$total+$cask['total'];
		 }else{
			 $totalall=$total;
		 }
	}//end foreahc
		$totalall=$total-$takditerima-$clam-$ktg+$sk;
		
	$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $totalall-$sel,
						'KET_DTL' => 'Pembayaran Supplier NO.REF '.$expl[0].' - c',
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d", strtotime($_POST['tgl_invo1'])),
						'NO_INVOICE' => $expl[0],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
	$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
	//simpan kas_keluar
	$data_dtl_kk = array('IDKK' => $idkm,
						'TGL' => $tgl,
						'TGL_TRAN' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'JUMLAH' => $total,
						'URAIAN' => $_POST['cacat'],
						'KD_SUPP' => $expl[2],
						'KET' => $expl[0],
						'id_cabang' => $_SESSION['ID_CABANG'],
						'type' => '3'
						);
	$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
	//===================dtl========================
	
	//bill
	foreach($cas as $cask){
	 if($cask['digunakan_bill']!='' and $cask['status_jurnal2']=='0' and $cask['jenis']=='0'){
		 if($cask['claim_utuh']!=''){
		 $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='36' and status='1'");
					  foreach($ckpph as $ckpph2){}
					  $clam=$cask['claim_utuh']*$cask['harga'];
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $clam,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Piutang Claim Utuh Bill ($cask[digunakan_bill])",
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $_SESSION['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				$up = array(
					'status_jurnal2' => 1
				);
			//$execf= $db->update("tx_order_tagihan_kd",$up,"digunakan_bill='$cask[digunakan_bill]'");
		 }elseif($cask['claim_ktg']!=''){
			 $ktg=$cask['claim_ktg']*1000;
			 $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='36' and status='1'");
					  foreach($ckpph as $ckpph2){}
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $ktg,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Piutang Claim Ktg Bill ($cask[digunakan_bill])",
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $_SESSION['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				$up = array(
					'status_jurnal2' => 1
				);
				//$execf= $db->update("tx_order_tagihan_kd",$up,"digunakan_bill='$cask[digunakan_bill]'");
		 }
	 }elseif($cask['digunakan_bill']!='' and $cask['status_jurnal2']=='0' and $cask['jenis']=='1'){
		 $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='37' and status='1'");
					  foreach($ckpph as $ckpph2){}
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => "0",
							   'KREDIT' => $cask['total'],
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Piutang DN Bill ($cask[digunakan_bill])",
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $_SESSION['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				$up = array(
					'status_jurnal2' => 1
				);
				//$execf= $db->update("tx_order_tagihan_kd",$up,"digunakan_bill='$cask[digunakan_bill]'");
	 }elseif($cask['digunakan_bill']!='' and $cask['status_jurnal2']=='0' and $cask['jenis']=='2'){
		 $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='37' and status='1'");
					  foreach($ckpph as $ckpph2){}
					  $datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $cask['total'],
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Piutang KN Bill ($cask[digunakan_bill])",
							   'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $expl[0],
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'ID_GUD' => $_SESSION['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				
		 
	 }
	}

	//update status pembayaran
	foreach($_POST['bill_dtl'] as $key => $val1){
		
		
	$up = array(
					'status_jurnal2' => 1
				);
	$execf= $db->update("tx_order_tagihan_kd",$up,"digunakan_bill='".$_POST['no_billing'][$key]."'");
	
	
	//==========================================order tag bayar==================================
	$sat=$db->select("tx_order_tagihan_dtl","*","no_pt='$expl[0]' and id_bill_dtl='$val1' and no_spj='".$_POST['no_spj'][$key]."' and no_billing='".$_POST['no_billing'][$key]."'");
	foreach($sat as $val){  //foreach
		
			$up = array(
						'status' => 1,
						'tgl_bayar' => date("Y-m-d", strtotime($_POST['tgl_invo1'])),
						'no_ps' => $idj,
					);
			$execf= $db->update("tx_order_tagihan_bayar",$up,"no_pt='$expl[0]' and no_billing='$val[no_billing]' and id_bill_dtl='$val1' and no_spj='".$_POST['no_spj'][$key]."' and status=0");
			
			$ce=$db->select("tx_order_tagihan_bayar","sum(dibayar) as dibayar","no_spj='$val[no_spj]' and no_pt='$expl[0]' and no_billing='$val[no_billing]' and id_bill_dtl='$val[id_bill_dtl]'");
			foreach($ce as $cek){}
		
		
			$wes=$val['dibayar'];
		
			if($wes>=$cek['dibayar']){ //if
				$up = array(
						'status' => 1
					);
				$execf= $db->update("tx_order_tagihan_dtl",$up,"no_pt='$expl[0]' and no_billing='$val[no_billing]' and no_spj='$val[no_spj]'"); 
			} 	 //end
			
		}//end foreach
			//=============parsialan====================
			$sat3=$db->select("tx_order_tagihan_dtl","sum(dibayar)as dibayar","no_pt='$expl[0]'");
			foreach($sat3 as $val3){}
			
			$sat2=$db->select("tx_order_tagihan_bayar","sum(dibayar)as dibayar","no_pt='$expl[0]' and status='1'");
			foreach($sat2 as $val2){}	
			
					if($val3['dibayar']==$val2['dibayar']){ //if
							$up = array(
										'status' => 1
									);
							$execf= $db->update("tx_order_tagihan",$up,"no_pt='$expl[0]'");
							
							$up = array(
											'status' => 1
										);
							$execf= $db->update("tx_billing",$up,"no_billing='$val[no_billing]'");
			
					}//end if
			//=============end parsialan====================		
	}
	//===================dtl========================	
	$idall=$expl[0].'-'.$idj;	
	echo "<script>
	window.open('cetak.php?page=v_pembsupp&id=$idall');
	window.location='index.php?x=pembsupp';</script>";	
	}else{
	echo "<script>alert('Maaf kode rekening belum di set pada master supplier');window.location='index.php?x=pembsupp'</script>";		 
	}
	}else{
		echo "
			<script>
			alert('Saldo Tidak Mencukupi!!!');
			window.location='index.php?x=pembsupp'</script>";
		}
}

//}
else{//end tutup
		echo "<script>alert('Sudah Tutup Buku!');</script>";
		echo "
			<script>
			window.location='index.php?x=pembsupp'</script>";
}
?>


