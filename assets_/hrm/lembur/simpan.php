	<?php
	$tabel = "hr_lembur";
	
	foreach($_POST['split'] as $key => $value){
		if($value!=''){
			
			$f=explode("_",$_POST['datalem'][$key]);
			$e=explode(":",$f[0]);
			$de=(int)$e[0];
			
			$data = array( 
					'id_pegawai' => $f[1],
					'date' => $f[2],
					'stampdate' => date("Y-m-d H:i:s"),
					'jam' => $de,
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => '',
					'id_cabang' => $f[3],
					'id_abs' => $f[4],
					);				
			
			$exec= $db->insert($tabel, $data);
		}
	}
			echo "<script>
			alert('Sukses Simpan');
			window.location='index.php?x=lembur&tahun=$_POST[tahun]&bulan=$_POST[bulan]'</script>";

?>