<?php 
error_reporting(0);
session_start();
require( '../../../webclass.php' );
$db=new kelas;
$ex=explode("_",$_POST['spj']);
if($ex[2]!=''){
	$where="no_spj='$ex[0]' and urut='$ex[2]'";
}else{
	$where="no_spj='$ex[0]'";
}

$tm=$db->select("tx_order_tagihan_kd","*",$where);
foreach($tm as $tmp){}
$data = array( 
					'no_billing' => $tmp['no_billing'], 
					'no_spj' => $tmp['no_spj'],
					'qty' => $tmp['qty'],
					'harga' => $tmp['harga'],
					'total' => $tmp['total'],
					'jenis' => $tmp['jenis'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'claim_utuh' => $tmp['claim_utuh'],
					'claim_ktg' => $tmp['claim_ktg'],
					'digunakan_bill' => $ex['1'],
					'urut' => $tmp['urut'],
					);
$exec= $db->insert("tx_order_tagihan_kd_tmp", $data);

$data = array( 
					'status' => 1,
					);
//$exec= $db->update("tx_order_tagihan_kd", $data,"no_spj='$tmp[no_spj]'");


?>