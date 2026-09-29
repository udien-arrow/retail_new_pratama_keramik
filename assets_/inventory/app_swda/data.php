<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_swda';
$primaryKey = 'id';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_spj',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array( 'db' => 'shipto_code',     'dt' => 2 ),
	array( 'db' => 'nama_usaha_to',     'dt' => 3 ),
	array( 'db' => 'shipto_code_to',     'dt' => 4 ),
	array(
		'db'        => 'no_spj',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_swda&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



