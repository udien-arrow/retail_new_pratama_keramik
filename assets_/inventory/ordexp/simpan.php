<?php
$tabel = "ex_order_tagihan_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['nobil'] as $key => $val){
				$exp=explode("_",$val);
				$data = array( 
					'id_supp' => $_POST['supp'], 
					'id_expediture' => $exp[0],
					'no_expediture' => $exp[2],
					'total_ao' => round($exp[1]),
					);
				$exec= $db->insert($tabel, $data);
		}
	}
		echo "<script>window.location='index.php?x=ordexp&supp=$_POST[supp]'</script>";	
}else{
	if($_POST['tambah_in']=='ijen'){		
			$exp=explode("_",$_POST[id]);
			$data = array( 
					'id_supp' => $_POST['supp'], 
					'id_expediture' => $exp[0],
					'no_expediture' => $exp[2],
					'total_ao' => round($exp[1]),
					);
			$exec= $db->insert($tabel, $data);
	}	
	echo "<script>window.location='index.php?x=ordexp&supp=$_POST[supp]'</script>";
	
}


?>