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
					'nopol' => $_POST['nopol2'],
					'sn' => $_POST['sn2'],
					'jenis' => $_POST['tipe2'],
					'id_gudang' => $_SESSION['ID_GUDANG'],
					);
			$cek=$db->select("m_barang_gudang","*","id_gudang='$_SESSION[ID_GUDANG]' and id_barang='$_POST[id]'");
			foreach($cek as $ceks){}
			if($_POST['qty_beri2']>$ceks['stok']){
				echo "<script>alert('Maaf Stok Tidak Mencukupi')</script>";
				echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]&jenis=$_POST[jenis_s]'</script>";
			}else
			if($_POST['qty_beri2']>$_POST['qty_minta2']){
			echo "<script>alert('Maaf Melebihi Permintaan')</script>";
			echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]&jenis=$_POST[jenis_s]'</script>";
			}else{
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";}
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
				'nopol' => $_POST['nopol'][$key],
				'sn' => $_POST['sn'][$key],
				'ke_gudang' => $_POST['id_gud'],
				'sat' => $_POST['satuan'][$key],
				'id_user' => $_SESSION['ID_LOGIN'],
				'hpp' => $_POST['hpp'][$key],
				'id_gudang' => $_SESSION['ID_GUDANG'],
				'jenis' => $_POST['tipe'],
				);
		$cek=$db->select("m_barang_gudang","*","id_gudang='$_SESSION[ID_GUDANG]' and id_barang='".$_POST['id_barang'][$key]."'");
		foreach($cek as $ceks){}
		if($_POST['qty_beri'][$key]>$ceks['stok']){
				echo "<script>alert('Maaf Stok Tidak Mencukupi')</script>";
				echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]&jenis=$_POST[jenis_s]'</script>";
			}else
		if($_POST['qty_beri'][$key]>$_POST['qty_minta'][$key])
		{
			echo "<script>alert('Maaf Melebihi Permintaan')</script>";
			echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";
			}else{
		$exec= $db->insert($tabel, $data);
			}
	  }
	}}
	echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";
}

?>