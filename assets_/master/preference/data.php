<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'preferences';
$primaryKey = 'id_pref';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nopref',     'dt' => 0 ),
	array( 'db' => 'nama_perusahaan',     'dt' => 1 ),
	array( 'db' => 'alamat',     'dt' => 2 ),
	array( 'db' => 'npwp',     'dt' => 3 ),
	array( 'db' => 'no_telp',     'dt' => 4 ),
	array( 'db' => 'logo',     'dt' => 5,
	'formatter' => function( $d, $row ) {
			return "<img src=\"logo/$d\" width='100' height='100' />";
		} ),
	
	array(
		'db'        => 'id_pref',
		'dt'        => 6,
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



