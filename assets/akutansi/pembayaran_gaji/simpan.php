	<?php

$idkm=$db->nourut('IDKM', 'ak_jurnal', 'BK', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
$akak=0;
foreach ($_POST['app'] as $key => $value) {
	$asd=explode("_",$value);
	if($value!=""){
		if($_POST['jenis']==1){
			include("simpan_gaji.php");
		}
		if($_POST['jenis']==2){
			include("simpan_bonus.php");
		}
		if($_POST['jenis']==3){
			include("simpan_gaji_har.php");	
		}
		 //end jen
		 $akak++;
	}	//end if
	
}//end fo
if($akak>0){
//kas keluar
		$data_dtl_kk = array('IDKK' => $idkm,
							'TGL' => $tgl,
							'TGL_TRAN' => date("Y-m-d", strtotime($_POST['tgl_trans'])),
							'JUMLAH' => $titil,
							'URAIAN' => "Pembayaran Gaji",
							'id_cabang' => $_SESSION['ID_CABANG'],
							'type' => $_POST['aruskas'],
							);
		$execf= $db->insert("ak_kas_keluar", $data_dtl_kk);
}
		echo "<script>window.location='index.php?x=pembgaji'</script>";

?>