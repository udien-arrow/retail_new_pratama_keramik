<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'm_manualbook';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id',     'dt' => 0 ),
	array( 'db' => 'nama',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array(
		'db'        => 'file',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='assets/master/manualbook/upload/$d' class='icon-download' style='cursor:pointer'></a></a></li>
			</ul>
			
			
			";
		}
	),
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



