<?php
$tabel = "tx_bm_order_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['qty'] as $key => $val){
			if($val!=''){
				$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'sat' => $_POST['sat'][$key],
						'qty' => $val,
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_gudang' => $_SESSION['ID_GUDANG'],
						);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
	
		echo "<script>window.location='index.php?x=order_bm'</script>";
				
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
	echo "<script>window.location='index.php?x=order_bm'</script>";
	
}


?>