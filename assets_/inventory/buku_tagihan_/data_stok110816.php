<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'tx_buku_tagihan';
$primaryKey = 'id';
$jenis = 'view';
$where2="id_user='$_SESSION[ID_LOGIN]'";
$limit="";
$columns = array(
	array( 'db' => 'no',     'dt' => 0 ),
	array(
		'db'        => 'tgl',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return "$d";
		}
	),
	array( 'db' => 'ket',     'dt' => 2 ),
	array(
		'db'        => 'no',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('index.php?x=bukta_c&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=bukta_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



