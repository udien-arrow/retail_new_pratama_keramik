<?php
$tgl=date("Y-m-d H:i:s");
$tabel = "am_katagori";
if($_POST[kode]==''){
		$max=$db->select("am_katagori","max(ID_AKATAGORI)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'ID_AKATAGORI' => $id, 
				'NAMA_AKATAGORI' => $_POST['nama'],
				'STATUS_AKATAGORI' => '1',
				'TGL_INPUTAKAT' => $tgl,
				'USERID_AKAT' => $_SESSION['ID_LOGIN'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=asetkategori'</script>";
}else{
	$data = array( 
				
				'NAMA_AKATAGORI' => $_POST['nama'],
				'STATUS_AKATAGORI' => '1',
				'TGL_INPUTAKAT' => $tgl,
				'USERID_AKAT' => $_SESSION['ID_LOGIN'],
		 );
	$exec= $db->update($tabel, $data, "ID_AKATAGORI='$_POST[kode]'");
	echo "<script>window.location='index.php?x=asetkategori'</script>";
}


?>