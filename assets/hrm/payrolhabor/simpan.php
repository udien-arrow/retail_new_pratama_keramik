	<?php
	$tabel = "hr_posting_gaji_habor";
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
					'id_cabang' => $_POST['id_cabang'][$key],
					'gaji_pokok' => $_POST['gaji_pokok'][$key],
					'jumlah_terima' => $_POST['gaji_terima'][$key],
					'lembur' => $_POST['lembur'][$key],
					'total_terima' => $_POST['jumlah_terima'][$key],
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
			window.location='index.php?x=payrolhabor'</script>";

?>