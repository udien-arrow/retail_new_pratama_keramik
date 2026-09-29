<?php
$tabel = "ak_jurnal_dtl_tmp";	
	if($_POST[kode]==''){
		  $max=$db->select($tabel,"max(IDX)as id");
		  foreach($max as $val){}
		  $id=$val['id']+1;
		  $jumlah = $_POST['jml'];
		  $new_jml = str_replace(',', '',$jumlah);
		  $pos = $_POST['posisi'];
		  $pos = $new_jml;
		 $data = array( 'IDX' => $id, 
				 		'ACC_CODE' => $_POST['kd_rekening'],
						'KET_DTL' => $_POST['ket'],
						'DEBET' => $pos,
						'TIPE' =>'BK'
				);
		  $exec= $db->insert($tabel, $data);
		  echo "<script>window.location='index.php?x=bankkeluar'</script>";
	  }
?>