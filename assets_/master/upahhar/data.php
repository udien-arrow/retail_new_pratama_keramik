<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_upahhar';
$primaryKey = 'id_upah';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_cabang',     'dt' => 0 ),
	array( 'db' => 'nama_jabatan',     'dt' => 1 ),
	array(
		'db'        => 'nominal_bulan',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nominal_hari',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nominal_lembur',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
				$d
			";
		}
	),
	array( 'db' => 'tgl_berlaku',     'dt' => 5 )
	
);
$sql_details = array(
	
);
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis , $limit)
	).');';
}



