<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_masterbarang';
$primaryKey = 'ID_AMASSET';
$jenis = 'view';
$where2="STAT<'4'";
$limit="";
$columns = array(
	array( 'db' => 'ASSET_NAME',     'dt' => 0 ),
	array( 'db' => 'NAMA_AMODEL',     'dt' => 1 ),
	array( 'db' => 'ASSET_TAG',     'dt' => 2 ),
	array( 'db' => 'ASSET_STATUS',     'dt' => 3 ),
	array( 'db' => 'ASSET_SN',     'dt' => 4 ),
	array( 'db' => 'ASSET_PURCHASE',     'dt' => 5 ),
	array( 'db' => 'ASSET_HARGABELI',     'dt' => 6,
		   'formatter' => function($d,$row){return number_format($d);} ),
	array( 'db' => 'ASSET_WARRANTY',     'dt' => 7 ),
	array( 'db' => 'ASSET_KETERANGAN',     'dt' => 8 ),
	array(
		'db'        => 'ID_AMASSET',
		'dt'        => 9,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-pencil'></a></li>
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



