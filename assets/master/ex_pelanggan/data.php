<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_ex_pelanggan';
$primaryKey = 'id_ex';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'alamat_usaha',     'dt' => 1 ),
	array(
		'db'        => 'limit_pkc',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$k=number_format($d);
			return "
			$k
			";
		}
	),
	array(
		'db'        => 'limit_pkb',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$k=number_format($d);
			return "
			$k
			";
		}
	),
	array(
		'db'        => 'limit_plafon',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$k=number_format($d);
			return "
			$k
			";
		}
	),
	array( 'db' => 'tempo_normal',     'dt' => 5 ),
	array( 'db' => 'tempo_tambahan',     'dt' => 6 ),
	array( 'db' => 'tempo_pembayaran',     'dt' => 7 ),
	array( 'db' => 'keterangan',     'dt' => 8 ),
	array(
		'db'        => 'id_ex',
		'dt'        => 9,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
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



