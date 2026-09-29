<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_abs_lembur';
$primaryKey = 'id';
$jenis = 'input';
$where2="year(date)='$_GET[tahun]' and month(date)='$_GET[bulan]' and id_cabang='$_GET[cab]' and id not in (select id_abs from hr_lembur)";
$limit="";
$columns = array(
	array( 'db' => 'nik',     'dt' => 0),
	array( 'db' => 'acno',     'dt' => 1 ),
	array( 'db' => 'nama_pegawai',     'dt' => 2 ),
	array( 'db' => 'date',     'dt' => 3,
			'formatter' => function( $d, $row ) {
			$d=date("d-m-Y",strtotime($d));
			return "
			$d
			";
		} ),
	array( 'db' => 'clock_out',     'dt' => 4 ),
	array( 'db' => 'off_duty',     'dt' => 5 ),
	array( 'db' => 'att_time',     'dt' => 6 ),
	array(
		'db'        => 'gab',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$f=explode("_",$d);
			$e=explode(":",$f[0]);
			$de=(int)$e[0];
			return "
			$de
			<input type='hidden' name='datalem[]' value='$d'>
			";
		}
	),
	array(
		'db'        => 'id',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "
			<div align='center'>
			<input type='checkbox' name='split[]' id='split$d' class='split' value='$d'>
			</div>
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
