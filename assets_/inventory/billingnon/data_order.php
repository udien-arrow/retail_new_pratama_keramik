<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_billing';
$primaryKey = 'id_billing';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_billing',     'dt' => 0 ),
	array( 'db' => 'tgl',     'dt' => 1 ),
	array( 'db' => 'no_ref',     'dt' => 2 ),
	array( 'db' => 'nama_usaha',     'dt' => 3 ),
	array(
		'db'        => 'total_bil',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'no_billing',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=billing_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



