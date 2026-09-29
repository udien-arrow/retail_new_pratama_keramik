<?php
	$dttmp=$db->select("hr_ijin_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	foreach($dttmp as $vals){
		$data = array( 
					'id_pegawai' => $vals['id_pegawai'],
					'date' => $vals['date'],
					'stampdate' => date("Y-m-d H:i:s"),
					'jenis' => $vals['jenis'],
					'ket' => $vals['ket'],
					'id_user' => $_SESSION['ID_LOGIN'],
					);
		$exec= $db->insert("hr_ijin", $data);
		//
		$where = array("id_tmp" => $vals['id_tmp']);
		$db->delete("hr_ijin_tmp",$where);
			
	}//end if jumlah
			
	echo "<script>window.location='index.php?x=ijin'</script>";
?>