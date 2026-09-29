<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_app_so';
$primaryKey = 'id';
$jenis = 'input';
$ids=$_GET['id'];
$asf=explode("_",$_GET['id']);
$where2="id_stok_opname='$asf[0]' and status='0'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array( 'db' => 'stok_fisik',     'dt' => 3 ),
	array( 'db' => 'stok_sys',     'dt' => 4 ),
	array( 'db' => 'selisih',     'dt' => 5 ),
	array( 'db' => 'ket',     'dt' => 6 ),
	array( 'db' => 'hpp_akhir',     'dt' => 7 ),
	array(
		'db'        => 'kd_brg',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$adf=explode("_",$_GET['id']);
			return "<ul class='icons-list'>
			<li class='text-primary-200'>
			<input type='hidden' value='$adf[0]' name='idnya'>
			<input type='hidden' value='$adf[1]' name='inigudang'>
			<input type='checkbox' value='$d' name='cek[]' class='split'>
			</li>
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



