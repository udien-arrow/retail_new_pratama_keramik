<?php
$tabel = "tx_buku_bg";
if($_POST['kode']==''){
		$max=$db->select("tx_buku_bg","max(id_buku)as id");
		$idgen=$db->nourut('no_ta', 'tx_buku_bg', 'BG', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
		
		foreach($max as $val){}
		$id=$val['id']+1;

		$data = array( 
				'id_buku'=>$id,
				'no_ta' => $idgen,
				'tgl_bg' => date("Y-m-d",strtotime($_POST['tgl1'])),
				'nilai_bg' => str_replace(",","",$_POST['nominal']),
				'jatuh_tempo' => date("Y-m-d",strtotime($_POST['tgl2'])),
				'no_seribg' => $_POST['nobg'],
				'id_bank' => $_POST['bank'],
				'status' => $_POST['st'],
				'id_cus' => $_POST['cus'],
				'id_cabang' => $_SESSION['ID_CABANG'],
				'id_user'=>$_SESSION['ID_LOGIN'],
				'stampdate'=> date("Y-m-d"),
				
				);
		$exec= $db->insert($tabel, $data);

		//var_dump ($data);
		//exit;
		
	echo "<script>window.location='index.php?x=bukubg'</script>";
}else{
	$data = array( 
				'tgl_bg' => date("Y-m-d",$_POST['tgl1']),
				'jatuh_tempo' => date("Y-m-d",$_POST['tgl2']),
				'no_seribg' => $_POST['nobg'],
				'id_bank' => $_POST['bank'],
				'status' => $_POST['st'],
				'id_cus' => $_POST['cus'],
				'id_cabang' => $_SESSION['ID_CABANG'],
				'id_user'=>$_SESSION['ID_LOGIN'],
				'stampdate'=> date("Y-m-d"),
				
		 );
	$exec= $db->update($tabel, $data, "id_buku='$_POST[kode]'");
	
	echo "<script>window.location='index.php?x=bukubg'</script>";
}


?>

