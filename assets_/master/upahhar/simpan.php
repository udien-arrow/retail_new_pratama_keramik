<?php
$tabel = "hr_upah_harian";
if($_POST[kode]==''){	
		foreach($_POST['id_jabatan'] as $key => $val){
			if($val!=''){
					if($_POST['nominal_hari']==0){
						$nm=$_POST['nominal_bulan']/25;	
					}else{
						$nm=$_POST['nominal_hari'];	
					}			
					$id=$db->idurut("hr_upah_harian","id_upah");
					$data = array( 
					'id_upah' => $id, 
					'id_jabatan' => $val, 
					'id_cabang' => $_POST['cabang'], 
					'nominal_bulan' => $_POST['nominal_bulan'], 
					'nominal_hari' => $nm,
					'nominal_lembur' => $_POST['nominal_lembur'],
					'tgl_berlaku' => date("Y-m-d"),
					);
					$exec= $db->insert($tabel, $data);
			}
		}
		echo "<script>window.location='index.php?x=upahhar'</script>";
}


?>