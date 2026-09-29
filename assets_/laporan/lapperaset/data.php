<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_reqdeploy';
$primaryKey = 'ID_REQDEPLOY';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];

$where2="REQDEPLOY_DATE BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'NAMA_ALOKASI',     'dt' => 0 ),
	array( 'db' => 'ASSET_NAME',     'dt' => 1 ),
	array( 'db' => 'REQDEPLOY_DATE',     'dt' => 2 ),
	array( 'db' => 'REQDEPLOY_KETERANGAN',     'dt' => 3 ),
	array( 'db' => 'STATUSA', 'dt' => 4 ),
	array( 'db' => 'USERNAME',     'dt' => 5 ),
	array(
		'db'        => 'ID_REQDEPLOY',
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



