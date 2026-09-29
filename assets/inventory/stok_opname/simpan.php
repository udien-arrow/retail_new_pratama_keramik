<?php
$tabel = "tx_stok_opname_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=so'</script>";		
	}else{
			$selisih=$_POST['stok_fisik2']-$_POST['stok_sys2'];
			$data = array( 
					'id_barang' => $_POST['id'], 
					'stok_sys' => $_POST['stok_sys2'],
					'stok_fisik' => $_POST['stok_fisik2'],
					'selisih' => $selisih,
					'keterangan' => $_POST['keterangan2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_gudang' => $_POST['gudang2'],
					'hpp' => $_POST['hpp2'],
					);
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=so&gudang=$_POST[gudang2]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['stokfisik'][$key]==''){
		
		}else{
	 	$selisih=$_POST['stokfisik'][$key]-$_POST['stok_sys'][$key];
		$data = array( 
				'id_barang' => $_POST['id_barang'][$key], 
				'stok_sys' => $_POST['stok_sys'][$key],
				'stok_fisik' => $_POST['stokfisik'][$key],
				'selisih' => $selisih,
				'keterangan' => $_POST['keterangan'][$key],
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_gudang' => $_POST['gudang2'],
				'hpp' => $_POST['hpp'][$key],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=so&gudang=$_POST[gudang2]'</script>";	
}

?>