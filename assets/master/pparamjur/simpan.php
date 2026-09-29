<?php
$tabel = "ak_parameterjur";
	$per=explode("-",$_POST[korek]);
	$cogs=$_POST[jenis];
	
	if(!empty($_POST['kode'])){
		$data = array( 
					'status' => '2' 
		 );
		$exec= $db->update($tabel, $data, "id_akunparam='$_POST[kode]'"); 
		
		} 
			$data = array( 'acc_code' => $per[0], 
					'status' => '1',
					'id_m_parameterjur' => $_POST[jenis] 
		 	);
			//echo"insert";
			$exec= $db->insert($tabel, $data); 
		
	echo "<script>window.location='index.php?x=pakun'</script>"; 



?>