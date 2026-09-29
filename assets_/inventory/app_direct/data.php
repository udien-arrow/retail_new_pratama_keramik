<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_direct';
$primaryKey = 'id_direct';
$jenis = 'view';
$where2="id_cabang_to='$_SESSION[ID_CABANG]' and status='0'";
$limit="";
$columns = array(
	array( 'db' => 'no_sales',     'dt' => 0 ),
	array( 'db' => 'stampdate',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array( 'db' => 'nama_cabang',     'dt' => 3 ),
	array( 'db' => 'nama_cabang_to',     'dt' => 4 ),
	array( 'db' => 'ship_to',     'dt' => 5 ),
	array(
		'db'        => 'no_sales',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_direct&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



