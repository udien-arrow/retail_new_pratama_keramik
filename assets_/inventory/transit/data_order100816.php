<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_transit';
$primaryKey = 'id_transit';
$jenis = 'view';
$where2="id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_transit',     'dt' => 0 ),
	array( 'db' => 'nama_gudang_tujuan',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array( 'db' => 'duedate',     'dt' => 3 ),
	array(
		'db'        => 'status',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
			}elseif($d==1){
				$d='Belum(GD)';
			}elseif($d==2){
				$d='Tolak(BM)';
			}elseif($d==3){
				$d='Sudah(GD)';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_transit',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=transit_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



