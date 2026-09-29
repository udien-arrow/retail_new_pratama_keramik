<?php
$tabel = "tx_brg_masuk_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=brg_masuk_transit'</script>";		
	}else{
			$exp=explode("_",$_POST['id_stok']);
			$data = array( 
					'id_barang' => $_POST['id'], 
					'qty' => $_POST['qty_diberi2'],
					'qty_terima' => $_POST['qty_terima2'],
					'id_gudang' => $exp[1],
					'dari_gudang' => $exp[2],
					'sat' => $_POST['satuan2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'harga_beli' => $_POST['hpp2'],
					'jenis' => 4,
					'ppn' => 'n',
					'no_po' => $exp[0],
					'no_prp' => $exp[0],
					'qty_bonus' => '0',
					'claim_utuh' => '0',
					'claim_ktg' => '0',
					'id_valuta' => '1',
					'kurs' => '1',
					'id_prp' => '0',
					'id_po' => '0',
					'disc_global' => '0',
					'line' => '0',
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=brg_masuk_transit&id=$_POST[idlink]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty_terima'][$key]==''){
		}else{
		$exp=explode("_",$_POST['id_stok']);
		$data = array( 
					'id_barang' => $_POST['id_barang'][$key], 
					'qty' => $_POST['qty_diberi'][$key],
					'qty_terima' => $_POST['qty_terima'][$key],
					'id_gudang' => $exp[1],
					'sat' => $_POST['satuan'][$key],
					'id_user' => $_SESSION['ID_LOGIN'][$key],
					'harga_beli' => $_POST['hpp'][$key],
					'jenis' => 4,
					'ppn' => 'n',
					'no_po' => $exp[0],
					'no_prp' => $exp[0],
					'qty_bonus' => '0',
					'claim_utuh' => '0',
					'claim_ktg' => '0',
					'id_valuta' => '1',
					'kurs' => '1',
					'id_prp' => '0',
					'id_po' => '0',
					'disc_global' => '0',
					'line' => '0',
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=brg_masuk_transit&id=$_POST[idlink]'</script>";	
}

?>