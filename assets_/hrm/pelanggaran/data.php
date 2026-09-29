<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_pelanggaran';
$primaryKey = 'id_pelanggaran';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_pegawai',     'dt' => 0 ),
	array( 'db' => 'nama_jenispel',     'dt' => 1 ),
	array( 'db' => 'sk_pelanggaran',     'dt' => 2 ),
	array( 'db' => 'tgl',     'dt' => 3 ),
	array( 'db' => 'tgl_akhir',     'dt' => 4 ),
	array( 'db' => 'ket_pelanggaran',     'dt' => 5 ),
	array(
		'db'        => 'id_pelanggaran',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			//return date( 'jS M y', strtotime($d));
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



