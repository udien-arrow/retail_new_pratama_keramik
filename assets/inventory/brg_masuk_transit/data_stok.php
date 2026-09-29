<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'tx_brg_masuk';
$primaryKey = 'id_masuk';
$jenis = 'view';
$where2="jenis='4' and id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_masuk',     'dt' => 0 ),
	array( 'db' => 'no_ref',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array( 'db' => 'surat_jalan',     'dt' => 3 ),
	array(
		'db'        => 'id_masuk',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
		 	<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=brg_masuk_transit&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='index.php?x=brg_masuk_transit_v&id=$d' class='icon-folder-open' style='cursor:pointer'></a></li>
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



