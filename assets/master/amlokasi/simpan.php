<?php
$tabel = "am_lokasi";
if($_POST[kode]==''){
		$max=$db->select("am_lokasi","max(ID_ALOKASI)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		$data = array( 'ID_ALOKASI' => $id, 
				'NAMA_ALOKASI' => $_POST['nama'],
				'CAB_ALOKASI' => $_POST['subjenis'],
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=asetlokasi'</script>";
}else{
	$data = array( 
				
				'NAMA_ALOKASI' => $_POST['nama'],
				'CAB_ALOKASI' => $_POST['subjenis'],
		 );
	$exec= $db->update($tabel, $data, "ID_ALOKASI='$_POST[kode]'");
	echo "<script>window.location='index.php?x=asetlokasi'</script>";
}


?>