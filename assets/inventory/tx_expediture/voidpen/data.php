<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_sales_order';
$primaryKey = 'id_pj';
$jenis = 'view';
$where2="id_gudang = '$_SESSION[ID_GUDANG]' and  void_jual is null";
$limit="";
$columns = array(
	array( 'db' => 'no_penjualan',     'dt' => 0 ),
	array( 'db' => 'tgl_penjualan',     'dt' => 1 ),
	array(
		'db'        => 'jenis_jual',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			if($d==1){
				$d='Retail';
				$h='-';
			}elseif($d==2){
				$d='Grosir';
				$h='-';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array( 'db' => 'nama_cus',     'dt' => 3 ),
		array(
			'db'        => 'grantot_jual',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				$k=number_format($d);
				return "
					$k
				";
			}
		),	
	array(
		'db'        => 'id_pj',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=voidpen&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



