<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_reqdeploy';
$primaryKey = 'ID_REQDEPLOY';
$jenis = 'view';
$where2="STATUS='0'";
$limit="";
$columns = array(
	array( 'db' => 'ID_REQDEPLOY',     'dt' => 0 ),
	array( 'db' => 'NAMA_ALOKASI',     'dt' => 1 ),
	array( 'db' => 'ASSET_NAME',     'dt' => 2 ),
	array( 'db' => 'REQDEPLOY_DATE',     'dt' => 3 ),
	array( 'db' => 'REQDEPLOY_KETERANGAN',     'dt' => 4 ),
	array( 'db' => 'USERNAME',     'dt' => 5 ),
	array(
		'db'        => 'ID_REQDEPLOY',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='setuju($d)' class='icon-folder-check' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='tolak($d)' style='cursor:pointer' class='icon-folder-remove'></a></li>
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



