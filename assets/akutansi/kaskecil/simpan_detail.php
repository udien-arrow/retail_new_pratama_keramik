<?php
$tabel = "kas_kecil_dtl";
if($_POST[kode]==''){
		$id=$db->idurut($tabel,"IDX");
		
		$data = array( 'IDX' => $id, 
				 'ID' => $_GET['id'],
				 'TANGGAL' => date("Y-m-d",strtotime($_POST['tgl'])),
				 'KET' => $_POST['penggunaan'],
				 'NOMINAL' => str_replace(',','',$_POST['jml']),
				 'ACCOUNT' => $_POST['account'],
				 'TANGGAL' => date("Y-m-d",strtotime($_POST['tgl'])),
				 'TANGGAL_ENTRY' => date("Y-m-d H:i:s"),

				);
		$exec= $db->insert($tabel, $data);
		
		
	echo "<script>window.location='index.php?x=kaskecil_d&id=$_GET[id]'</script>";
}else{
	echo "<script>window.location='index.php?x=kaskecil_d&id=$_GET[id]'</script>";
}


?>