<?php
$tabel = "tx_brg_masuk_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['qty'] as $key => $val){
			if($val!=''){
				/*$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'sat' => $_POST['sat'][$key],
						'qty' => $val,
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_gudang' => $_SESSION['ID_GUDANG'],
						'harga' => $_POST['harga'][$key],
						);
				$exec= $db->insert($tabel, $data);*/
				$explo=explode("_",$_POST['supp']);
				
				
				$data = array( 	
						'no_po' => 'NONPO', 	
						'id_supp' => $explo[0], 	
						'id_barang' => $_POST['idbar'][$key],
						'qty' => $_POST['qty'][$key],
						'qty_terima' => $_POST['qty'][$key], 
						'qty_bonus' => 0, 
						'harga_beli' => $_POST['harga'][$key], 
						'ppn' => 'y', 
						'id_user' => $_SESSION['ID_LOGIN'], 
						'sat' => $_POST['sat'][$key], 
						'jenis' => 8,
						'id_gudang' => $_SESSION['ID_GUDANG'],  
						'disc_global' => 0,  
						'id_valuta' => 1,  
						'kurs' => 1,  
						'berat' => 0,  
						'line' => 0,  
						);
				$exec= $db->insert($tabel, $data);
				
			}
		}
	}
	
		// echo "<script>window.location='index.php?x=brgmasuk2&id=$_POST[supp]'</script>";
				
}else{
	if($_POST['tambah_in']=='ijen'){		
			$data = array( 
					'id_barang' => $_POST['id'], 
					'sat' => $_POST['sat_in'],
					'qty' => $_POST['qty_in'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_gudang' => $_SESSION['ID_GUDANG'],
					'harga' => str_replace(",","",$_POST['harga_in']),
					);
			$exec= $db->insert($tabel, $data);
	}	
	echo "<script>window.location='index.php?x=brgmasuk2'</script>";
	
}


?>