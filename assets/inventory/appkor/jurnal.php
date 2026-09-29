<?php
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
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
			$aa=$db->select("tx_koreksi_piutang_dtl a join tx_koreksi_piutang b on a.no_piutang=b.no_koreksi","a.*,b.no_ref","a.no_piutang='$_POST[id]'");
			foreach($aa as $valtmp2){
				//update do
				$data = array(  
					   'harga'=> $valtmp2['harga_ganti'],
					  );
				$execjur= $db->update("tx_do_dtl", $data,"no_spj='$valtmp2[no_ref]' and id_barang='$valtmp2[id_barang]'");
				
				$tot+=$valtmp2['harga_ganti']*$valtmp2['qty'];
				$data = array(  
					   'jumlah_so'=> $tot,
					  );
				$execjur= $db->update("tx_do", $data,"no_spj='$valtmp2[no_ref]'");
				//end update do
				$dttime=date("Y-m-d H:i:s");
				$sel=$valtmp2['harga_ganti']-$valtmp2['harga_awal'];
				if($sel!=0){
				  if($sel>0){
					 $dpp=$sel/1.1;
					 $hrgbeli=$dpp*$valtmp2['qty'];
					 $ppn=$dpp*(10/100)*$valtmp2['qty'];
					 $totalan=$ppn+$hrgbeli;
					 //====jurnal piutang=================
					 $s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account,nama_usaha","id_cus='$vals[id_cus]'");
					 foreach($s as $pps){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $pps['account'],
								   'DEBET' => $totalan,
								   'KREDIT' => 0,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga ".$valtmp2['no_ref']." nama Customer : ".$pps['nama_usaha']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
					 //====penjualan=================
					 $ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","sales,nama_barang","a.id_barang='$valtmp2[id_barang]'");
					 foreach($ba as $bar){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $bar['sales'],
								   'DEBET' => 0,
								   'KREDIT' => $hrgbeli,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga ".$valtmp2['no_ref']." nama Barang : ".$bar['nama_barang']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
					 //====ppn=================
					 $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='3' and status='1'");
					foreach($ckpph as $ckpph2){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $ckpph2['acc_code'],
								   'DEBET' => 0,
								   'KREDIT' => $ppn,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga PPN Keluar ".$valtmp2['no_ref']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
				  }else{ //turun
					 $dpp=abs($sel)/1.1;
					 $hrgbeli=$dpp*$valtmp2['qty'];
					 $ppn=$dpp*(10/100)*$valtmp2['qty'];
					 $totalan=$ppn+$hrgbeli;
					 
					 //====penjualan=================
					 $ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","sales,nama_barang","a.id_barang='$valtmp2[id_barang]'");
					 foreach($ba as $bar){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $bar['sales'],
								   'DEBET' => $hrgbeli,
								   'KREDIT' => 0,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga ".$valtmp2['no_ref']."  nama Barang : ".$bar['nama_barang']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
					 //====ppn=================
					 $ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='3' and status='1'");
					foreach($ckpph as $ckpph2){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $ckpph2['acc_code'],
								   'DEBET' => $ppn,
								   'KREDIT' => 0,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga PPN Keluar ".$valtmp2['no_ref']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);  
					  //====jurnal piutang=================
					 $s=$db->select("m_customer","ifnull(pph,0) as pph,ifnull(account,0) as account,nama_usaha","id_cus='$vals[id_cus]'");
					 foreach($s as $pps){}
					 $datajur = array(  'NO_JURNAL' => $idj, 
								   'ACC_CODE' => $pps['account'],
								   'DEBET' => 0,
								   'KREDIT' => $totalan,
								   'USD' => "0",
								   'KURS' => "0",
								   'KET_DTL' => "AJ Koreksi Harga ".$valtmp2['no_ref']." nama Customer : ".$pps['nama_usaha']."",
								   'TGL_JURNAL' => date("Y-m-d"),
								   'TANGGAL' => $dttime,
								   'ID_CAB' => $_SESSION['ID_CABANG'],
								   'NO_INVOICE' => $_POST['id'],
								  );
					 $execjur= $db->insert("ak_jurnal_dtl", $datajur);
				  }//end if naik turun
					
					
				}
			}	
?>