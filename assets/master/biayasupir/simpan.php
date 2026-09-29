<?php
$tabel = "m_biayasupir";
	foreach($_POST['biaya'] as $key => $val){
	  if($val>0){	
		$kirim=$_POST['kirim'][$key];
		$spli=explode("_",$kirim);
		if($spli[2]==0){
			$data2 = array( 
					'id_cabang' => $spli[3],
					'id_barang' => $spli[0],
					'biaya' => $_POST['biaya'][$key],
					);
			$exec= $db->insert($tabel, $data2);
		}else{
			$data2 = array( 
					'id_cabang' => $spli[3],
					'id_barang' => $spli[0],
					'biaya' => $_POST['biaya'][$key],
					);
			$exec= $db->update($tabel, $data2,"id='$spli[2]'");
		}
	  }
	}
	echo "<script>window.location='index.php?x=biayasup&cabang=$_POST[cab]'</script>";	

if($_POST['kod']=='batal'){
	echo "<script>window.location='index.php?x=biayasup'</script>";

}
?>