<?php
error_reporting(0);
$str = file_get_contents( 'http://192.168.9.4/assets/plugin/printRaw/json.php?id=1');
$json=json_decode($str,true);

foreach($json as $vj => $key){
	echo $key[nm_brg]." $key[qty_jual]<br>";
	}


?>