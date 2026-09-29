<?php
$tabel = "ak_profit_center";
if($_POST[kode]==''){
		$max=$db->select("ak_profit_center","max(id)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'id' => $id, 
				 'kode_profit' => $_POST['deprof'],
				 'nama_profit' => $_POST['profit'],
				);
		
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=profitcenter'</script>";
}else{
	$data = array( 
				 'kode_profit' => $_POST['deprof'],
				 'nama_profit' => $_POST['profit'],
		 );
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=profitcenter'</script>";
}
?>