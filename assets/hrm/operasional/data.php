<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_operasional';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_jenis',     'dt' => 0,
			'formatter' => function( $d, $row ) {
			
			return "
			$d
			";
		} ),
	array( 'db' => 'nama_pegawai',     'dt' => 1 ),
	array( 'db' => 'date',     'dt' => 2 ),
	array( 'db' => 'date_end',     'dt' => 3 ),
	array( 'db' => 'nominal',     'dt' => 4,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'keterangan',     'dt' => 5 ),
	array(
		'db'        => 'id',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			//return date( 'jS M y', strtotime($d));
			return "<ul class='icons-list'>
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
