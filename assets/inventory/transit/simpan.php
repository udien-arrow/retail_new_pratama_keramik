<?php
$tabel = "tx_transit_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['qty'] as $key => $val){
			if($val!='' && $_POST['sat'][$key]!=''){
				echo $_POST['tes'][$key];
				$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'sat' => $_POST['sat'][$key],
						'qty' => $val,
						'id_user' => $_SESSION['ID_LOGIN'],
						'ke_gudang' => $_POST['gud'],
						//'jenis' => $_POST['jenis'],
						);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
	if($_POST['gud']=='0'){$gud='';}else{$gud=$_POST['gud'];}
		echo "<script>window.location='index.php?x=transit&gud=$gud'</script>";
}else{
	if($_POST['tambah_in']=='ijen'){
			
		$data = array( 
				'id_barang' => $_POST['id'], 
				'sat' => $_POST['sat_in'],
				'qty' => $_POST['qty_in'],
				'id_user' => $_SESSION['ID_LOGIN'],
				'ke_gudang' => $_POST['gud_in'],
				//'jenis' => $_POST['jenis'],
				);
		
		$exec= $db->insert($tabel, $data);
	}	
	echo "<script>window.location='index.php?x=transit&gud=$_POST[gud_in]'</script>";
	
}


?>