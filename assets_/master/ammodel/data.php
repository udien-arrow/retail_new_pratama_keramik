<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_modelbarang';
$primaryKey = 'ID_AMODEL';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'NAMA_AMODEL',     'dt' => 0 ),
	array( 'db' => 'NAMA_AKATAGORI',     'dt' => 1 ),
	array( 'db' => 'NOMOR_AMODEL',     'dt' => 2 ),
	array( 'db' => 'KETERANGAN_AMODEL',     'dt' => 3 ),
	array( 'db' => 'EOL_AMODEL',     'dt' => 4 ),
	array(
		'db'        => 'ID_AMODEL',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
			<li class='text-primary-200'><a data-toggle='modal' id='mod' data-target='#datapelanggan' href='javascript:void(0)' onclick='viewdk($d)' class='icon-list' style='cursor:pointer'></a></li>
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



