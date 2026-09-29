<?php
$tabel = "tx_brg_keluar_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=bgrkeluar'</script>";		
	}else{
			$selisih=$_POST['stok_fisik2']-$_POST['stok_sys2'];
			$data = array( 
					'id_barang' => $_POST['id'], 
					'qty_minta' => $_POST['qty_minta2'],
					'qty_beri' => $_POST['qty_beri2'],
					'ke_gudang' => $_POST['gudang2'],
					'sat' => $_POST['satuan2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'hpp' => $_POST['hpp2'],
					);
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty_beri'][$key]==''){
		
		}else{
		$data = array( 
				'id_barang' => $_POST['id_barang'][$key], 
				'qty_minta' => $_POST['qty_minta'][$key],
				'qty_beri' => $_POST['qty_beri'][$key],
				'ke_gudang' => $_POST['id_gud'],
				'sat' => $_POST['satuan'][$key],
				'id_user' => $_SESSION['ID_LOGIN'],
				'hpp' => $_POST['hpp'][$key],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]'</script>";	
}

?>