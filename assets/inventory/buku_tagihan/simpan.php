<?php
if($_POST['jumrow']>1){
 //if($_POST['jen']!=3){ 
	$te=0;
				//=====================header========================
				//jurnal
				$idjur=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$datajur = array(  
					   'IDKM'=> $idjur,
					   'NO_JURNAL' => $idjur,
					   'DEBET' => $_POST['grantot'],
					   'KREDIT' => $_POST['grantot'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $_SESSION['ID_GUDANG'],
					  );
				$execjur= $db->insertID("ak_jurnal", $datajur);

	foreach($_POST['no_faktur'] as $key => $val){
	  		$data = array( 
						'no_faktur' => $val,
						'id_cus' => $_POST['cus'],
						'total_piutang' => str_replace(",","",$_POST['total_piutang'][$key]),
						'id_user' => $_SESSION['ID_LOGIN'],
						'jenis_pembayaran' => '1',
						'total_dibayar' => str_replace(",","",$_POST['dibayar'][$key]),
						'tgl_bayar' => date("Y-m-d",strtotime($_POST['tgl'])),
						'stampdate' => date("Y-m-d H:i:s"),
						'no_seribg' => $_POST['no_bg'],
						'tgl_tempo' => date("Y-m-d",strtotime($_POST['tempo_bg'])),						
					);
				$exec= $db->insert("tx_pembayaran_sales", $data);
				
				$data = array( 
							'no_spj' => $val,
							'status' => '1', 
							);
				$exec= $db->update("tx_buku_bg", $data,"id_buku='$_POST[id_buku]'");
				//var_dump ($data);
				//echo "id_buku='$_POST[id_buku]'";
				//exit;

				if($_POST['sisa2'][$key] == 0){
						$data2 = array( 
							'status_bayar' => 1,
						);
						$exec= $db->update("tx_piutang", $data2,"no_faktur_jual='".$val."'");
				}	
				
				$where = array( 
							'no_faktur' => $val,
						);
				$exec= $db->delete("tx_piutang_tmp", $where);
						
			$te++;
	}//end for
	//=====jurnal=====
			foreach($db->select("m_customer","ifnull(account,'not')as acc","id_cus='$_POST[cus]'")as $kl);
			$tun=str_replace(",","",$_POST['tunai']);
			$tra=str_replace(",","",$_POST['transfer']);
			$pbg=str_replace(",","",$_POST['pbg']);
			$dttime = date("Y-m-d H:i:s");	
			if($tun>0){	
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $kl['acc'],
							   'DEBET' => "",
							   'KREDIT' => $tun,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG TUNAI",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $_POST['kasbank_tun'],
							   'DEBET' => $tun,
							   'KREDIT' => "",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG TUNAI",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );	  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
			}
			if($tra>0){	
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $kl['acc'],
							   'DEBET' => "",
							   'KREDIT' => $tra,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG TRANSFER",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $_POST['kasbank_tra'],
							   'DEBET' => $tra,
							   'KREDIT' => "",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG TRANSFER",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' =>$val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );	  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
			}
			if($pbg>0){	
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $kl['acc'],
							   'DEBET' => "",
							   'KREDIT' => $pbg,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG BG",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $_POST['kasbank_bg'],
							   'DEBET' => $pbg,
							   'KREDIT' => "",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG BG",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );	  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
			}
				
				//end jur
	

 //}else{ //===================end jenis row2==================
			 
			 
			 
			 
// }
 
}//end jumrow
	
	
	
	
	echo "<script>window.location='index.php?x=bukta'</script>";	

?>