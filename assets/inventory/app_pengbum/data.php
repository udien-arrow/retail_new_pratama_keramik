<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_app_pengbum';
$primaryKey = 'id_pengbum';
$jenis = 'view';
$where2="status=0 and id_cabang='$_SESSION[ID_CABANG]' and jenis='$_GET[jenis]'";
$limit="";
$columns = array(
	array( 'db' => 'no_pengbum',     'dt' => 0 ),
	array( 'db' => 'nama_gudang',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array( 'db' => 'nama_pegawai',     'dt' => 3 ),
	array(
		'db'        => 'no_pengbum',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_pengbum&id=$d&jenis=$_GET[jenis]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



