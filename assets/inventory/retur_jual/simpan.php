	<?php
$tabel = "tx_retur_pen_tmp";
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
					'id_gudang' => $exp[2],
					'harga_jual' => $_POST['hargajual2'],
					'id_cus' => $_POST['cus2'],
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=returpen&id=$_POST[idlink]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty_kembali'][$key]==''){
		}else{
			$exp=explode("_",$_POST['id_stok']);
			$data = array( 
					'id_barang' => $_POST['id_barang'][$key],
					'sat' => $_POST['satuan'][$key], 
					'qty_terima' => $_POST['qty_terima'][$key],
					'id_user' => $_SESSION['ID_LOGIN'],
					'hpp' => $_POST['hpp'][$key],
					'qty_kembali' => $_POST['qty_kembali'][$key],
					'ket' => $_POST['keterangan'][$key],
					'id_gudang' => $exp[2],
					'harga_jual' => $_POST['hargajual'][$key],
					'id_cus' => $_POST['cus'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=returpen&id=$_POST[idlink]'</script>";	
}

?>