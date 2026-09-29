<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_brgkeluar2';
$primaryKey = 'no_spj';
$jenis = 'view';
$where2="id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_spj',     'dt' => 0 ),
	array( 'db' => 'darigudang',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array( 'db' => 'tgl_spj',     'dt' => 3 ),
	array( 'db' => 'no_ref',     'dt' => 4 ),
	array(
		'db'        => 'gud',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$ds=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=cetakspj2&id=$ds[0]') class='icon-printer2' style='cursor:pointer'></a></li>
			<li>
			<a href='javascript:void(0)' onclick=window.location='index.php?x=brgkeluar2_v&id=$ds[0]&gudang=$ds[1]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



