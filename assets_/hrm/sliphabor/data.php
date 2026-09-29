<?php
session_start();
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_sliphabor';
$primaryKey = 'id';
$jenis = 'input';
$where2="tahun='$_GET[tahun]' and bulan='$_GET[bulan]' and id_cabang='$_SESSION[ID_CABANG]'";
$limit="";
$columns = array(
	array( 'db' => 'nik',     'dt' => 0),
	array( 'db' => 'nama_pegawai',     'dt' => 1 ),
	array( 'db' => 'nama_jabatan',     'dt' => 2 ),
	array( 'db' => 'nama_kontrak',     'dt' => 3 ),
	array( 'db' => 'jumlah_terima',     'dt' => 4,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'lembur',     'dt' => 5,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'total_terima',     'dt' => 6,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array(
		'db'        => 'gab',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$d=explode("_",$d);
			if($d[1]==0){
				$e="Belum ACC";	
			}elseif($d[1]==1){
				$e="<div align='center'><ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=sliphabor&id=$d[0]') class='icon-printer2' style='cursor:pointer'></a></li>
			</ul>
			</div>";	
			}
			return "
			$e
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
