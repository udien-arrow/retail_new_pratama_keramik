<?php
$tabel = "m_pricelist_jual_tmp";
if($_POST['tambah_in']=='ijen'){

	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=pricel_jual'</script>";		
	}else{
		//entry retail
		$explo=explode("_",$_POST['sat_in']);	
		$data = array( 
				'id_barang' => $_POST['id'], 
				'harga' => str_replace(',','',$_POST['harga_in']),
				'harga_cetak' => str_replace(',','',$_POST['harga_inc']),
				'sat' => $explo[0],
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_cabang' => $_POST['cab'],
				'jenis' => '1'
				);
		///var_dump($data);		
		//die();
		//entry grosir
		$exec= $db->insert($tabel, $data);
		$explo=explode("_",$_POST['sat_in']);	
		$data = array( 
				'id_barang' => $_POST['id'], 
				'harga' => str_replace(',','',$_POST['harga_in2']),
				'harga_cetak' => str_replace(',','',$_POST['harga_inc2']),
				'sat' => $explo[0],
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_cabang' => $_POST['cab'],
				'jenis' => '2'
				);
		///var_dump($data);		
		//die();
		$exec= $db->insert($tabel, $data);		
		echo "<script>window.location='index.php?x=pricel_jual&cab=$_POST[cab]&per=$_POST[persen]'</script>";
	}
}elseif($_POST['tambah_in']=='rame'){
	foreach($_POST['harga'] as $key => $val){
	  if($val>0){	
		$explo=explode("_",$_POST['sat'][$key]);	
		$data = array( 
				'id_barang' => $_POST['idbar'][$key], 
				'harga' => $val,
				'harga_cetak' => $_POST['harga_cetak'][$key],
				'sat' => $explo[0],
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_cabang' => $_POST['cab'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}
	echo "<script>window.location='index.php?x=pricel_jual&cab=$_POST[cab]&per=$_POST[persen]'</script>";	
}

?>