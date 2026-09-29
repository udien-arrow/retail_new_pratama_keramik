<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_pem_supp';
$primaryKey = 'id_pt';
$jenis = 'view';
$where2="status='1'";
$limit="";
$columns = array(
	array( 'db' => 'no_pt',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array(
		'db'        => 'tgl_pt',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$k=date("d-m-Y",strtotime($d));
			return "$k
			";
		}
	),
	array(
		'db'        => 'no_pt',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
		
			return "<ul class='icons-list'>
		 	
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=pembsupp_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



