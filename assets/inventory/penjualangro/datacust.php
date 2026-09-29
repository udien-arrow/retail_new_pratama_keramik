<?php
session_start();
error_reporting(0);
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("m_customer left join sales on sales.ID_SALES=m_customer.sales","*","nama_usaha like '%$term%' and status = '1'" );
foreach($dat as $row)
{
	$rowi1=htmlentities(stripslashes($row['id_cus'].'-'.$row['nama_usaha']));
	$rowi2=htmlentities(stripslashes($row['nama_usaha']));
	$rowi3=htmlentities(stripslashes($row['id_cus']));
	$rowi4=htmlentities(stripslashes($row['ID_SALES']));
	$rowi5=htmlentities(stripslashes($row['NAMA_SALES']));
	
    //$row_set[] = $row;
	$row_set[] = array("value"=>$rowi1,"a"=>$rowi2,"b"=>$rowi3,"c"=>$rowi4, "d"=>$rowi5);
}


//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);

?>