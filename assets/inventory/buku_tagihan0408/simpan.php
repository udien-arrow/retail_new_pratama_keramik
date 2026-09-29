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
	  if(str_replace(",","",$_POST['dibayar'][$key]) > 0){
				$data = array( 
						'no_faktur' => $val,
						'id_cus' => $_POST['cus'],
						'total_piutang' => str_replace(",","",$_POST['total_piutang'][$key]),
						'id_user' => $_SESSION['ID_LOGIN'],
						'jenis_pembayaran' => '1',
						'total_dibayar' => str_replace(",","",$_POST['dibayar'][$key]),
						'tgl_bayar' => date("Y-m-d",strtotime($_POST['tgl'])),
						'stampdate' => date("Y-m-d H:i:s"),
						'id_bank' => $_POST['kasbank'][$key],
						'tgl_tempo' => date("Y-m-d",strtotime($_POST['tglt'])),
						'no_seribg' => $_POST['no_seri'],
					);
				$exec= $db->insert("tx_pembayaran_sales", $data);
				
				if(str_replace(",","",$_POST['sisa'][$key]) == 0){
						$data2 = array( 
							'status_bayar' => 1,
						);
						$exec= $db->update("tx_piutang", $data2,"no_faktur_jual='".$val."'");
				}
				//=====jurnal=====
				foreach($db->select("m_customer","ifnull(account,'not')as acc","id_cus='$_POST[cus]'")as $kl);
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $kl['acc'],
							   'DEBET' => "",
							   'KREDIT' => str_replace(",","",$_POST['dibayar'][$key]),
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				
				if($_POST['jen']==1){
					$kasbank=$_POST['kasbank'];
				}
				if($_POST['jen']==2){
					$kasbank=$_POST['kasbank'][$key];
				}
				
				
				$datajur2 = array(  
							   'NO_JURNAL' => $idjur, 
							   'ACC_CODE' => $kasbank,
							   'DEBET' => str_replace(",","",$_POST['dibayar'][$key]),
							   'KREDIT' => "",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "AUTO JURNAL PEMBAYARAN PIUTANG KASBANK",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TGL_INVOICE' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $val,
							   'ID_GUD' => $_SESSION['ID_GUDANG'],
							  );
							  
				$execjur= $db->insert("ak_jurnal_dtl", $datajur2);
				//end jur
			$te++;
		}//end if
	}//end for

 //}else{ //===================end jenis row2==================
			 
			 
			 
			 
// }
 
}//end jumrow
	
	
	
	
	echo "<script>window.location='index.php?x=bukta'</script>";	

?>