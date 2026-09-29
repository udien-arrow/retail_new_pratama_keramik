<?php
	if($_POST['setuju']){
		foreach($_POST['cek'] as $key => $value){
		if($value!=''){
		$exp=explode("_",$value);
		foreach($db->select("m_pegawai_habor","*","id='$exp[0]'")as $dat2)
		if($exp[1]==1){			
			$tabel = "m_pegawai";
			$id=$db->idurut($tabel,"id_pegawai");
			if($dat2['id_status']==4){$nr="TH";}elseif($dat2['id_status']==5){$nr="TB";}
			$thn=substr($dat2['tgl_mulai'],2,2);
				$nik=$nr.$thn.sprintf("%04s", $id);
				$data = array( 
					'id_pegawai' => $id, 
					'nik' => $nik, 
					'id_cabang' => $dat2['id_cabang'],
					'id_jabatan' => $dat2['id_jabatan'],
					'no_ktp' => $dat2['no_ktp'],
					'id_status' => $dat2['id_status'],
					'id_aktif' => 1,
					'tgl_mulai' => $dat2['tgl_mulai'],
					'nama_pegawai' => $dat2['nama_pegawai'],
					);
				$exec= $db->insert($tabel, $data);
				
				$idk=$db->idurut("hr_kontrakpeg","id_kontrak");
				$data = array( 
					'id_kontrak' => $idk, 
					'id_pegawai' => $id, 
					'nik_peg' => $nik, 
					'id_aktif' => $dat2['id_aktif'], 
					'id_status' => $dat2['id_status'],
					'tglmulai' => $dat2['tgl_mulai'],
					'id_aktif' => 1,
					'userid' => $_SESSION['ID_LOGIN'],
					'tgl_inputkontrak' => date("Y-m-d H:i:s"),
					);
				$exec= $db->insert("hr_kontrakpeg", $data);
				//===============kedudukan==================
				$idt=$db->idurut("hr_jabatanpeg","id_tdjab");
				$data = array( 
					'id_tdjab' => $idt, 
					'id_pegawai' => $id, 
					'id_jabatan' => $dat2['id_jabatan'], 
					'tgl_jabat' => $dat2['tgl_mulai'], 
					'id_cabang' => $dat2['id_cabang'], 
					'tgl_inputjab' => date("Y-m-d H:i:s"),
					'userid_jabpeg' => $_SESSION['ID_LOGIN'],
					);
				$exec= $db->insert("hr_jabatanpeg", $data);
				//===============kedudukan==================
				$ida=$db->idurut("hr_alamat","id_alamat");
				$data = array( 
					'id_alamat' => $ida, 
					'id_pegawai' => $id, 
					'alamat_peg' => $dat2['alamat'], 
					'ket' => '',
					);
				$exec= $db->insert("hr_alamat", $data);
				//update
				$where = array( 
					'id' => $exp[0], 
					);
				$exec= $db->delete("m_pegawai_habor", $where);
			}
		}//end if jenis
		if($exp[1]==2){		
				$data = array( 
					'id_aktif' => 3, 
					);
				$exec= $db->update("m_pegawai", $data,"id_pegawai='$dat2[id_pegawai]'");
				foreach($db->select("hr_kontrakpeg","*","id_pegawai='$dat2[id_pegawai]' order by id_kontrak desc limit 0,1")as $ktr)
				$idk=$db->idurut("hr_kontrakpeg","id_kontrak");
				$data = array( 
					'id_kontrak' => $idk, 
					'id_pegawai' => $ktr['id_pegawai'], 
					'nik_peg' => $ktr['nik_peg'], 
					'id_aktif' => 3, 
					'id_status' => $ktr['id_status'],
					'tglmulai' => $ktr['tglmulai'],
					'tglakhir' => $dat2['tgl_keluar'],
					'userid' => $_SESSION['ID_LOGIN'],
					'tgl_inputkontrak' => date("Y-m-d H:i:s"),
					);
				$exec= $db->insert("hr_kontrakpeg", $data);
				//update
				$where = array( 
					'id' => $exp[0], 
					);
				$exec= $db->delete("m_pegawai_habor", $where);
		}
		}	
	}
	if($_POST['tolak']){
		foreach($_POST['cek'] as $key => $value){
			if($value!=''){
				$exp=explode("_",$value);
				$where = array( 
					'status' => 2, 
					);
				$exec= $db->update("m_pegawai_habor", $where,"id='$exp[0]'");
			}
		}
	}
		
		
	echo "<script>window.location='index.php?x=apppeghabor'</script>";

?>