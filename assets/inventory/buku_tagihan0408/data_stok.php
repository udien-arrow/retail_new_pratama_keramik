<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'tx_buku_tagihan';
$primaryKey = 'id';
$jenis = 'view';
$where2="id_user='$_SESSION[ID_LOGIN]'";
$limit="";
$columns = array(
	array( 'db' => 'no',     'dt' => 0 ),
	array(
		'db'        => 'tgl',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return "$d";
		}
	),
	array( 'db' => 'ket',     'dt' => 2 ),
	array(
		'db'        => 'status',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
				$h='danger';
			}elseif($d==1){
				$d='SUDAH(BM)';
				$h='success';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=bukta_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



