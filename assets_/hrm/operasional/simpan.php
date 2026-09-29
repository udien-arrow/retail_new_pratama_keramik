<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "hr_operasional";
	  if($_POST['kode']==''){
		  			$data = array( 
							'id' => $id, 
							'id_pegawai' => $_POST['pegawai'],
							'date' => date("Y-m-d",strtotime($_POST['tgl_mulai'])),
							'date_end' => date("Y-m-d",strtotime($_POST['tgl_akhir'])),
							'stampdate' => date("Y-m-h H:i:s"),
							'nominal' => str_replace(",","",$_POST['nominal']),
							'keterangan' => $_POST['ket'],
							'jenis' => $_POST['jenis'],
							'id_user' => $_SESSION['ID_LOGIN'],
					);
					$exec= $db->insert($tabel, $data);
			
		  echo "<script>window.location='index.php?x=operasional'</script>";
	  }else{
		  $data = array( 
			  			'id_pegawai' => $_POST['pegawai'],
						'date' => date("Y-m-d",strtotime($_POST['tgl_mulai'])),
						'date_end' => date("Y-m-d",strtotime($_POST['tgl_akhir'])),
						'stampdate' => date("Y-m-h H:i:s"),
						'nominal' => str_replace(",","",$_POST['nominal']),
						'keterangan' => $_POST['ket'],
						'jenis' => $_POST['jenis'],
						'id_user' => $_SESSION['ID_LOGIN'],
			 );
		  $exec= $db->update($tabel, $data, "id_operasional='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=operasional'</script>";
	  }
}
//==================================================sub dep====================================================

?>