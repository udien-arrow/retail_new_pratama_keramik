<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_order_bm';
$primaryKey = 'id_order';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_order',     'dt' => 0 ),
	array( 'db' => 'tgl',     'dt' => 1 ),
	array( 'db' => 'no_spj',     'dt' => 2 ),
	array( 'db' => 'nama_usaha',     'dt' => 3 ),
	array(
		'db'        => 'status',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
				$h='success';
			}elseif($d==1){
				$d='Belum(PO)';
				$h='info';
			}elseif($d==2){
				$d='Sudah';
				$h='warning';
			}elseif($d==3){
				$d='Tolak';
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
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)'  class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=order_bm_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



