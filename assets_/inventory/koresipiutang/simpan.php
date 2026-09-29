	<?php
$tabel = "tx_koreksi_piutang_tmp";
$no_pi=explode("_",$_POST['idlink']);
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=korpi'</script>";		
	}else{
			foreach($db->select("tx_retur_pen_dtl a join tx_retur_pen b on a.no_retur=b.no_retur","qty_kembali","b.no_ref='".$no_pi[1]."' and id_barang='$_POST[id]'")as $vq);
			$qty=$_POST['qty2']-$vq['qty_kembali'];
			$data = array( 
					'id_barang' => $_POST['id'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => $_POST['ket'],
					'harga_awal' => $_POST['hargaasli2'],
					'harga_ganti' => $_POST['ganti2'],
					'qty' => $qty,
					'id_satuan' => $_POST['sat2'],
					'hpp' => $_POST['hpp2'],
					'jenis' => $_POST['jenis'],
					'no_piutang' => $no_pi[1]
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=korpi&id=$_POST[idlink]&jen=$_POST[jenis]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['ganti'][$key]==''){
		}else{
			$exp=explode("_",$_POST['id_stok']);
			foreach($db->select("tx_retur_pen_dtl a join tx_retur_pen b on a.no_retur=b.no_retur","qty_kembali","b.no_ref='".$exp[1]."' and id_barang='".$_POST[id_barang][$key]."'")as $vq);
			
			$qty=$_POST['qty'][$key]-$vq['qty_kembali'];
			$data = array( 
					'id_barang' => $_POST['id_barang'][$key],
					'harga_awal' => $_POST['hargaasli'][$key],
					'harga_ganti' => $_POST['ganti'][$key],
					'qty' => $qty,
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_satuan' => $_POST['satuan'][$key],
					'hpp' => $_POST['hpp'][$key],
					'jenis' => $_POST['jenis'],
					'ket' => $_POST['keterangan'][$key],
					'no_piutang' => $no_pi[1]
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=korpi&id=$_POST[idlink]&jen=$_POST[jenis]'</script>";	
}

?>