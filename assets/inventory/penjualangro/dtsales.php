<?php
session_start();
error_reporting(0);
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("sales","*","NAMA_SALES like '%$term%' ");
foreach($dat as $row)
{
	$rowi1=htmlentities(stripslashes($row['ID_SALES'].'-'.$row['NAMA_SALES']));
	$rowi2=htmlentities(stripslashes($row['NAMA_SALES']));
	$rowi3=htmlentities(stripslashes($row['ID_SALES']));
	
    //$row_set[] = $row;
	$row_set[] = array("value"=>$rowi1,"a"=>$rowi2,"b"=>$rowi3);
}


//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);

?>