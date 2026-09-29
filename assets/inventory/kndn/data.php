<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_kndn';
$primaryKey = 'id_piutang';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]' and status_bayar='0'";
$limit="";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'no_faktur_jual',     'dt' => 1 ),
	array( 'db' => 'no_ref',     'dt' => 2 ),
	array( 'db' => 'tgl',     'dt' => 3 ),
	array(
		'db'        => 'jenis',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d="Bulan Berjalan";	
			}
			if($d==1){
				$d="Bulan Lalu";	
			}
			return "
			$d
			";
		}
	),
	array(
		'db'        => 'type',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d="Debet Note";	
			}
			if($d==1){
				$d="Kredit Note";	
			}
			return "
			$d
			";
		}
	),
	array(
		'db'        => 'total_piutang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			$a=number_format($d);
			return "$a
			";
		}
	),
	
	array(
		'db'        => 'gab',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			if($exp[2]==0){
				$a="Cetak Koreksi SPJ";
				$b="page=korpi&id=$exp[0]&jenis=1";
			}
			if($exp[2]==1 && $exp[1]==0){
				$a="Cetak Koreksi Faktur";
				$b="page=korpi&id=$exp[0]&jenis=2";
			}
			if($exp[2]==1 && $exp[1]==1){
				$a="Cetak Nota Retur";
				$b="page=korpi&id=$exp[0]&jenis=3";
			}
			return "
			<ul class='icons-list'>
				<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='$a' onClick=window.open('cetak.php?$b')></button></li>
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



