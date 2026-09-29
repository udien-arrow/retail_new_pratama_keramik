<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'tx_retur_pem';
$primaryKey = 'id_retur';
$jenis = 'view';
$where2="id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_retur',     'dt' => 0 ),
	array(
		'db'        => 'no_ref',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return "<a href='index.php?x=brg_masuk_v&id=$d'>$d</a>";
		}
	),
	array( 'db' => 'tgl_retur',     'dt' => 2 ),
	array(
		'db'        => 'status',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
				$h='danger';
			}elseif($d==1){
				$d='Sudah(BM)';
				$h='info';
			}elseif($d==2){
				$d='Tolak(BM)';
				$h='danger';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>";
		}
	),
	array(
		'db'        => 'no_retur',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
		 	<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=retur_c&id=$d' class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='index.php?x=retur_v&id=$d' class='icon-folder-open' style='cursor:pointer'></a></li>
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



