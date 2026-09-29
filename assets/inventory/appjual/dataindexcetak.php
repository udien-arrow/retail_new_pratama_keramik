<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'tx_sales_biaya';
$primaryKey = 'id';
$jenis = 'view';
$where2="(id_cabang='$_SESSION[ID_CABANG]' and id_cabang_direct is null) or (id_cabang_direct='$_SESSION[ID_CABANG]')";
$limit="";
$columns = array(
	array( 'db' => 'no_sb',     'dt' => 0 ),
	array( 'db' => 'tgl',     'dt' => 1 ),
	array( 'db' => 'jenis_jual',     'dt' => 2 ),
	array( 'db' => 'keterangan',     'dt' => 3 ),
	array(
		'db'        => 'no_sb',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=appjual&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=appjual_c&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



