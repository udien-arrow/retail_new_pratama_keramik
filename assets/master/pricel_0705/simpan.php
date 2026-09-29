<?php
$tabel = "m_pricelist_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=pricel'</script>";		
	}else{
		
			$data = array( 
					'id_barang' => $_POST['id'], 
					'harga' => str_replace(",","",$_POST['harga_in']),
					'sat' => $_POST['sat_in'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_supp' => $_POST['supp'],
					);
			$exec= $db->insert($tabel, $data);
			//var_dump($data);
			//die();
			echo "<script>window.location='index.php?x=pricel&supp=$_POST[supp]'</script>";
	}
}elseif($_POST['tambah_in']=='rame'){
	foreach($_POST['harga'] as $key => $val){
	  if($val>0){	
		$data = array( 
				'id_barang' => $_POST['idbar'][$key], 
				'harga' => str_replace(",","",$val),
				'sat' => $_POST['sat'][$key], 
				'id_user' => $_SESSION['ID_LOGIN'],
				'id_supp' => $_POST['supp'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}
	echo "<script>window.location='index.php?x=pricel&supp=$_POST[supp]'</script>";	
}

?>