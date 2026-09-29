<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_app_pemba';
$primaryKey = 'id_pt';
$jenis = 'view';
$where2="status=0";
$limit="";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'no_pt',     'dt' => 1 ),
	array( 'db' => 'tgl_pt',     'dt' => 2 ),
	array(
		'db'        => 'no_pt',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_pemba&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



