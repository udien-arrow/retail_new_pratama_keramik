<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_ex_order_tag';
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
				$d='Belum(KEU)';
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
		'db'        => 'no_pt',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=ordexp&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=ordexp_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



