<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_bm';
$primaryKey = 'id_dtl';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];

// echo "Tanggal A: " . $gg . "\n"; echo "Tanggal B: " . $wp . "\n";

//$where2="id_cabang='$_GET[cab]' AND tgl BETWEEN '$gg' AND '$wp' and jenis='$_GET[jenis]'";
$where2="id_gudang='$_GET[jenis]' AND tgl BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'no_masuk', 'dt' => 0 ),
	array( 'db' => 'tgl', 'dt' => 1 ),
	array( 'db' => 'no_ref', 'dt' => 2 ),
	array( 'db' => 'surat_jalan', 'dt'  => 3),
	array( 'db' => 'dari_siapa', 'dt' => 4 ),
	array( 'db' => 'nama_gudang', 'dt' => 5 ),
	array( 'db' => 'nama_barang', 'dt' => 6 ),
	array( 'db' => 'namacv', 'dt' => 7 ),
	array( 'db' => 'nama_satuan', 'dt' => 8 ),
	array( 'db' => 'qty', 'dt' => 9 ),
	array( 'db' => 'qty_terima', 'dt' => 10 ),
	array( 'db' => 'harga_beli', 'dt' => 11 ),
	array( 'db' => 'total', 'dt' => 12 ),
	array( 'db' => 'dpp', 'dt' => 13 ),
	array( 'db' => 'ppnt', 'dt' => 14 )
	
	
);
$sql_details = array(
	
);
// echo "select * from $table where $where2";
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



