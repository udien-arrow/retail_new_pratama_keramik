<?php
session_start();
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
//$dat=$db->select("ak_kasbank","*","(account like '%$term%' or description like '%$term%') AND kb IN('2') AND cabang='$_SESSION[ID_CABANG]' ");
$dat=$db->select("ak_kasbank","account,description","(account like '%$term%' or description like '%$term%') AND kb IN('2') AND cabang='$_SESSION[ID_CABANG]' UNION select a.acc_code,b.nama_parameter from ak_parameterjur a join ak_m_parameterjur b on a.id_m_parameterjur=b.id_parameter where b.id_parameter in (9,10,11,12,13)");

foreach($dat as $row)
{
	$row=htmlentities(stripslashes($row['account']." - ".$row['description']));
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>