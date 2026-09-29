<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_pricelist';
$primaryKey = 'id_supp';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'kode_supp',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array( 'db' => 'no_telp_usaha',     'dt' => 2 ),
	array( 'db' => 'no_fax',     'dt' => 3 ),
	array(
		'db'        => 'id_supp',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-danger' value='Detil' onClick=window.location='index.php?x=pricel_v&id=$d'></button></li>
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



