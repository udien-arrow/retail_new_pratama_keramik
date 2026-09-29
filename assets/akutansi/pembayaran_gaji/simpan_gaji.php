<?php
//header jurnal
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		
		$tgl = date('Y-m-d H:i:s');
		$databk = array( 
					'NO_JURNAL' => $idj,
					'IDKM' => $idkm,
					'TGL_JURNAL' => $tgl,
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_SESSION['ID_CABANG'],
				);
		$exec= $db->insert("ak_jurnal", $databk);
		
		
		$hutg=$db->select("ak_parameterjur","*","id_m_parameterjur='28' and status='1'");
		foreach($hutg as $hutang);	
		$ayat=$db->select("ak_parameterjur","*","id_m_parameterjur='43' and status='1'");
		foreach($ayat as $ayatcinta);
		//=============================================Gaji=====================================================================
		//=============================================Gaji=====================================================================
		//=============================================Gaji=====================================================================
		$hr=$db->select("hr_posting_gaji a join m_cabang b on a.id_cabang=b.id_cabang","a.id_cabang,b.nama_cabang,sum(gaji_pokok+tunj_pengabdian+ub_notebook+ub_komunikasi+ub_motor+ub_diklat+ins_cabang+rapel+lain2+jamsostek_724+tunj_sehat-potpel_pr-potpel_pf-potpel_pp) AS gaji_bruto,
		sum(tunj_umum+tunj_fungsi+tunj_repre) AS tunj_tetap,
		sum(tunj_presensi+tunj_penempatan) AS tunj_tidaktetap","a.status='0' and bulan='".$asd['0']."' and tahun='".$asd['1']."' and a.id_cabang='".$asc['2']."'");
		//die();
		foreach($hr as $gj){
			//bruto
			$gaj=$db->select("ak_parameterjur","*","id_m_parameterjur='26' and status='1'");
			foreach($gaj as $gaji1);
			$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $gaji1['acc_code'],
							'DEBET'=> $gj['gaji_bruto'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Pembayaran Gaji CAB: '.$gj['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $gj['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
			$exec= $db->insert("ak_jurnal_dtl", $datadtl);
			//tetap
			$gaj=$db->select("ak_parameterjur","*","id_m_parameterjur='40' and status='1'");
			foreach($gaj as $gaji1);
			$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $gaji1['acc_code'],
							'DEBET'=> $gj['tunj_tetap'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Pembayaran Tunj Tetap CAB: '.$gj['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $gj['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
			$exec= $db->insert("ak_jurnal_dtl", $datadtl);
			//tidak tetap
			$gaj=$db->select("ak_parameterjur","*","id_m_parameterjur='41' and status='1'");
			foreach($gaj as $gaji1);
			$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $gaji1['acc_code'],
							'DEBET'=> $gj['tunj_tidaktetap'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Pembayaran Tunj Tidak Tetap CAB: '.$gj['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $gj['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
			$exec= $db->insert("ak_jurnal_dtl", $datadtl);
			//hutang
			$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $hutang['acc_code'],
							'DEBET'=> 0,
							'KREDIT'=> $gj['gaji_bruto']+$gj['tunj_tetap']+$gj['tunj_tidaktetap'],
							'KET_DTL' => 'Hutang Gaji CAB: '.$gj['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $gj['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
			$exec= $db->insert("ak_jurnal_dtl", $datadtl);
		}
		//=============================================end Gaji=====================================================================
		//=============================================end Gaji=====================================================================
		//=============================================potongan=====================================================================
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$tgl = date('Y-m-d H:i:s');
		//jurnal head
		$databk = array( 
					'NO_JURNAL' => $idj,
					'IDKM' => $idkm,
					'TGL_JURNAL' => $tgl,
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_SESSION['ID_CABANG'],
					'TYPE_ARUSKAS' => $_POST['aruskas'],					
				);
		$exec= $db->insert("ak_jurnal", $databk);
		//end jurnal head
		$gaj=$db->select("hr_posting_gaji_pot a join m_cabang b on a.id_cabang=b.id_cabang","a.id_cabang,b.nama_cabang","a.status=0 and bulan='".$asd[0]."' and tahun='".$asd[1]."'  and id_cabang='".$asd['2']."'");
		foreach($gaj as $gaji1){
			$tunj=$db->select("hr_posting_gaji_pot a
JOIN hr_m_potongan_opr b ON a.jenis = b.id_jenis","sum(nominal) AS nominal,
	b.nama_jenis,a.account","a.status=0 and bulan='".$asd[0]."' and tahun='".$asd[1]."' and a.id_cabang ='$gaji1[id_cabang]' GROUP BY account");
			$tot=0;
			foreach($tunj as $tunjd){
				//potongan2
				$datadtl = array(
								'NO_JURNAL' => $idj,
								'ACC_CODE' => $tunjd['account'],
								'DEBET'=> 0,
								'KREDIT'=> $tunjd['nominal'],
								'KET_DTL' => 'Potongan '.$tunjd['nama_jenis'].' CAB: '.$gaji1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
								'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
								'TGL_INVOICE' => date("Y-m-d"),
								'NO_INVOICE' => $idkm,
								'TANGGAL' => $tgl,
								'ID_CAB' => $gaji1['id_cabang'],
								'TYPE_ARUSKAS' => $_POST['aruskas'],
					);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);
				$tot+=$tunjd['nominal'];
			}
				//hutang
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $hutang['acc_code'],
							'DEBET'=> $tot,
							'KREDIT'=> 0,
							'KET_DTL' => 'Hutang Gaji CAB: '.$gaji1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $gaji1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);
		
		}
		//=============================================end potongan=====================================================================			
		//=============================================pembayaran=====================================================================			
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
		$tgl = date('Y-m-d H:i:s');
		//jurnal head
		$databk = array( 
					'NO_JURNAL' => $idj,
					'IDKM' => $asd['0'].'-'.$asd['1'],
					'TGL_JURNAL' => $tgl,
					'URAIAN' => $_POST['cacat'],
					'DEBET' => $total,
					'KREDIT' => $total,
					'USER' => $_SESSION['ID_LOGIN'],					
					'ID_CAB' => $_SESSION['ID_CABANG'],	
					'TYPE_ARUSKAS' => $_POST['aruskas'],				
				);
		$exec= $db->insert("ak_jurnal", $databk);
		//end jurnal head
		
		
		$pem=$db->select("hr_posting_gaji a join m_cabang b on a.id_cabang=b.id_cabang","a.id_cabang,b.nama_cabang,sum(jumlah_terima)as netto","a.status=0 and bulan='".$asd[0]."' and tahun='".$asd[1]."' and a.id_cabang='".$asd['2']."'");
		foreach($pem as $pem1){
			
			if($pem1['id_cabang']==0){ //bila pusat
				//hutang
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $hutang['acc_code'],
							'DEBET'=> $pem1['netto'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Hutang Gaji CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $pem1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);	
				//bank
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $_POST['rekening'],
							'DEBET'=> 0,
							'KREDIT'=> $pem1['netto'],
							'KET_DTL' => 'Pembayaran Gaji CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $pem1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);	
			}else{
				//hutang
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $hutang['acc_code'],
							'DEBET'=> $pem1['netto'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Hutang Gaji CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $pem1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);	
				//ayat2 cinta kredit
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $ayatcinta['acc_code'],
							'DEBET'=> 0,
							'KREDIT'=> $pem1['netto'],
							'KET_DTL' => 'Ayat Silang Biaya CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $pem1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);	
				//ayat2 cinta debet
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $ayatcinta['acc_code'],
							'DEBET'=> $pem1['netto'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Ayat Silang Biaya CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $_SESSION['ID_CABANG'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);	
				//bank
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $_POST['rekening'],
							'DEBET'=> 0,
							'KREDIT'=> $pem1['netto'],
							'KET_DTL' => 'Pembayaran Gaji CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $_SESSION['ID_CABANG'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);	
				
			}
			
		}
		$titil+=$pem1['netto'];
		
		
		
		//end kas keluar
		//=============================================end pembayaran=====================================================================			
		//update posting	
		$datas = array(  
					 'status' => 1,
					);
		$exec= $db->update("hr_posting_gaji", $datas,"bulan='".$asd['0']."' and tahun='".$asd['1']."' and id_cabang='".$asd['2']."'");
		//update posting	
		$datas = array(  
					 'status' => 1,
					);
		$exec= $db->update("hr_posting_gaji_pot", $datas,"bulan='".$asd['0']."' and tahun='".$asd['1']."' and id_cabang='".$asd['2']."'");
        
        ?>