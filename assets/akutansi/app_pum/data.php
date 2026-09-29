<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_app_pum';
$primaryKey = 'ID';
$jenis = 'view';
$where2="status=0";
$limit="";
$columns = array(
	array( 'db' => 'nama_pegawai',     'dt' => 0 ),
	array( 'db' => 'nama_cabang',     'dt' => 1 ),
	array( 'db' => 'NO_PUM',     'dt' => 2 ),
	array( 'db' => 'tgl',     'dt' => 3 ),
	array(
		'db'        => 'TOTAL',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$k=number_format($d);
			return "
			$k
			";
		}
	),
	array(
		'db'        => 'NO_PUM',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_pum&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



