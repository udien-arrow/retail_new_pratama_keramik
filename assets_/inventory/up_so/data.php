<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_tx_so';
$primaryKey = 'id_sales';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'sales_order',     'dt' => 0 ),
	array( 'db' => 'so_date',     'dt' => 1 ),
	array( 'db' => 'incoterm',     'dt' => 2 ),
	array( 'db' => 'district',     'dt' => 3 ),
	array( 'db' => 'shipto',     'dt' => 4 ),
	array( 'db' => 'nama_usaha',     'dt' => 5 ),
	array(
		'db'        => 'sales_order',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=up_so&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



