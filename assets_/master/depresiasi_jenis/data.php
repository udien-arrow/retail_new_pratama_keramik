<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'am_depresiasi';
$primaryKey = 'id_depresiasi';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_depresiasi',     'dt' => 0 ),
	array( 'db' => 'nama_depresiasi',     'dt' => 1 ),
	array( 'db' => 'akun_aktiva',     'dt' => 2 ),
	array( 'db' => 'akun_depresiasi',     'dt' => 3 ),
	array( 'db' => 'beban_depresiasi',     'dt' => 4 ),
	array( 'db' => 'pendapatan',     'dt' => 5 ),
	array( 'db' => 'kerugian',     'dt' => 6 ),
	
	
	array(
		'db'        => 'id_depresiasi',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			
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



