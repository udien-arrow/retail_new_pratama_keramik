<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_jenisumpph';
$primaryKey = 'id_jenisum';
$jenis = 'view';
$where2="st='1'";
$limit="";
$columns = array(
	array( 'db' => 'jenis_um',     'dt' => 0 ),
	array( 'db' => 'jenis_um',     'dt' => 1 ),
	array( 'db' => 'akun',     'dt' => 2 ),
	
	array(
		'db'        => 'id_jenisum',
		'dt'        => 3,
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



