<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_relok';
$primaryKey = 'id';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];
$where2="id_cabang='$_GET[cab]' AND tgl_relokasi BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'tgl_relokasi', 'dt' => 0 ),
	array( 'db' => 'no_spj', 'dt' => 1 ),
	array( 'db' => 'no_so', 'dt' => 2 ),
	array( 'db' => 'nama_gudang', 'dt' => 3 ),
	array( 'db' => 'nama_gudang2', 'dt'  => 4),
	array( 'db' => 'nama_barang', 'dt' => 5 ),
	array( 'db' => 'nama_satuan', 'dt' => 6 ),
	array( 'db' => 'qty_do', 'dt' => 7 )
	
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



