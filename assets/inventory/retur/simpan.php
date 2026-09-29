	<?php
$tabel = "tx_retur_pem_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=retur'</script>";		
	}else{
			$exp=explode("_",$_POST['id_stok']);
			$data = array( 
					'id_barang' => $_POST['id'],
					'sat' => $_POST['satuan2'], 
					'qty_terima' => $_POST['qty_terima2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'hpp' => $_POST['hpp2'],
					'qty_kembali' => $_POST['qty_kembali2'],
					'ket' => $_POST['ket'],
					'id_gudang' => $_POST['id_gudang'],
					'harga_beli' => $_POST['hargabeli2'],
					'id_sup' => $_POST['sup2'],
					);				
			
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=retur&id=$_POST[idlink]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty_terima'][$key]==''){
		}else{
			$data = array( 
					'id_barang' => $_POST['id_barang'][$key],
					'sat' => $_POST['satuan'][$key], 
					'qty_terima' => $_POST['qty_terima'][$key],
					'id_user' => $_SESSION['ID_LOGIN'],
					'hpp' => $_POST['hpp'][$key],
					'qty_kembali' => $_POST['qty_kembali'][$key],
					'ket' => $_POST['keterangan'][$key],
					'id_gudang' => $_POST['gudangs'],
					'harga_beli' => $_POST['hargabeli'][$key],
					'id_sup' => $_POST['sup'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=retur&id=$_POST[idlink]'</script>";	
}

?>