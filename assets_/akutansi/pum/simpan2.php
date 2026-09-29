<?php

if($_POST['aksi']=='hapus'){
	$where = array("ID" => $_POST['id']);
	$db->delete("ak_pum_tmp",$where);
	echo "<script>window.location='index.php?x=pum'</script>";
	}
else{
	$tabelkas="ak_pum";
	$idj=$db->nourut('NO_PUM', 'ak_pum', 'UM', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	$max=$db->select($tabel,"max(IDX)as id");
	$dttime=date("Y-m-d H:i:s");
	$tot=$_POST['tot'];
	$tgl=date("Y-m-d H:i:s");
	$datakas = array(  
					   'NO_PUM' => $idj,
					   'TANGGAL' => $tgl,
					   'CATATAN' => $_POST['cat'],
					   'TOTAL' => $tot,
					   'CABANG' => $_SESSION ['ID_CABANG'],
					   'TIPE' => $_POST['jum'],
					   'USERID' => $_SESSION['ID_LOGIN']
					  );
	$execjur= $db->insert($tabelkas, $datakas);

	foreach($db->select("ak_pum_tmp","*","USER=$_SESSION[ID_LOGIN]") as $km){
		$tabelkm="ak_pum_dtl";
		$datakm = array(  'KEPERLUAN' => $km['KEPERLUAN'],
						  'NO_PUM' => $idj,  
						  'JUMLAH' => $km['JUMLAH'],
						  'STATUS' => "1"
						  );
						
		$execjur= $db->insert($tabelkm, $datakm);
	   
		$tabel="ak_pum_tmp";
		$where = array("ID" => $km['ID']); 
		$exec= $db->delete($tabel, $where);

	}

	echo "<script>window.location='index.php?x=pum'</script>"; 
}

?>