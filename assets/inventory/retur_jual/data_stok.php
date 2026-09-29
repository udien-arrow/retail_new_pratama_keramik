<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'tx_retur_pen';
$primaryKey = 'id_retur';
$jenis = 'view';
$where2="status='0'";
$limit="";
$columns = array(
	array( 'db' => 'no_retur',     'dt' => 0 ),
	array(
		'db'        => 'no_ref',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return "$d";
		}
	),
	array( 'db' => 'tgl_retur',     'dt' => 2 ),
	array( 'db' => 'ket',     'dt' => 3 ),
	array(
		'db'        => 'no_retur',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
		 	<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=returpen&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='index.php?x=returpen_v&id=$d' class='icon-folder-open' style='cursor:pointer'></a></li>
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



