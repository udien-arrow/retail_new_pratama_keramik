<?php
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;

$konv=$db->select("m_konv","*","sat1='$_GET[sat1]' and sat2='$_GET[sat2]'");
foreach($konv as $konv2){}

echo $konv2['konv'];
?>