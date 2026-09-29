<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'tx_sales_spb';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_spb',     'dt' => 0 ),
	array( 'db' => 'tgl',     'dt' => 1 ),
	array(
		'db'        => 'no_spb',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('index.php?x=cetakspb_c&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=cetakspj&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



