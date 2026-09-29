	<?php
$tabel = "tx_koreksi_tmp";
$no_pi=explode("_",$_POST['idlink']);
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=korpiutang'</script>";		
	}else{
			$data = array( 
					'id_user' => $_SESSION['ID_LOGIN'],
					'ket' => $_POST['ket2'],
					'harga_awal' => str_replace(",","",$_POST['hargaasli22']),
					'harga_ganti' => str_replace(",","",$_POST['ganti22']),
					'jenis' => $_POST['jenis'],
					'no_piutang' => $no_pi[1]
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=korpiutang&id=$_POST[idlink]&jen=$_POST[jenis]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['ganti'] as $key => $val){
	  if($val>0){
			$data = array( 
					'harga_awal' => str_replace(",","",$_POST['hargaasli'][$key]),
					'harga_ganti' => str_replace(",","",$_POST['ganti'][$key]),
					'id_user' => $_SESSION['ID_LOGIN'],
					'jenis' => $_POST['jenis'],
					'ket' => $_POST['ket'][$key],
					'no_piutang' => $no_pi[1]
				);
		$exec= $db->insert($tabel, $data);
	  
	  }
	}
	echo "<script>window.location='index.php?x=korpiutang&id=$_POST[idlink]&jen=$_POST[jenis]'</script>";	
}

?>