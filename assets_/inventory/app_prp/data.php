<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_prp_app';
$primaryKey = 'id_prp';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_prp',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array(
		'db'        => 'tgl',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$d=date("d-m-Y",strtotime($d));
			return "
				$d
			";
		}
	),
	array( 'db' => 'nama_gudang',     'dt' => 3 ),
	array(
		'db'        => 'gab',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$exp=explode('_',$d);
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_prp&id=$exp[0]&no=$exp[2]' class=' icon-folder-open' style='cursor:pointer'></a></li>
			</ul>
			<input type='hidden' name='jenis_p2[]' id='jenis_p2$exp[2]' value='$exp[1]'>
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



