<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_pegawai';
$primaryKey = 'id_pegawai';
$jenis = 'view';
$where2="id_cabang!=99";
$limit="";
$columns = array(
	array( 'db' => 'nik',     'dt' => 0 ),
	array( 'db' => 'nama_pegawai',     'dt' => 1 ),
	array( 'db' => 'nama_cabang',     'dt' => 2 ),
	array( 'db' => 'no_ktp',     'dt' => 3 ),
	array( 'db' => 'nama_jabatan',     'dt' => 4 ),
	array( 'db' => 'tmp_lahir',     'dt' => 5 ),
	array(
		'db'        => 'id_pegawai',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='detil($d)' style='cursor:pointer' class=' icon-magazine'></a></li>
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



