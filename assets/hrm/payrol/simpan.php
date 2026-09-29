	<?php
	$tabel = "hr_posting_gaji";
	$cek=count($db->select($tabel,"*","bulan='$_POST[bulan]' and tahun='$_POST[tahun]' and status=0"));
	$cek2=count($db->select($tabel,"*","bulan='$_POST[bulan]' and tahun='$_POST[tahun]' and status=1"));
	if($cek>0 || $cek2==0){
			$data = array( 
					'tahun' => $_POST['tahun'],
					'bulan' => $_POST['bulan'],
			);
			$exec= $db->delete($tabel, $data);
			
	foreach($_POST['id_aktif'] as $key => $value){
		if($value!=''){
			$data = array( 
					'id_pegawai' => $_POST['id_pegawai'][$key],
					'bulan' => $_POST['bulan'],
					'tahun' => $_POST['tahun'],
					'id_aktif' => $_POST['id_aktif'][$key],
					'id_status' => $_POST['id_status'][$key],
					'id_pangkat' => $_POST['id_pangkat'][$key],
					'id_st_jabatan' => $_POST['id_st_jabatan'][$key],
					'id_golongan' => $_POST['id_golongan'][$key],
					'id_status_kel' => $_POST['id_statuskel'][$key],
					'id_cabang' => $_POST['id_cabang'][$key],
					'gaji_pokok' => $_POST['gaji_pokok'][$key],
					'tunj_umum' => $_POST['tunj_umum'][$key],
					'tunj_repre' => $_POST['tunj_repre'][$key],
					'tunj_fungsi' => $_POST['tunj_fungsi'][$key],
					'tunj_presensi' => $_POST['ins_presensi'][$key],
					'tunj_penempatan' => $_POST['tunj_penempatan'][$key],
					'tunj_pengabdian' => $_POST['op6'][$key],
					'ub_notebook' => $_POST['op7'][$key],
					'ub_komunikasi' => $_POST['op8'][$key],
					'ub_motor' => $_POST['op9'][$key],
					'ub_diklat' => $_POST['op10'][$key],
					'ins_cabang' => $_POST['op11'][$key],
					'rapel' => $_POST['op12'][$key],
					'lain2' => $_POST['op13'][$key],
					'jamsostek_724' => $_POST['jamsostek_724'][$key],
					'potbpjssehat' => $_POST['ibk'][$key],
					'tunj_sehat' => $_POST['tunj_sehat'][$key],
					'jumlah_kotor' => $_POST['jumlah_kotor'][$key],
					'simpan_pinjam' => $_POST['po1'][$key],
					'simpanan_wajib' => $_POST['po2'][$key],
					'pensiun' => $_POST['po3'][$key],
					'hutang' => $_POST['po4'][$key],
					'lain22' => $_POST['po5'][$key],
					'jamsostek_924' => $_POST['jamsostek_924'][$key],
					'potpel_pr' => $_POST['potpel_pr'][$key],
					'potpel_pf' => $_POST['potpel_pf'][$key],
					'potpel_pp' => $_POST['potpel_pp'][$key],
					'jumlah_terima' => $_POST['jumlah_terima'][$key],
					'stampdate' => date("Y-m-d H:i:s"),
					'id_user' => $_SESSION['ID_LOGIN'],
					'status' => '0',
					);				
			
			$exec= $db->insert($tabel, $data);
		}
	}
	}
			echo "<script>
			alert('Data Sudah diposting');
			window.location='index.php?x=payrol'</script>";

?>