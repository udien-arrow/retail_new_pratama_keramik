<?php
$tabel = "tx_jual_riject_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		$explo=explode("_",$_POST['cus2']);	
		foreach($_POST['qty'] as $key => $val){
			if($val!=''){
				$skr=date("Y-m-d");
				$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'id_satuan' => $_POST['sat'][$key],
						'qty' => $_POST['qty'][$key],
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_gudang' => $_POST['gud'],
						'harga' => str_replace(",","",$_POST['harga'][$key]),
						'jenis_jual' => $_POST['jen'],
						'id_cus' => $explo[0],
						);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
		echo "<script>window.location='index.php?x=jualriject&gud=".$_POST[gud]."&jen=".$_POST[jen]."&cus=".$_POST[cus2]."'</script>";		
}else{
	if($_POST['tambah_in']=='ijen'){	
			$explo=explode("_",$_POST['cus2']);
			$skr=date("Y-m-d");
			$data = array( 
					'id_barang' => $_POST['id'], 
					'id_satuan' => $_POST['sat_in'],
					'qty' => $_POST['qty_in'],
					'jenis_jual' => $_POST['jen'],
					'id_cus' => $explo[0],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_gudang' => $_POST['gud'],
					'harga' => str_replace(",","",$_POST['harga_in']),
					);
			$exec= $db->insert($tabel, $data);
			
	echo "<script>window.location='index.php?x=jualriject&gud=".$_POST[gud]."&jen=".$_POST[jen]."&cus=".$_POST[cus2]."'</script>";
	}
}


?>