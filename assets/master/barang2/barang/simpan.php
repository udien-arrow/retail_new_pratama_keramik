<?php
$tabel = "m_barang";
if($_POST[kode]==''){
	
}else{
		$id=$db->idurut("m_barang_gudang","id_barang")	;
		$data = array( 
				'id_barang' => $id, 		
				'kode_barang' => $_POST['kode_barang'], 
				'nama_barang' => $_POST['nama'],
				'nama_barang_nick' => $_POST['nama_nick'],
				'id_dep' => $_POST['dep'],
				'id_sub' => $_POST['subdep'],
				'id_kat' => $_POST['kat'],
				'id_satuan' => $_POST['sat'],
				'tipe' => $_POST['tipe'],
				'berat' => $_POST['berat'],
				'bagi' => $_POST['bagi'],
				'kode_barang_semen' => $_POST['kode_barang_semen'],
				'status' => $_POST['inistatus'],
				'hpp' => 0,
				'stok' => 0,
				'total' => 0,
				'harga_beli2' => 0,
				);
		
		$exec= $db->insert($tabel, $data);
		foreach($_POST['id_gudang'] as $key => $val){
			if($val!=''){
				$expl=explode("_",$val);
				$cek=$db->select("m_barang_gudang","id_barang","id_barang='$_POST[kode]' and id_gudang='$expl[0]'");
				$jum=count($cek);
				if($jum==0){
					$id=$db->idurut("m_barang_gudang","id");
					//echo $id."-".$val."-".$_POST['kode']."<br>";
					$data = array( 
					'id' => $id, 
					'id_gudang' => $expl[0], 
					'id_cabang' => $expl[1], 
					'id_barang' => $_POST['kode'], 
					'kode_barang' => $_POST['kode_barang'], 
					'id_dep' => $_POST['dep'],
					'id_sub' => $_POST['subdep'],
					'id_kat' => $_POST['kat'],
					'tipe' => $_POST['tipe'],
					'nama_barang' => $_POST['nama'],
					'nama_barang_nick' => $_POST['nama_nick'],
					'berat' => $_POST['berat'],
					'id_satuan' => $_POST['sat'],
					'min' => $_POST['min'][$key],
					'max' => $_POST['max'][$key],
					'bagi' => $_POST['bagi'],
					'kode_barang_semen' => $_POST['kode_barang_semen'],
					'status' => $_POST['inistatus'],
					'hpp' => 0,
					'stok' => 0,
					'total' => 0,
					'harga_beli2' => 0,
					);
					$exec= $db->insert("m_barang_gudang", $data);
				}else{
					$data = array( 
					'nama_barang' => $_POST['nama'],
					'nama_barang_nick' => $_POST['nama_nick'],
					'min' => $_POST['min'][$key],
					'max' => $_POST['max'][$key],
					'id_dep' => $_POST['dep'],
					'id_sub' => $_POST['subdep'],
					'id_kat' => $_POST['kat'],
					'berat' => $_POST['berat'],
					'tipe' => $_POST['tipe'],
					'bagi' => $_POST['bagi'],
					'status' => $_POST['inistatus'],
					'kode_barang_semen' => $_POST['kode_barang_semen'],
					);
					
					$exec= $db->update("m_barang_gudang", $data,"id_cabang='$expl[1]' and id_gudang='$expl[0]' and id_barang='$_POST[kode]'");
				
				}

				
				
			}
		}
			
		echo "<script>window.location='index.php?x=barang'</script>";
}


?>