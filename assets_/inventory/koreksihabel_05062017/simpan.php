	<?php
$tabel = "tx_koreksi_habel_tmp";
$no_pi=explode("_",$_POST['idlink']);
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=korhabel'</script>";		
	}else{
			$qty=$_POST['qty2'];
			$sat=$_POST['satuan2'];
			$data = array( 
			
						
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => $_POST['ket2'],
					'qty' => $qty,
					'id_satuan' => $sat,
					'harga_awal' => str_replace(",","",$_POST['hargaasli22']),
					'harga_ganti' => str_replace(",","",$_POST['ganti22']),
					'id_barang' => $_POST['id']
					
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=korhabel&id=$_POST[idlink]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty'][$key]==''){
		}else{
			$qty=$_POST['qty2'];
			$sat=$_POST['satuan2'];
			$data = array( 
					'id_barang' => $_POST['id'][$key],
					'id_satuan' => $sat [$key], 
					'id_user' => $_SESSION['ID_LOGIN'],
					'qty' => $qty [$key],
					'ket' => $_POST['ket2'][$key],
					'harga_awal' => str_replace(",","",$_POST['hargaasli22'] [$key]),
					'harga_ganti' => str_replace(",","",$_POST['ganti22'] [$key]),
					
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=korhabel&id=$_POST[idlink]'</script>";	
}

?>