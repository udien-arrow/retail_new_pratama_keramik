<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_order_tag';
$primaryKey = 'id_pt';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_pt',     'dt' => 0 ),
	array( 'db' => 'tgl_pt',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array(
		'db'        => 'total_tag',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'status',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(ACC)';
				$h='success';
			}elseif($d==1){
				$d='Sudah';
				$h='info';
			}elseif($d==3){
				$d='Sudah(MA)';
				$h='info';
			}elseif($d==2){
				$d='Sudah(ACC)';
				$h='info';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_pt2',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$aa=explode("_",$d);
			if($aa[1]==2){
				$dd="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=order_pemb&id=$aa[0]') class='icon-printer2' style='cursor:pointer'></a></li>";	
			}elseif($aa[1]==1){
				$dd="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=order_pemb2&id=$aa[0]') class='icon-printer2' style='cursor:pointer'></a></li>";	
			}
			return "
			<ul class='icons-list'>
			$dd
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=order-pemb_v&id=$aa[0]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



