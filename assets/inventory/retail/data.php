<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_penjualan';
$primaryKey = 'id_pj';
$jenis = 'table';
$where2="id_user='$_SESSION[ID_LOGIN]' and void_jual is null ";
$limit="";
$columns = array(
	array( 'db' => 'no_penjualan',     'dt' => 0 ),
	array( 'db' => 'tgl_penjualan',     'dt' => 1 ),
		array(
			'db'        => 'grantot_jual',
			'dt'        => 2,
			'formatter' => function( $d, $row ) {
				$k=number_format($d);
				return "
					$k
				";
			}
		),
	array('db'        => 'username', 'dt'  => 3),
	array(
		'db'        => 'jenis_jual',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==1){
			$s="retail";
			}elseif($d==2){
			$s="Grosir";
			}
			return "$s
			";
		}
	),		
	array(
		'db'        => 'id_pj',
		'dt'        =>5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=retail&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



