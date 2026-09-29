<?php
$tabel = "m_plan";
if($_POST[kode]==''){
		$max=$db->select("m_plan","max(id_plan)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_plan' => $id, 
				 'nama_plan' => $_POST['nama'],
				 'kode' => $_POST['kode_plan'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=plan'</script>";
}else{
	$data = array( 'nama_plan' => $_POST['nama'], 
	'kode' => $_POST['kode_plan'],
		 );
	$exec= $db->update($tabel, $data, "id_plan='$_POST[kode]'");
	echo "<script>window.location='index.php?x=plan'</script>";
}


?>