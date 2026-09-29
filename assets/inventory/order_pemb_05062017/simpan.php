<?php
$tabel = "tx_order_tagihan_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['nobil'] as $key => $val){
			$ce=$db->select("tx_billing_dtl","*","no_billing='".$val."'");
			foreach($ce as $cek){}	
				$data = array( 
					'id_supp' => $_POST['supp'], 
					'id_billing' => $_POST['idbil'][$key],
					'no_billing' => $val,
					'total_bil' => $_POST['totalbil'][$key],
					'no_spj' => $cek['no_spj'],
					'id_user' => $_SESSION['ID_LOGIN'],
					);
				$exec= $db->insert($tabel, $data);
			
		}
	}
		echo "<script>window.location='index.php?x=order-pemb&supp=$_POST[supp]'</script>";	
}else{
	if($_POST['tambah_in']=='ijen'){
		$ce=$db->select("tx_billing_dtl","*","no_billing='$_POST[nobil_in]'");
		foreach($ce as $cek){}		
			$data = array( 
					'id_supp' => $_POST['supp'], 
					'id_billing' => $_POST['idbil_in'],
					'no_billing' => $_POST['nobil_in'],
					'total_bil' => $_POST['totalbil_in'],
					'no_spj' => $cek['no_spj'],
					'id_user' => $_SESSION['ID_LOGIN'],
					);
			$exec= $db->insert($tabel, $data);
			//var_dump($data);
	}	

	echo "<script>window.location='index.php?x=order-pemb&supp=$_POST[supp]'</script>";
	
}

?>