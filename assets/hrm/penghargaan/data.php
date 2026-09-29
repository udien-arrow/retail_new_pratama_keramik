<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_penghargaan';
$primaryKey = 'id_penghargaan';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_pegawai',     'dt' => 0 ),
	array( 'db' => 'nama_jenispeng',     'dt' => 1 ),
	array( 'db' => 'sk_penghargaan',     'dt' => 2 ),
	array( 'db' => 'ket_penghargaan',     'dt' => 3 ),
	array(
		'db'        => 'id_penghargaan',
		'dt'        => 4,
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
