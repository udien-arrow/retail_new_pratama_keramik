<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'hr_m_kontrakpeg';
$primaryKey = 'id_status';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_status',     'dt' => 0 ),
	array( 'db' => 'nama_kontrak',     'dt' => 1 ),
	array( 'db' => 'gaji_pokok',     'dt' => 2 ),
	array( 'db' => 'tunj_umum',     'dt' => 3 ),
	array( 'db' => 'tunj_repre',     'dt' => 4 ),
	array( 'db' => 'tunj_fungsi',     'dt' => 5 ),
	array( 'db' => 'tunj_presensi',     'dt' => 6 ),
	array( 'db' => 'tunj_penem',     'dt' => 7 ),
	array(
		'db'        => 'id_status',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
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



