<?php
$tabel = "m_customer_deposit";
if($_POST[kode]==''){
$expc=explode("_",$_POST['id_cus']);
$ak=$db->select("m_customer_deposit","*","id_cus='$expc[0]'");
$jum=count($ak);
if($jum==0){
		$id=$db->idurut($tabel,"id_deposit"); // DP/PRA001000/0001
		foreach($db->select("m_customer_deposit order by id_deposit limit 0,1","no_deposit")as $gen);
		$exp=explode("/",$gen['no_deposit']);	
		$nil=(int) $exp[2];
		if($nil==''){
			$nogen="DP/".$expc[1]."/".sprintf("%04s", "1");	
		}else{
			$nil=$nil+1;
			$nogen="DP/".$expc[1]."/".sprintf("%04s", $nil);	
		}
		$data = array( 
				'id_deposit' => $id, 
				'no_deposit' => $nogen,
				'id_cus' => $expc[0],
				'nominal' => str_replace(",","",$_POST['nominal']),
				'id_cabang' => $_SESSION['ID_CABANG'],
				);
		$exec= $db->insert($tabel, $data);
		$data = array( 
				'no_deposit' => $nogen,
				'id_cus' => $expc[0],
				'nominal' => str_replace(",","",$_POST['nominal']),
				'ket' => $_POST['ket'],
				'id_cabang' => $_SESSION['ID_CABANG'],
				'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
				'stampdate' => date("Y-m-d H:i:s"),
				'status' => '1',
				'jenis' => '0'
				);
		$exec= $db->insert("m_customer_deposit_his", $data);
}else{//end jum
		foreach($ak as $cust);
		//$id=$db->idurut($tabel,"id_deposit"); // DP/PRA001000/0001
		$data = array( 
				'nominal' => str_replace(",","",$_POST['nominal'])+$cust['nominal'],
				);
		$exec= $db->update($tabel, $data,"id_deposit='$cust[id_deposit]'");
		$data = array( 
				'no_deposit' => $cust['no_deposit'],
				'id_cus' => $expc[0],
				'nominal' => str_replace(",","",$_POST['nominal']),
				'ket' => $_POST['ket'],
				'id_cabang' => $_SESSION['ID_CABANG'],
				'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
				'stampdate' => date("Y-m-d H:i:s"),
				'status' => '1',
				'jenis' => '0'
				);
		$exec= $db->insert("m_customer_deposit_his", $data);
		$nogen=$cust['no_deposit'];
}
		include('jurnal_dtl.php');
		
	echo "<script>window.location='index.php?x=deposit'</script>";
}
?>