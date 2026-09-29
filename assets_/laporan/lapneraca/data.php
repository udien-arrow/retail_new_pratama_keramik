<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_stokopname';
$primaryKey = 'id';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];
$where2="id_gudang='$_GET[cab]' AND date(tgl) BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'id_stok_opname', 'dt' => 0 ),
	array( 'db' => 'tgl', 'dt' => 1 ),
	array( 'db' => 'nama_barang', 'dt' => 2 ),
	array( 'db' => 'nama_satuan', 'dt'  => 3),
	array( 'db' => 'stok_fisik', 'dt' => 4 ),
	array( 'db' => 'stok_sys', 'dt' => 5 ),
	array( 'db' => 'selisih', 'dt' => 6 ),
	array( 'db' => 'ket', 'dt' => 7 )
	
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



