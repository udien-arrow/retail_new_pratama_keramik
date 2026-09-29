<?php
$tabel = "tx_usage_tmp";
$gudang = $_SESSION['ID_GUDANG'];
$hariini = date("Y-m-d");
$terpakai = ($_POST['qty_masukku']-$_POST['sisaku'])-$_POST['wasteku'];

if($_POST['tambah_in']=='ijen'){	
	if($_POST[id_usage]==''){
		/*echo "<script>window.location='index.php?x=pgnbrng'</script>";		
		}else{*/
			//$sisa=$_POST['stok_fisik2']-$_POST['stok_sys2'];

			$data = array( 
					//'no_usage' => $_POST[''], 
					'id_gudang' => $gudang,
					'id_barang' => $_POST['id_barangku'],
					'id_satuan' => $_POST['id_satuanku'],
					'tgl_input' => $hariini,
					'qty_masuk' => $_POST['qty_masukku'],
					'qty_sisa' => $_POST['sisaku'],					
					'qty_waste' => $_POST['wasteku'],
					'qty_keluar' => $terpakai,
					'status' => 1,
					'hpp' => $_POST['hppku'],
					);
					//var_dump($data);
			/*$cek=$db->select("m_barang_gudang","*","id_gudang='$_SESSION[ID_GUDANG]' and id_barang='$_POST[id]'");
			foreach($cek as $ceks){}
			if($_POST['qty_beri2']>$ceks['stok']){
				echo "<script>alert('Maaf Stok Tidak Mencukupi')</script>";
				echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]'</script>";
			}else
			if($_POST['qty_beri2']>$_POST['qty_minta2']){
			echo "<script>alert('Maaf Melebihi Persediaan Barang')</script>";
			echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]'</script>";*/
			if($_POST['sisa2']>$_POST['qty_masuk2']){
				/* echo "<script>alert('Maaf Melebihi Persediaan Barang')</script>"; */
				/*echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";*/
				/* echo "<script>window.location='index.php?x=pgnbrng'</script>"; */
			}else{
				
				$exec= $db->insert($tabel, $data);				
				echo "<script>window.location='index.php?x=pgnbrng&a=$_POST[tglku]'</script>"; 
			}
			/*echo "<script>window.location='index.php?x=pgnbrng&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";}*/
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
//		echo "disini ".$_POST['id_barang'][$key]." - key $key";
	  if($val>0){
		if($_POST['qty_masuk'][$key]==''){
		}else{
		$terpakai2 = ($_POST['qty_masuk'][$key]-$_POST['sisa'][$key])-$_POST['waste'][$key];
		$data = array( 
					//'no_usage' => $_POST[''], 
					'id_gudang' => $gudang,
					'id_barang' => $_POST['id_barang'][$key],
					'id_satuan' => $_POST['id_satuan'][$key],
					'tgl_input' => $hariini,
					'qty_masuk' => $_POST['qty_masuk'][$key],
					'qty_sisa' => $_POST['sisa'][$key],					
					'qty_waste' => $_POST['waste'][$key],
					'qty_keluar' => $terpakai2,
					'status' => 1,
					'hpp' => $_POST['hpp'][$key],
					
					);
		/*$cek=$db->select("m_barang_gudang","*","id_gudang='$_SESSION[ID_GUDANG]' and id_barang='".$_POST['id_barang'][$key]."'");
		foreach($cek as $ceks){}
		if($_POST['qty_masuk'][$key]>$ceks['stok']){
				echo "<script>alert('Maaf Stok Tidak Mencukupi')</script>";
				echo "<script>window.location='index.php?x=brgkeluar&id=$_POST[idlink]'</script>";
                echo "<script>window.location='index.php?x=pgnbrng'</script>";
			}else*/
		if($_POST['sisa'][$key]>$_POST['qty_masuk'][$key])
		{
			echo "<script>alert('Maaf Melebihi Persediaan Barang')</script>";
			/*echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";*/
			echo "<script>window.location='index.php?x=pgnbrng'</script>";
			}else{
		$exec= $db->insert($tabel, $data);
			}
	  }
	}}
	/*echo "<script>window.location='index.php?x=brgkeluar&jenis=$_POST[jenis_s]&id=$_POST[idlink]'</script>";*/
	echo "<script>window.location='index.php?x=pgnbrng'</script>";
}

?>