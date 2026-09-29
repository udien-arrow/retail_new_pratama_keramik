<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_deposit_his';
$primaryKey = 'id';
$jenis = 'input';
$where2="id_cabang='$_SESSION[ID_CABANG]' and no_deposit='$_GET[id]'";
$limit="limit 0,100000";
$columns = array(
	array( 'db' => 'no_deposit',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array(
		'db'        => 'nominal',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$a=number_format($d);
			return "$a
			";
		}
	),
	array( 'db' => 'ket',     'dt' => 4 )
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



