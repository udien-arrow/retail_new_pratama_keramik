<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_maintasset';
$primaryKey = 'ID_MAINT';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];

$where2="TGL_MAINT BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'ASSET_NAME',     'dt' => 0 ),
	array( 'db' => 'TGL_MAINT',     'dt' => 1 ),
	array( 'db' => 'COMPLETE_MAINT',     'dt' => 2 ),
	array( 'db' => 'KET_MAINT',     'dt' => 3 ),
	array( 'db' => 'COST_MAINT', 'dt' => 4 ),
	array( 'db' => 'ST', 'dt' => 5 ),
	array(
		'db'        => 'ID_MAINT',
		'dt'        => 6,
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



