<?php
$tabel = "m_grup";
if($_POST[kode]==''){
		$max=$db->select("m_grup","max(id_grup)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_grup' => $id, 
				 'jenis' => $_POST['nama'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=grup_inven'</script>";
}else{
	$data = array( 'jenis' => $_POST['nama'], 
		 );
	$exec= $db->update($tabel, $data, "id_grup='$_POST[kode]'");
	echo "<script>window.location='index.php?x=grup_inven'</script>";
}


?>