<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_app_orderpemn';
$primaryKey = 'id_order';
$jenis = 'view';
if($_GET['kode']==1){
$where2="jenis='$_GET[jenis]' and status='$_GET[sta]'";
}else{
$where2="jenis='$_GET[jenis]' and status='$_GET[sta]' and level>='$_GET[level]' and id_cabang='$_GET[cab]'";
}
$limit="";
$columns = array(
	array( 'db' => 'no_order',     'dt' => 0 ),
	array( 'db' => 'nama_gudang',     'dt' => 1),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array(
		'db'        => 'no_order',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_orderpemn&id=$d&jenis=$_GET[jenis]&st=$_GET[st]&level=$_GET[level]&sta=$_GET[sta]&cab=$_GET[cab]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



