<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'ex_claim_pab';
$primaryKey = 'id_claim';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_claim',     'dt' => 0 ),
	array(
		'db'        => 'no_ref',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return "$d";
		}
	),
	array( 'db' => 'tgl_claim',     'dt' => 2 ),
	array(
		'db'        => 'no_claim',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='index.php?x=claimpb_v&id=$d' class='icon-folder-open' style='cursor:pointer'></a></li>
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



