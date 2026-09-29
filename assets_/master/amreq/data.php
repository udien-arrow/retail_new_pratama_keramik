<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_reqdeploy';
$primaryKey = 'ID_REQDEPLOY';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'NAMA_ALOKASI',     'dt' => 0 ),
	array( 'db' => 'ASSET_NAME',     'dt' => 1 ),
	array( 'db' => 'REQDEPLOY_DATE',     'dt' => 2 ),
	array( 'db' => 'REQDEPLOY_KETERANGAN',     'dt' => 3 ),
	array( 'db' => 'USERNAME', 'dt' => 4 ),
	array( 'db' => 'STATUSA',     'dt' => 5 ),
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



