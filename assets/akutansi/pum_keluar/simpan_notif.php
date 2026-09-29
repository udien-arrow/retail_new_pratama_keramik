<?php
$tabel = "tx_prp_notif";
if($_POST[id]==''){
		if($_POST['aksi']=='rame'){
		foreach($_POST['idbar'] as $key => $val){
			if($val!=''){
				$data = array( 
				'no_notif' => '', 
				'id_barang' => $val, 
				'id_user' => $_SESSION['ID_LOGIN'], 
				'id_gudang' => $_POST['gud'],
				'status' => 0
				);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
	echo "<script>window.location='index.php?x=prp_notif&gud=$_POST[gud]'</script>";
				
}else{
	if($_POST['aksi']=='ijen'){		
		$data = array( 
				'no_notif' => '', 
				'id_barang' => $_POST['id'], 
				'id_user' => $_SESSION['ID_LOGIN'], 
				'id_gudang' => $_POST['gud'],
				'status' => 0
				);
		$exec= $db->insert($tabel, $data);
	}	
	echo "<script>window.location='index.php?x=prp_notif&gud=$_POST[gud]'</script>";
	
}


?>