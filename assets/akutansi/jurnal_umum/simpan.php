<?php
$tabel = "ak_jurnal_dtl_tmp";

if($_POST[kode]==''){
		
		$max=$db->select("ak_jurnal_dtl_tmp","max(IDX)as id");
		foreach($max as $val)
		$id=$val['id']+1;
		$jumlah = $_POST['jml'];
	    $new_jml = str_replace(',', '',$jumlah);
		 $pos = $new_jml;
	if  ($_POST['status'] == "debet"){
		$_POST['debet'] =  $new_jml;
		$_POST['kredit'] = 0;
		}
		 elseif ($_POST['status'] == "kredit"){
		$_POST['debet'] = 0;
		$_POST['kredit'] =  $new_jml;
		}
		
		$data = array( 'IDX' => $_POST['id'],
					   'ACC_CODE' => $_POST['norek'],
					   'DEBET' => $_POST['debet'],
					   'KREDIT' => $_POST['kredit'],
					   'KET_DTL' => $_POST['ket'],
					   'TIPE' => "JU",);
		
					 
		$exec= $db->insert($tabel, $data);	
	echo "<script>window.location='index.php?x=jurum'</script>";
}
else {
	
}
	
?>