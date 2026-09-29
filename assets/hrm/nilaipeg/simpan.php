<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "hr_penilaian_pegawai";
	  if($_POST['kode']==''){
		  		$per=$_POST['tahunsd'].'-'.$_POST['bulansd'].'-01';
				
				$jum=count($db->select("hr_penilaian_pegawai","*","id_pegawai='$_POST[pegawai]' and date='$per'"));
				if($jum==0){
				$data = array( 
							'id_pegawai' => $_POST['pegawai'],
							'date' => $per,
							'stampdate' => date("Y-m-h H:i:s"),
							'nilai' => str_replace(",","",$_POST['nilai']),
							'id_user' => $_SESSION['ID_LOGIN'],
					);
				$exec= $db->insert($tabel, $data);
				}
		  echo "<script>window.location='index.php?x=nilaipeg'</script>";
	  }
}
//==================================================sub dep====================================================

?>