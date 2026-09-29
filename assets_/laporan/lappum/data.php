<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_pum';
$primaryKey = 'id';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];

$where2="id_cabang='$_GET[cab]' AND date(tanggal) BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'id_cabang', 'dt' => 0 ),
	array( 'db' => 'no_pum', 'dt' => 1 ),
	array( 'db' => 'nama_user', 'dt' => 2 ),
	array( 'db' => 'keperluan', 'dt'  => 3),
	array( 'db' => 'tanggal', 'dt' => 4 ),
	array( 'db' => 'total', 'dt' => 5 )
	
	
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



