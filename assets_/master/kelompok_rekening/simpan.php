<?php
$tabel = "ak_acc_group";
if($_POST[kode]==''){
		$max=$db->select("ak_acc_group","max(id_group)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_group' => $id, 
				 'nama' => $_POST['nama'],
				 'status' => $_POST['status'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=kelrek'</script>";
}else{
	$data = array( 
				 'nama' => $_POST['nama'],
				 'status' => $_POST['status'],
		 );
	$exec= $db->update($tabel, $data, "id_group='$_POST[kode]'");
	echo "<script>window.location='index.php?x=kelrek'</script>";
}
?>