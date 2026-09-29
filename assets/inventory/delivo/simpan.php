<?php
$tabel = "tx_do_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['qty'] as $key => $val){
			if($val!=''){
				$asd=explode("_",$_POST['idlink']);
				$data = array( 
						'id_barang' => $_POST['brg'][$key], 
						'id_satuan' => $_POST['satuan'][$key],
						'qty' => $_POST['qty'][$key],
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_gudang' => $asd[1],
						'harga' => $_POST['harga'][$key],
						);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
	
		echo "<script>window.location='index.php?x=delivo&id=".$_POST['idlink']."'</script>";
				
}else{
	if($_POST['tambah_in']=='ijen'){		
			$asd=explode("_",$_POST['idlink']);
			$data = array( 
					'id_barang' => $_POST['id'], 
					'id_satuan' => $_POST['satuan2'],
					'qty' => $_POST['qty2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_gudang' => $asd[1],
					'harga' => $_POST['harga2'],
					);
			$exec= $db->insert($tabel, $data);
			
	}	
	echo "<script>window.location='index.php?x=delivo&id=".$_POST['idlink']."'</script>";
	
}


?>