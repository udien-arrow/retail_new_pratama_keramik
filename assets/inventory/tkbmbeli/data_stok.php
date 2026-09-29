<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_tkbm_pembelian';
$primaryKey = 'id_tkbm_b';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_masuk',     'dt' => 0 ),
	array( 'db' => 'no_spj',     'dt' => 1 ),
	array(
		'db'        => 'tgl',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$d=date("d-m-Y",strtotime($d));
			return "
			$d
			";
		}
	),
	array( 'db' => 'nama_cabang',     'dt' => 3 ),
	array(
		'db'        => 'no_masuk',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=tkbmbeli&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li>
			<a href='javascript:void(0)' onclick=window.location='index.php?x=tkbmbeli_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



