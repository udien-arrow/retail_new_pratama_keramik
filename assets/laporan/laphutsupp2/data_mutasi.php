<?php
require( '../../../webclass.php' );
$db=new kelas;
$tg=date("Y-m-d H:i:s",strtotime($_GET['tg']." 00:00:00"));
$tgsd=date("Y-m-d H:i:s",strtotime($_GET['tgsd']." 23:59:00"));

if($tg!=''){
	$table = 'tx_mutasi';
	$primaryKey = 'id_mutasi';
	$jenis = 'input';
	$where2="id_gudang='$_GET[gud]' and id_barang='$_GET[id]' and tgl_mutasi between '$tg' and '$tgsd'";
	$limit="limit 0,20000";
}
$columns = array(
	array(
		'db'        => 'jenis_mutasi',
		'dt'        => 0,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$mutasi="Barang Masuk";
			}elseif($d==1){
				$mutasi="Barang Keluar";
			}elseif($d==10){
				$mutasi="Retur Pembelian";
			}elseif($d==11){
				$mutasi="Delivery Order";			
			}elseif($d==12){
				$mutasi="Retur Jual";			
			}
			return "
				$mutasi
			";
		}
	),
	array( 'db' => 'no_ref',     'dt' => 1 ),
	array( 'db' => 'tgl_mutasi',     'dt' => 2 ),
	array( 'db' => 'awal',     'dt' => 3 ),
	array( 'db' => 'masuk',     'dt' => 4 ),
	array( 'db' => 'keluar',     'dt' => 5 ),
	array( 'db' => 'akhir',     'dt' => 6 )	
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



