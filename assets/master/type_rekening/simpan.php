<?php
$tabel = "ak_acc_type";
if($_POST[kode]==''){
		$max=$db->select("ak_acc_type","max(id_param)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id_param' => $id, 
				 'nama' => $_POST['nama'],
				 'id_group' => $_POST['group'],
				 'status' => $_POST['status'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=typerek'</script>";
}else{
	$data = array( 
				 'nama' => $_POST['nama'],
				 'id_group' => $_POST['group'],
				 'status' => $_POST['status'],
		 );
	$exec= $db->update($tabel, $data, "id_param='$_POST[kode]'");
	echo "<script>window.location='index.php?x=typerek'</script>";
}
?>