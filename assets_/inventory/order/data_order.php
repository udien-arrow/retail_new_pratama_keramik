<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_order';
$primaryKey = 'id_order';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]' and jenis='3' or jenis='1'";
$limit="";
$columns = array(
	array( 'db' => 'no_order',     'dt' => 0 ),
	array( 'db' => 'nama_gudang_tujuan',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array( 'db' => 'nama_daerah',     'dt' => 3 ),
	array( 'db' => 'nama_gudang',     'dt' => 4 ),
	array(
		'db'        => 'STATUS',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(PO)';
				$h='success';
			}elseif($d==1){
				$d='Sudah';
				$h='info';
			}elseif($d==2){
				$d='Void';
				$h='danger';
			}elseif($d==3){
				$d='Belum(BM)';
				$h='success';
			}elseif($d==4){
				$d='Tolak(BM)';
				$h='danger';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_order',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=order_c&id=$d' class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=order_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



