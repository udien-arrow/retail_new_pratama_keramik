<?php
$tabel = "ex_customer";
if($_POST[kode]==''){
		$max=$db->select("ex_customer","max(id_ex)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$limit=$_POST['pkb']+$_POST['pkc'];
		$tempo=$_POST['tempo_n']+$_POST['tempo_t'];
		$data = array( 'id_ex' => $id, 
				'id_supp' => $_POST['id_cus'],
				'limit_pkb' => $_POST['pkb'],
				'limit_pkc' => $_POST['pkc'],
				'limit_plafon' => $limit,
				'tempo_normal' => $_POST['tempo_n'],
				'tempo_tambahan' => $_POST['tempo_t'],
				'tempo_pembayaran' => $tempo,
				'keterangan' => $_POST['keterangan'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=expelanggan'</script>";
}else{
	$limit=$_POST['pkb']+$_POST['pkc'];
	$tempo=$_POST['tempo_n']+$_POST['tempo_t'];
	$data = array( 
				'id_supp' => $_POST['id_cus'],
				'limit_pkb' => $_POST['pkb'],
				'limit_pkc' => $_POST['pkc'],
				'limit_plafon' => $limit,
				'tempo_normal' => $_POST['tempo_n'],
				'tempo_tambahan' => $_POST['tempo_t'],
				'tempo_pembayaran' => $tempo,
				'keterangan' => $_POST['keterangan'],
		 );
	$exec= $db->update($tabel, $data, "id_ex='$_POST[kode]'");
	echo "<script>window.location='index.php?x=expelanggan'</script>";
}


?>