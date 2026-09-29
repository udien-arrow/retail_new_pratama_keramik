<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'm_klaim_ktg';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id',     'dt' => 0 ),
	array( 'db' => 'harga',     'dt' => 1 ),
	array( 'db' => 'tgl_berlaku',     'dt' => 2 ),
);
$sql_details = array(
	
);
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



