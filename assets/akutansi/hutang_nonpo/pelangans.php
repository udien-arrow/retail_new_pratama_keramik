<?php
session_start();
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("m_customer","*","nama_usaha like '%$term%'");
foreach($dat as $row)
{
	$row=htmlentities(stripslashes($row['id_cabang']." - ".$row['kode_cus']." - ".$row['nama_usaha'].' - '.$row['id_cus']));
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>