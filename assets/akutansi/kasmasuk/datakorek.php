<?php
session_start();
require_once("../../../webclass.php");
$db=new kelas();


$term = trim(strip_tags($_GET['term'])); 
$dat=$db->select("ak_acc","*","(account like '%$term%' or description like '%$term%') AND LR NOT IN('0','1')  AND post_flag='1'");
foreach($dat as $row)
{
	$row=htmlentities(stripslashes($row['account']." - ".$row['description']));
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>