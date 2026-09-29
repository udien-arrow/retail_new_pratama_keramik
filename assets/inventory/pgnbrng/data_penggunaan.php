<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_usage';
$primaryKey = 'id_usage';
$jenis = 'view';
$where2="id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_usage',     'dt' => 0 ),
	array( 'db' => 'nama_gudang',     'dt' => 1 ),
	array( 'db' => 'nama_cabang',     'dt' => 2 ),
	array( 'db' => 'tgl_input',     'dt' => 3 ),	
	array(
		'db'        => 'no_usage',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=pgnbrng&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=pgnbrng_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



