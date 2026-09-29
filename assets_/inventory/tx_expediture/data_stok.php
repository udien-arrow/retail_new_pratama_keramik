<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_expediture_v';
$primaryKey = 'id_expediture';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'no_expediture',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array(
		'db'        => 'no_expediture',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='Detil' onClick=window.location='index.php?x=txex_v&id=$d'></button></li>
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



