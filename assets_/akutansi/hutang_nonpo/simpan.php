<?php
$tabel = "tx_bph_dtl_tmp";
if($_POST[kode]==''){
	$idkm=$db->nourut('id_bph', 'tx_bph_dtl_tmp', 'PH', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
	//$max=$db->select("ak_bph_dtl_tmp","max(id_bph)as id");
	//foreach($max as $val){}
	$id=$val['id']+1;
	$jumlah = $_POST['jml'];
	$new_jml = str_replace(',', '',$jumlah);
	//$pos = $_POST['curr'];
	$pos = $new_jml;
	$acc=explode("-",$_POST['korek']);
	//$pl=explode("-",$_POST['pelangans']);
	//$pum=explode("_",$_POST['pums']);
	//$pum1=explode("_",$_POST['pums1']);
		//if($_POST['jenjur']=='km'){
									
		$data = array( 
				 //'TIPE' => $_POST['jenjur'],
				 'deskripsi' => $_POST['ket'],
				 'acc_code' => trim($acc[0]," "),
				 'jumlah' =>  $new_jml,
				 'cabang' => $_SESSION['ID_CABANG'],
				 //'TYPE_AR' => $_POST['aruskas'],
				 'id_user' => $_SESSION['ID_LOGIN']
				);
		/*}elseif($_POST['jenjur']=='spum'){
			$js=$db->select("ak_pum a join ak_jenisum b on a.TIPE=b.id_jenisum","*","a.NO_PUM='$pum[0]'");
			foreach($js as $jas){}
			$data = array( 'IDX' => $id, 
				 'TIPE' => $_POST['jenjur'],
				 'ACC_CODE' => $jas['account'],
				 'KET_DTL' => $_POST['ket'],
				 'KREDIT' =>  $new_jml,
				 'TIPE' => "KM" ,
				 'TYPE_AR' => $_POST['aruskas'],
				 'ID_USER' => $_SESSION['ID_LOGIN'],
				 'NO_AMM' => $pum[0],
				 'JENIST' => $_POST['jenjur']
				);
		}elseif($_POST['jenjur']=='pepel'){
			$data = array( 'IDX' => $id, 
				 'TIPE' => $_POST['jenjur'],
				 'ACC_CODE' => trim($acc[0]," "),
				 'KET_DTL' => $_POST['ket'],
				 'KREDIT' =>  $new_jml,
				 'TIPE' => "KM" ,
				 'TYPE_AR' => $_POST['aruskas'],
				 'ID_USER' => $_SESSION['ID_LOGIN'],
				 'KD_CUS' => trim($pl[3]," "),
				 'JENIST' => $_POST['jenjur']
				);
		}elseif($_POST['jenjur']=='pumnon'){
			$js=$db->select("ak_pum a join ak_jenisum b on a.TIPE=b.id_jenisum","*","a.NO_PUM='$pum1[0]'");
			foreach($js as $jas){}
			$data = array( 'IDX' => $id, 
				 'TIPE' => $_POST['jenjur'],
				 'ACC_CODE' => $jas['account'],
				 'KET_DTL' => $_POST['ket'],
				 'KREDIT' =>  $new_jml,
				 'TIPE' => "KM" ,
				 'TYPE_AR' => $_POST['aruskas'],
				 'ID_USER' => $_SESSION['ID_LOGIN'],
				 'NO_AMM' => $pum[0],
				 'JENIST' => $_POST['jenjur']
				);
		}*/
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=htnonpo'</script>";
}else{
	$data = array( 
				 'TIPE' => $_POST['jenjur'],
				 'ACC_CODE' => $_POST['norek'],
				 'KET_DTL' => $_POST['ket'],
				 'KREDIT' => $_POST['jml'],
				 'TYPE_AR' => $_POST['aruskas'],
				 'ID_USER' => $_SESSION['ID_LOGIN']
				
		 );
	$exec= $db->update($tabel, $data, "IDKM='$_POST[kode]'");
	echo "<script>window.location='index.php?x=kmbm'</script>";
}
?>