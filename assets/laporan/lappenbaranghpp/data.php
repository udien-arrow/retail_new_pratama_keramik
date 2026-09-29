<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_penjualan_dtl';
$primaryKey = 'id_dtl_jual';
$jenis = 'view';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];
$limit="";

if($_GET['jenis']=='1'){
	
$where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and id_barang='$_GET[barang]'";
}
else if($_GET['jenis']=='2'){
	
$where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and id_customer='$_GET[toko]'";
}

echo $where2;

$limit="";
$columns = array(
	array( 'db' => 'tgl_penjualan', 'dt' => 0 ),
	array( 'db' => 'no_penjualan', 'dt' => 1 ),
	array( 'db' => 'nama_cus', 'dt' => 2 ),
	array( 'db' => 'alamat', 
	       'dt'  => 3),  
	array( 'db' => 'nama_barang', 'dt' => 4 ),
	array( 'db' => 'qty_jual', 'dt' => 5 ),
	array( 'db' => 'harga_jual', 
		   'dt' => 6 
		   ),
	array( 'db' => 'dtl_total', 'dt' => 7 ),
	array( 'db' => 'nama_pegawai', 'dt' => 8 ),
	array( 'db'  => 'dtl_total','dt'  => 9),
	array( 'db'  => 'dtl_total','dt'  => 10),
	
	
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



