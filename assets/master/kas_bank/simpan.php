<?php
$tabel = "ak_kasbank";
$acc=explode("-",$_POST['account']);
if($_POST[kode]==''){
		$max=$db->select("ak_kasbank","max(id_kb)as id");
		
		foreach($max as $val){}
		$id=$val['id']+1;

		$data = array( 
				'id_kb'=>$id,
				'account' => $acc[0],
				'description' => $_POST['desc'],
				'cabang' => $_POST['kode_cabang'],
				'kb'=>$_POST['type'],
				'id_user'=>$_SESSION['ID_LOGIN']
				
				);
		
		$exec= $db->insert($tabel, $data);
		
	echo "<script>window.location='index.php?x=kasbank'</script>";
}else{
	$data = array( 
				'account' => $acc[0],
				'description' => $_POST['desc'],
				'cabang' => $_POST['kode_cabang'],
				
		 );
	$exec= $db->update($tabel, $data, "id_kb='$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=kasbank'</script>";
}


?>

