<?php
$tabel_dtl = "ak_jurnal_dtl";
	$titil=$_POST['jumlah_bonus'][$key]+$_POST['pot_lain'][$key]+$_POST['pot_pelanggaran'][$key];
		//kas keluar
			$datas = array(  
					 'status' => 2,
					);
		$exec= $db->update("hr_bonus", $datas,"periode='".$_POST['periodes'][$key]."'");
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
		$data_dtl_kk = array('IDKK' => $idkm,
							'TGL' => $tgl,
							'TGL_TRAN' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'JUMLAH' => $titil,
							'URAIAN' => "Pembayaran Bonus",
							'id_cabang' => $_SESSION['ID_CABANG'],
							'type' => $_POST['aruskas'],
							);
		$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
		if($_POST['jenisnya']==1){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='29' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus THR Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus THR Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}elseif($_POST['jenisnya']==2){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='34' and status='1'");
		foreach($bpj as $es);
			
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Kinerja Triwulan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Kinerja Triwulan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}elseif($_POST['jenisnya']==3){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='35' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Cuti Tahunan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Cuti Tahunan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}elseif($_POST['jenisnya']==4){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='37' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Tunjangan Keluarga Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Tunjangan Keluarga Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}elseif($_POST['jenisnya']==5){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='38' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Fasilitas Jabatan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Fasilitas Jabatan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}elseif($_POST['jenisnya']==6 or $_POST['jenisnya']==7){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='36' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Ikatan Batin/Cuti Besar Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Ikatan Batin/Cuti Besar Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}elseif($_POST['jenisnya']==8){
			//thr
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='33' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Tahunan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//thr
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['jumlah_bonus'][$key],
						'KET_DTL' => 'Bonus Tahunan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG'],
						'TYPE_ARUSKAS' => $_POST['aruskas'],
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}
		if($_POST['pot_pelanggaran'][$key]!='0')
		{
			
			//potongan
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='31' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['pot_pelanggaran'][$key],
						'KET_DTL' => 'Potongan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//potongan
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['pot_pelanggaran'][$key],
						'KET_DTL' => 'Potongan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG']
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}
		if($_POST['pot_lain'][$key]!='0')
		{
			
			//potongan
		$bpj=$db->select("ak_parameterjur","*","id_akunparam='31' and status='1'");
		foreach($bpj as $es);
		$tabel_dtl = "ak_jurnal_dtl";	
		$datadtl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $es['acc_code'],
						'DEBET'=> $_POST['pot_lain'][$key],
						'KET_DTL' => 'Potongan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl
			);
		$exec= $db->insert($tabel_dtl, $datadtl);
		//potongan
		$data_dtl_ttl = array('NO_JURNAL' => $idj,
						'ACC_CODE' => $_POST['rekening'],
						'KREDIT' => $_POST['pot_lain'][$key],
						'KET_DTL' => 'Potongan Periode '.$_POST['periodes'][$key],
						'TGL_JURNAL' => date("Y-m-d"),
						'TGL_INVOICE' => date("Y-m-d"),
						'NO_INVOICE' => $_POST['periodes'][$key],
						'TANGGAL' => $tgl,
						'ID_CAB' => $_SESSION['ID_CABANG']
			);
		$execb= $db->insert("ak_jurnal_dtl", $data_dtl_ttl);
		}        
        ?>