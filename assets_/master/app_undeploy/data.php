<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_undeployin';
$primaryKey = 'ID_UNDEPLOY';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'ID_UNDEPLOY',     'dt' => 0 ),
	array( 'db' => 'NAMA_ALOKASI',     'dt' => 1 ),
	array( 'db' => 'ASSET_NAME',     'dt' => 2 ),
	array( 'db' => 'UNDEPLOY_DATE',     'dt' => 3 ),
	array( 'db' => 'USERNAME',     'dt' => 4 ),
	array(
		'db'        => 'ID_UNDEPLOY',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			";
		}
	)
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



