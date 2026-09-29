	<?php
	foreach ($_POST['app'] as $key => $value) {
		$asd=explode("_",$value);
			 if($value!=""){
					$datas = array(  
					 'status' => 1,
					);
		$exec= $db->update("hr_posting_gaji", $datas,"bulan='".$asd['0']."'and tahun='".$asd['1']."'");
		
		$gaji_pokok=$_POST['gaji_pokok'][$key];
		$tunj_umum=$_POST['tunj_umum'][$key];
		$tunj_repre=$_POST['tunj_repre'][$key];
		$tunj_fungsi=$_POST['tunj_fungsi'][$key];
		$tunj_presensi=$_POST['tunj_presensi'][$key];
		$tunj_pengabdian=$_POST['tunj_pengabdian'][$key];
		$tunj_penempatan=$_POST['tunj_penempatan'][$key];
		$ub_notebook=$_POST['ub_notebook'][$key];
		$ub_komunikasi=$_POST['ub_komunikasi'][$key];
		$ub_diklat=$_POST['ub_diklat'][$key];
		$ins_cabang=$_POST['ins_cabang'][$key];
		$rapel=$_POST['rapel'][$key];
		$lain2=$_POST['lain2'][$key];
		$ub_motor=$_POST['ub_motor'][$key];
		$jamsostek_724=$_POST['jamsostek_724'][$key];
		//tunjangan sehat
		$tunj_sehat=$_POST['tunj_sehat'][$key];
		//potongan
		$simpan_pinjam=$_POST['simpan_pinjam'][$key];
		$simpanan_wajib=$_POST['simpanan_wajib'][$key];
		$pensiun=$_POST['pensiun'][$key];
		$hutang=$_POST['hutang'][$key];
		$lain22=$_POST['lain22'][$key];
		$jamsostek_924=$_POST['jamsostek_924'][$key];
		$potbpjssehat=$_POST['potbpjssehat'][$key];
		
		
		$gaji=$gaji_pokok+$tunj_umum+$tunj_repre+$tunj_fungsi+$tunj_presensi+$tunj_penempatan+$ub_notebook+$ub_komunikasi+$ub_diklat+$ins_cabang+$rapel+$lain2+$ub_motor+$jamsostek_724+$tunj_pengabdian;
		$tunjangan_sehat=$tunj_sehat;
		$potongan=$simpan_pinjam+$simpanan_wajib+$pensiun+$hutang+$lain22+$jamsostek_924+$potbpjssehat;
		//echo $gaji."<br>".$potongan;
		
		//header
		$tabelbk = "ak_jurnal";
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$idkm=$db->nourut('IDKM', 'ak_jurnal', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
		$tgl = date('Y-m-d H:i:s');
		$max=$db->select($tabelbk,"max(IDJ)as id");
		foreach($max as $val){}
		$id2=$val['id']+1;
		$databk = array( 'IDJ' => $id2,
					'NO_JURNAL' => $idj,
					'IDKM' => $idkm,
					'TGL_JURNAL' => $tgl,
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_SESSION['ID_CABANG']					
				);
		$exec= $db->insert($tabelbk, $databk);
		
		//================ pembalik (debet)=============================================================================
		
		//Gaji
		$gaj=$db->select("ak_parameterjur","*","id_akunparam='29'");
		foreach($gaj as $gaji1);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $gaji1['acc_code'],
						'DEBET'=> $gaji,
						'KET_DTL' => 'Pembayaran Gaji Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		
		
		//gaji
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $gaji,
						'KET_DTL' => 'Pembayaran Gaji Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG']
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
		
		
		//bpjs
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='30'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $tunjangan_sehat,
						'KET_DTL' => 'Tunjangan BPJS Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		
		//bpjs
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $tunjangan_sehat,
						'KET_DTL' => 'Tunjangan BPJS Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG']
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
		//potongan
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='31'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $potongan,
						'KET_DTL' => 'Potongan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//================ end pembalik=============================================================================
		// buat total(balance) 
		//potongan
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $potongan,
						'KET_DTL' => 'Potongan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG']
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		
		
		}
	}
		echo "<script>window.location='index.php?x=pembgaji'</script>";

?>