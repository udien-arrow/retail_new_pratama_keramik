<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_remasset';
$primaryKey = 'ID_AMASSET';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'ASSET_NAME', 'dt' => 0 ),
	array( 'db' => 'TGL_REMASSET', 'dt' => 1 ),
	array( 'db' => 'KET_REMASSET', 'dt' => 2 ),
	array( 'db' => 'JENIS', 'dt' => 3 ),
	array( 'db' => 'LOKASI', 'dt' => 4 ),
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



