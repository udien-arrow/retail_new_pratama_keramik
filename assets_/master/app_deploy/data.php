<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_deployin';
$primaryKey = 'ID_DEPLOY';
$jenis = 'view';
$where2="STATUS='1' AND ST2='1'";
$limit="";
$columns = array(
	array( 'db' => 'NAMA_ALOKASI',     'dt' => 0 ),
	array( 'db' => 'ASSET_NAME',     'dt' => 1 ),
	array( 'db' => 'DEPLOY_DATE',     'dt' => 2 ),
	array( 'db' => 'DEPLOY_KETERANGAN',     'dt' => 3 ),
	array( 'db' => 'USERNAME',     'dt' => 4 ),
	array(
		'db'        => 'ID_DEPLOY',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='undep($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			</ul>
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



