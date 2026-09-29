<?php
session_start();
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_sliphabor';
$primaryKey = 'id';
$jenis = 'input';
if($_SESSION['ID_CABANG']>0){
	$where2="tahun='$_GET[tahun]' and bulan='$_GET[bulan]' and id_cabang='$_SESSION[ID_CABANG]'";
}else{
	$where2="tahun='$_GET[tahun]' and bulan='$_GET[bulan]'";
	}
$limit="";
$columns = array(
	array( 'db' => 'nik',     'dt' => 0),
	array( 'db' => 'nama_pegawai',     'dt' => 1 ),
	array( 'db' => 'nama_jabatan',     'dt' => 2 ),
	array( 'db' => 'nama_kontrak',     'dt' => 3 ),
	array( 'db' => 'nama_cabang',     'dt' => 4 ),
	array( 'db' => 'jumlah_terima',     'dt' => 5,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'lembur',     'dt' => 6,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'total_terima',     'dt' => 7,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} )
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
