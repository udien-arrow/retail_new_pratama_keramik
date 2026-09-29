<?php
session_start ();
date_default_timezone_set ( 'Asia/Jakarta' );
include 'webclass.php';
$db = new kelas();


$_SESSION ['ID_GUDANG'] = $_POST['gudang'];

echo "<script>location.href='$hs';</script>"; 

	
?>
