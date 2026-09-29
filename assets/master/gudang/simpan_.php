<?php

if($_POST[jenis]=='tambah'){
	$tabel = "m_gudang";
	if($_POST[kode]==''){
			$id=$db->idurut($tabel,"id_gudang");
			$data = array( 
					 'id_gudang' => $id, 
					 'nama_gudang' => $_POST['nama'],
					 'status' => 1,
					 'alamat' => $_POST['alamat'],
					 'telp' => $_POST['telp'],
					 'fax' => $_POST['fax'],
					 'email' => $_POST['email'],
					 'id_cabang' => $_POST['cabang'],
					 'id_wilayah' => $_POST['wilayah'],
					 'kode_shipto1' => $_POST['kode_shipto1'],
					 'kode_shipto2' => $_POST['kode_shipto2'],
					 'kode_shipto3' => $_POST['kode_shipto3'],
					 'nama_shipto' => $_POST['nama_shipto'],
					);
			
			$exec= $db->insert($tabel, $data);
			//var_dump($data);
			//die();
		echo "<script>window.location='index.php?x=gudang'</script>";
	}else{
		$data = array( 
					 'nama_gudang' => $_POST['nama'],
					 'alamat' => $_POST['alamat'],
					 'telp' => $_POST['telp'],
					 'fax' => $_POST['fax'],
					 'email' => $_POST['email'],
					 'id_cabang' => $_POST['cabang'],
					 'id_wilayah' => $_POST['wilayah'],
					 'kode_shipto1' => $_POST['kode_shipto1'],
					 'kode_shipto2' => $_POST['kode_shipto2'],
					 'kode_shipto3' => $_POST['kode_shipto3'],
					 'nama_shipto' => $_POST['nama_shipto'],
			 );
		$exec= $db->update($tabel, $data, "id_gudang='$_POST[kode]'");
		echo "<script>window.location='index.php?x=gudang'</script>";
	}
}
if($_POST[jenis]=='tambah_bar'){
	
	   $bar=$db->select("m_barang","*","id_barang='$_POST[id_barang]'");
	   foreach($bar as $barval){}
	   $id=$db->idurut("m_barang_gudang","id");
	   $data = array( 
					'id' => $id,
					'id_gudang' => $_POST['id_gudang'],
					'id_cabang' => $_POST['cabang'],
					'id_barang' => $barval['id_barang'],
					'kode_barang' => $barval['kode_barang'],
					'nama_barang' => $barval['nama_barang'],
					'id_satuan' => $barval['id_satuan'],
					'status' => 1,
					'min' => $_POST['min_in'],
					'max' => $_POST['max_in'],
					'kode_barang_semen' => $barval['kode_barang_semen'],
					'bagi' => $barval['bagi'],
					'id_dep' => $barval['id_dep'],
					'id_sub' => $barval['id_sub'],
					'id_kat' => $barval['id_kat'],
					'tipe' => $barval['tipe'],
					'id_grup' => $barval['id_grup'],
					'harga_beli2' => 0,
					'stok' => 0,
					'hpp' => 0,
					'total' => 0,


			 );
		$exec= $db->insert("m_barang_gudang", $data);
		echo "<script>window.location='index.php?x=gudang&id=".$_POST[id_gudang]."&in=tambah'</script>";
	
}
if($_POST[jenis]=='rame'){
	
	foreach($_POST[idbar] as $key => $value){
	   $bar=$db->select("m_barang","*","id_barang='$value'");
	   foreach($bar as $barval){}
	   $id=$db->idurut("m_barang_gudang","id");
	   $data = array( 
					'id' => $id,
					'id_gudang' => $_POST['id_gudang'],
					'id_cabang' => $_POST['cabang'],
					'id_barang' => $barval['id_barang'],
					'kode_barang' => $barval['kode_barang'],
					'nama_barang' => $barval['nama_barang'],
					'id_satuan' => $barval['id_satuan'],
					'kode_barang_semen' => $barval['kode_barang_semen'],
					'id_dep' => $barval['id_dep'],
					'id_sub' => $barval['id_sub'],
					'id_kat' => $barval['id_kat'],
					'tipe' => $barval['tipe'],
					'id_grup' => $barval['id_grup'],
					'bagi' => $barval['bagi'],
					'status' => 1,
					'min' => $_POST['min'][$key],
					'max' => $_POST['max'][$key],
					'harga_beli2' => 0,
					'stok' => 0,
					'hpp' => 0,
					'total' => 0,


			 );
		$exec= $db->insert("m_barang_gudang", $data);
	}
		echo "<script>window.location='index.php?x=gudang&id=".$_POST[id_gudang]."&in=tambah'</script>";
	
}
if($_POST[jenis]=='hapus_bar'){
	$data = array("status" => 0);
	$db->update("m_barang_gudang",$data,"id_gudang='$_POST[id_gudang]' and id_barang='$_POST[id]'");
	echo "<script>window.location='index.php?x=gudang&id=".$_POST[id_gudang]."'</script>";
}


?>