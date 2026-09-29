<?php
//==================================================dep====================================================
	$tabel = "m_penjualan_jenis";
	  if($_POST['kode']==''){
		  $max=$db->select("m_penjualan_jenis","max(id_jenis_jual)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $data = array( 
		  				'id_jenis_jual' => $id, 
				 		'nama_jenis_jual' => $_POST['nama'],
						'keterangan' => $_POST['ket'],
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=jenis_jual'</script>";
	  }else{
		  $data = array( 
		  	'nama_jenis_jual' => $_POST['nama'],
			'keterangan' => $_POST['ket'], 
			 );
		  $exec= $db->update($tabel, $data, "id_jenis_jual='$_POST[kode]'");
		  echo "<script>window.location='index.php?x=jenis_jual'</script>";
	  }

//==================================================sub dep====================================================
?>