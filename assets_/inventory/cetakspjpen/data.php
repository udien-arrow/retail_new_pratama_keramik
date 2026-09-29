<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_sales_app';
$primaryKey = 'id_sales';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]' and status_so='3'";
$limit="";
$columns = array(
	array( 'db' => 'no_sales',     'dt' => 0 ),
	array( 'db' => 'tgl_sales',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array(
		'db'        => 'status_so',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==4){
				$d='Sudah Keluar';
				$h='success';
			}elseif($d==3){
				$d='Belum Keluar';
				$h='info';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_sales',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=cetakspj&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



