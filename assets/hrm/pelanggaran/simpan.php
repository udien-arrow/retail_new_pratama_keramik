<?php
//==================================================dep====================================================
if($_POST['slug']==''){
	$tabel = "hr_pelanggaran";
	  if($_POST['kode']==''){
		  $max=$db->select("hr_pelanggaran","max(id_pelanggaran)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  
		  if($_POST['pelanggaran']==1){
		  	$tglakhir=date('Y-m-d', strtotime('+3 month', strtotime( $_POST['tgl'])));
			$pot="5";
		  }if($_POST['pelanggaran']==2){
		  	$tglakhir=date('Y-m-d', strtotime('+6 month', strtotime( $_POST['tgl'])));
			$pot="15";
		  }if($_POST['pelanggaran']==3){
		  	$tglakhir=date('Y-m-d', strtotime('+12 month', strtotime( $_POST['tgl'])));
			$pot="25";
		  }if($_POST['pelanggaran']==4){
		  	$tglakhir=date('Y-m-d', strtotime('+18 month', strtotime( $_POST['tgl'])));
			$pot="50";
		  }if($_POST['pelanggaran']==5){
		  	$tglakhir=date('Y-m-d', strtotime('+2 month', strtotime( $_POST['tgl'])));
		  }
		  
		  $data = array( 
		  				'id_pelanggaran' => $id, 
				 		'id_pegawai' => $_POST['pegawai'],
						'jenis_pelanggaran' => $_POST['pelanggaran'],
						'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
						'tgl_sk' => date("Y-m-d",strtotime($_POST['tgl_sk'])),
						'tgl_akhir' => $tglakhir,
						'potongan' => $pot,
						'stampdate' => date("Y-m-h H:i:s"),
						'sk_pelanggaran' => $_POST['skpel'],
						'ket_pelanggaran' => $_POST['ket'],
				);	
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=pelanggaran'</script>";
	  }else{
		  if($_POST['pelanggaran']==1){
		  	$tglakhir=date('Y-m-d', strtotime('+3 month', strtotime( $_POST['tgl'])));
			$pot="5";
		  }if($_POST['pelanggaran']==2){
		  	$tglakhir=date('Y-m-d', strtotime('+6 month', strtotime( $_POST['tgl'])));
			$pot="15";
		  }if($_POST['pelanggaran']==3){
		  	$tglakhir=date('Y-m-d', strtotime('+12 month', strtotime( $_POST['tgl'])));
			$pot="25";
		  }if($_POST['pelanggaran']==4){
		  	$tglakhir=date('Y-m-d', strtotime('+18 month', strtotime( $_POST['tgl'])));
			$pot="50";
		  }

		  $data = array( 
			  			'id_pegawai' => $_POST['pegawai'],
						'jenis_pelanggaran' => $_POST['pelanggaran'],
						'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
						'tgl_akhir' => $tglakhir,
						'potongan' => $pot,
						'stampdate' => date("Y-m-h H:i:s"),
						'sk_pelanggaran' => $_POST['skpel'],
						'ket_pelanggaran' => $_POST['ket'],
			 );
		  $exec= $db->update($tabel, $data, "id_pelanggaran='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=pelanggaran'</script>";
	  }
}
//==================================================sub dep====================================================
if($_POST['slug']==1){
	$tabel = "hr_m_pelanggaran";
	  if($_POST['kode']==''){
		  $max=$db->select("hr_m_pelanggaran","max(id_jenispel)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  		 'id_jenispel' => $id, 
				 'nama_jenispel' => $_POST['nama'], 
				 'ket' => $_POST['ket'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=pelanggaran&slug=$_POST[slug]'</script>";
	  }else{
		   $data = array( 
		  		 'nama_jenispel' => $_POST['nama'], 
				 'ket' => $_POST['ket'],
			 );
		   $exec= $db->update($tabel, $data, "id_jenispel='$_POST[kode]'");
		   //die();
		   echo "<script>window.location='index.php?x=pelanggaran&slug=$_POST[slug]'</script>";
	  }
		
}

?>