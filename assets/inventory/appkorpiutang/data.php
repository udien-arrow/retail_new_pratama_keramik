<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_koreksi_piutang2';
$primaryKey = 'id_koreksi';
$jenis = 'view';
$where2="status='0' and jenis='0'";
$limit="";
$columns = array(
	array( 'db' => 'no_koreksi',     'dt' => 0 ),
	array( 'db' => 'tgl_koreksi',     'dt' => 1 ),
	array(
		'db'        => 'jenis',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
				if($d==0){
					$d="Bulan Berjalan";
					}elseif($d==1){
					$d="Bulan Lalu";	
					}
			return "
					$d
			";
		}
	),
	array( 'db' => 'nama_usaha',     'dt' => 3 ),
	array( 'db' => 'no_fj',     'dt' => 4 ),
	array( 'db' => 'total_sebelumnya',     'dt' => 5,
			'formatter' => function( $d, $row ) {
				$d=number_format($d);
				return "
				$d
				";
			} 
		),
	array( 'db' => 'total',     'dt' => 6,
			'formatter' => function( $d, $row ) {
				$d=number_format($d);
				return "
				$d
				";
			} 
		),
	array( 'db' => 'total',     'dt' => 7,
			'formatter' => function( $d, $row ) {
				$d=number_format($d);
				return "
				$d
				";
			} 
		),
	array(
		'db'        => 'no_koreksi',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=appsetuju('$d') class=' icon-folder-check' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=apptolak('$d') class=' icon-folder-remove' style='cursor:pointer'></a></li>
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



