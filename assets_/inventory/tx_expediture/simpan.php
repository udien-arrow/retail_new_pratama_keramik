<?php
$tabel = "ex_expediture_tmp";
if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty_do'][$key]==''){
		}else{
			$s=explode("_",$_POST['id_stok']);
			$data = array( 
					'id_barang' => $_POST['id_barang'][$key],
					'id_satuan' => $_POST['id_sat'][$key], 
					'qty_do' => $_POST['qty_do'][$key],
					'berat' => $_POST['berat'][$key],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_supp' => $s[1],
					'no_so' => $_POST['so'],
					'id_tarifoa' => $_POST['tujuan'],
					'id_gudang' => $_POST['id_gud'][$key],
					'id_kendaraan' => $_POST['nopol'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=txex&id=$_POST[idlink]&so=$_POST[so]'</script>";	
}

?>