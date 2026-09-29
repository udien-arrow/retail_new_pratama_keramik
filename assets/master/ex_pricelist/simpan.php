<?php
$tabel = "ex_tarif_oa";
$max=$db->select("ex_tarif_oa","max(id)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$tgl=explode("/",$_POST['tgl_berlaku']);
		$data = array( 'id' => $id, 
				'id_lokasi' => $_POST['tujuan'],
				'id_supp' => $_POST['cus'],
				'tarif_oa' => $_POST['tarifoa'],
				'gaji_sopir' => $_POST['gaji_sopir'],
				'gaji_kernet' => $_POST['gaji_kernet'],
				'ujs' => $_POST['ujs'],
				'km' => $_POST['km'],
				'kosongan' => $_POST['kosongan'],
				'premi' => $_POST['premi'],
				'status' => 0,
				'id_user' => $_SESSION['ID_LOGIN'],
				'tgl_berlaku' => $tgl[2].'-'.$tgl[0].'-'.$tgl[1],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=expricelist'</script>";

/**if($_POST[kode]==''){
}else{
	$data = array( 
				'id_lokasi' => $_POST['tujuan'],
				'id_supp' => $_POST['cus'],
				'tarif_oa' => $_POST['tarifoa'],
				'gaji_sopir' => $_POST['gaji_sopir'],
				'gaji_kernet' => $_POST['gaji_kernet'],
				'ujs' => $_POST['ujs'],
				'km' => $_POST['km'],
				'kosongan' => $_POST['kosongan'],
				'premi' => $_POST['premi'],
		 );
	$exec= $db->update($tabel, $data, "id='$_POST[kode]'");
	echo "<script>window.location='index.php?x=expricelist'</script>";
}**/


?>