<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'm_grup';
$primaryKey = 'id_grup';
$jenis = 'view';
$where2="";
$limit="";
/* $columns = array(
	array( 'db' => 'id_grup',     'dt' => 0 ),
	array( 'db' => 'jenis',     'dt' => 1 ),
	array( 'db' => 'inventory',     'dt' => 2 ),
	array( 'db' => 'inventory_riject',     'dt' => 3 ),
	array( 'db' => 'cogs',     'dt' => 4 ),
	array( 'db' => 'intransit',     'dt' => 5 ),
	array( 'db' => 'intransitcabang',     'dt' => 6 ),
	array( 'db' => 'sales',     'dt' => 7 ),
	array( 'db' => 'bongkar',     'dt' => 8 ),
	array( 'db' => 'muat',     'dt' => 9 ),
	array( 'db' => 'pok',     'dt' => 10 ),
	array(
		'db'        => 'id_grup',
		'dt'        => 11,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			
			</ul>
			";
		}
	)
); */
$columns = array(
	array( 'db' => 'id_grup',     'dt' => 0 ),
	array( 'db' => 'jenis',     'dt' => 1 ),
	array( 'db' => 'inventory',     'dt' => 2 ),

	array( 'db' => 'cogs',     'dt' => 3 ),
	array( 'db' => 'intransit',     'dt' => 4 ),
	array( 'db' => 'bongkar',     'dt' => 5 ),
	array( 'db' => 'intransitcabang',     'dt' => 6 ),
	
	array(
		'db'        => 'id_grup',
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



