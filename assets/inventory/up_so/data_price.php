<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'tx_upload_so';
$primaryKey = 'id_up';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_up',     'dt' => 0 ),
	array( 'db' => 'kode_up',     'dt' => 1 ),
	array( 'db' => 'tgl_upload',     'dt' => 2 ),
	array(
		'db'        => 'id_up',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-danger' value='Detil' onClick=window.location='index.php?x=up_so_v&id=$d'></button></li>
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



