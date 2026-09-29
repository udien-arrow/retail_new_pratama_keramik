<?php
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
				);
		$exec= $db->insert("ak_jurnal", $databk);
		
		//end jurnal head
		$idkm=$db->nourut('IDKM', 'ak_jurnal', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));	
		$pem=$db->select("hr_posting_gaji_habor a
JOIN m_pegawai b ON a.id_pegawai = b.id_pegawai
JOIN m_jabatan c ON b.id_jabatan = c.id_jabatan
JOIN m_cabang d ON a.id_cabang = d.id_cabang
","sum(a.total_terima)as total_terima, c.nama_jabatan,c.account,a.id_cabang,d.nama_cabang","a.status=0 and bulan='".$asd[0]."' and tahun='".$asd[1]."' group by c.id_jabatan");
		foreach($pem as $pem1){
				//biaya
				if($pem1['total_terima']>0){
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $pem1['account'],
							'DEBET'=> $pem1['total_terima'],
							'KREDIT'=> 0,
							'KET_DTL' => 'Biaya Gaji '.$pem1['nama_jabatan'].' CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $pem1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);
				$titil+=$pem1['total_terima'];
				}
		}
				//lawan
				$datadtl = array(
							'NO_JURNAL' => $idj,
							'ACC_CODE' => $_POST['rekening'],
							'DEBET'=> 0,
							'KREDIT'=> $titil,
							'KET_DTL' => 'Pembayaran Gaji Harian CAB: '.$pem1['nama_cabang'].' Periode '.$asd[0].'-'.$asd[1],
							'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'TGL_INVOICE' => date("Y-m-d"),
							'NO_INVOICE' => $idkm,
							'TANGGAL' => $tgl,
							'ID_CAB' => $pem1['id_cabang'],
							'TYPE_ARUSKAS' => $_POST['aruskas'],
				);
				$exec= $db->insert("ak_jurnal_dtl", $datadtl);
		//kas keluar
			$data_dtl_kk = array('IDKK' => $idkm,
								'TGL' => $tgl,
								'TGL_TRAN' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
								'JUMLAH' => $titil,
								'URAIAN' => "Pembayaran Gaji Harian",
								'id_cabang' => $_SESSION['ID_CABANG'],
								'type' => $_POST['aruskas'],
								
								);
			$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
		
		
		//end kas keluar
		//=============================================end pembayaran=====================================================================			
		//update posting	
		$datas = array(  
					 'status' => 1,
					);
		$exec= $db->update("hr_posting_gaji_habor", $datas,"bulan='".$asd['0']."'and tahun='".$asd['1']."'");
	    
        ?>