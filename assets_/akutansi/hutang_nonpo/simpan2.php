<?php

if($_POST['aksi']=='hapus'){
	$where = array("id_dtl" => $_POST['id']);
	$db->delete("tx_bph_dtl_tmp",$where);
	echo "<script>window.location='index.php?x=htnonpo'</script>";
	}
else{
	$tabel_dtl = "ak_jurnal_dtl";
	$tabel="tx_bph";
	$idj=$db->nourut('no_bph', 'tx_bph', 'BPH', sprintf("%02s", $_POST['cabang']), date("Y-m-d"));
	$id=$db->idurut("tx_bph","id_bph");
	$dpp = $_POST['dpp'];
	$new_dpp = str_replace(',','',$dpp);
	$ppn = $_POST['ppn'];
	$new_ppn = str_replace(',','',$ppn);
	$pph = $_POST['pph'];
	$new_pph = str_replace(',','',$pph);
	$total_seluruh = $_POST['total_seluruh'];
	$new_total_seluruh = str_replace(',','',$total_seluruh);
	$dttime=date("Y-m-d H:i:s");
	$pos = $new_jml;
	$acc=explode("-",$_POST['korek']);
	
	//=========================================
									
		$data = array( 
				 'id_bph' => $id,
				 'no_bph' => $idj,
				 'keterangan' => $_POST['cat'],
				 'id_supplier' =>  $_POST['supplier'],
				 'dpp' => $new_dpp,				
				 'ppn' => $new_ppn,
				 'pphpersen' => $_POST['pphpersen'],
				 'pph' => $new_pph,
				 'total' => $new_total_seluruh,
				 'status' => 1,
				 'id_user' => $_SESSION['ID_LOGIN'],
				 'tgl' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
				 'tgl_input' => $dttime,
				);
		
		$exec= $db->insertID($tabel, $data);
		
	
		foreach($db->select("tx_bph_dtl_tmp","*","ID_USER='$_SESSION[ID_LOGIN]'") as $km){
				$tabelkm="tx_bph_dtl";
				$dttime=date("Y-m-d H:i:s");
				$datakm = array(  //'id_bph' => $exec,
								   'id_bph' => $id,
								   'deskripsi' => $km['deskripsi'],
								   'acc_code' => $km['acc_code'],
								   'jumlah' => $km['jumlah'],
								   
								  );
				$execjur= $db->insert($tabelkm, $datakm);
				
				$tabel="tx_bph_dtl_tmp";
				$where = array("id_dtl" => $km['id_dtl'],
							   "id_user" => $_SESSION['ID_LOGIN']); 
				$exec1= $db->delete($tabel, $where);
		}
	
	// =================================== Auto Jurnal
	$tabelbk = "ak_jurnal";
	$idjur=$db->idurut("ak_jurnal","IDJ");
	$su=$db->select("m_supplier","ifnull(account,0) as account, account_pph","id_supp=$_POST[supplier]");
	foreach($su as $sup){}
	
	if($sup['account']!='0'){
		foreach($max as $val){}
		$id=$val['id']+1;		  
		$databk = array( 'IDJ' => $idjur,
					'NO_JURNAL' => $idj,
					'IDKM' => $_POST['no_invoice'],
					'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
					'URAIAN' => $_POST['cat'],
					'DEBET' => $new_total_seluruh,
					'KREDIT' => $new_total_seluruh,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_POST['cabang'],
					'ID_GUD' => $_SESSION['ID_GUDANG']
				);
		$execjurnal= $db->insert($tabelbk, $databk);
				
		$sat=$db->select("tx_bph_dtl a JOIN tx_bph b ON a.id_bph = b.id_bph","a.deskripsi AS deskripsi, a.acc_code AS acc_code, a.jumlah AS jumlah","b.no_bph ='$idj'");
		foreach($sat as $val){
		
		//=======DPP
		$tabel_dtl0 = "ak_jurnal_dtl";	
		$datadtl0 = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $val['acc_code'],
						'DEBET'=> $val['jumlah'],
						//'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].'',
						'KET_DTL' => $_POST['cat']."-".$val['deskripsi'],
						//'TGL_JURNAL' => $dttime,
						'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
						'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
						'NO_INVOICE' => $_POST['no_invoice'],
						'TANGGAL' => $dttime,
						'ID_CAB' => $_POST['cabang'],
				);
		$exec= $db->insert($tabel_dtl0, $datadtl0);
		//R/k Lawan
		}
		
		//========PPN
		//if($_POST['pkp']==1){
		$ls1=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
		foreach($ls1 as $las1){}
		$tabel_dtl1 = "ak_jurnal_dtl";
			$datadtl1 = array('NO_JURNAL' => $idj,
							'ACC_CODE' => $las1['acc_code'],
							'DEBET'=> $new_ppn,
							//'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].'',
							'KET_DTL' => $_POST['cat'],
							'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							'NO_INVOICE' => $_POST['no_invoice'],
							'TANGGAL' => $dttime,
							'ID_CAB' => $_POST['cabang'],												
			);
		$exec1= $db->insert($tabel_dtl1, $datadtl1);
		//}
		
		//=========PPH
		//$ls2=$db->select("ak_parameterjur","*","id_m_parameterjur='2' and status='1'");
		//foreach($ls2 as $las2){}
		$tabel_dtl2 = "ak_jurnal_dtl";
			$datadtl2 = array('NO_JURNAL' => $idj,
							'ACC_CODE' => $sup['account_pph'],
							'KREDIT'=> $new_pph,
							//'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].'',
							'KET_DTL' => $_POST['cat'],
							'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							'NO_INVOICE' => $_POST['no_invoice'],
							'TANGGAL' => $dttime,
							'ID_CAB' => $_POST['cabang'],						
			);
		$exec2= $db->insert($tabel_dtl2, $datadtl2);
		
		//=========HUTANG		
		//$ls3=$db->select("ak_parameterjur","*","id_m_parameterjur='20' and status='1'");
		//foreach($ls3 as $las3){}
		$tabel_dtl3 = "ak_jurnal_dtl";	
			$datadtl3 = array('NO_JURNAL' => $idj,
							'ACC_CODE' => $sup['account'],
							'KREDIT'=> $new_total_seluruh,
							//'KET_DTL' => 'Pembayaran Supplier NO.PT '.$expl[0].'',
							'KET_DTL' => $_POST['cat'],
							'TGL_JURNAL' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							'TGL_INVOICE' => date("Y-m-d",strtotime($_POST['tgl_transaksi'])),
							'NO_INVOICE' => $_POST['no_invoice'],
							'TANGGAL' => $dttime,
							'ID_CAB' => $_POST['cabang'],
					);
		$exec3= $db->insert($tabel_dtl3, $datadtl3);		
		
						//echo $val['dibayar'].' - '.$val['id_cabang']."<br>";
		//}	
	} else {
		echo "<script>alert('Maaf kode rekening belum di set pada master supplier');window.location='index.php?x=htnonpo'</script>";		 
	}

echo "<script>
window.open('cetak.php?page=v_htnonpo&id=$idj&user=$_SESSION[ID_LOGIN]');
window.location='index.php?x=htnonpo'</script>";
}

	
?>