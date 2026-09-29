<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_do_v';
$primaryKey = 'id_do';
$jenis = 'view';
$where2="id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_do',     'dt' => 0 ),
	array( 'db' => 'nama_gudang',     'dt' => 1 ),
	array( 'db' => 'no_reff',     'dt' => 2 ),
	array(
		'db'        => 'status_do',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
				$h='danger';
			}elseif($d==1){
				$d='Sudah(BM)';
				$h='success';
			}elseif($d==2){
				$d='Sudah Dikeluarkan';
				$h='info';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'gud',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$ds=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'>
			<a href='index.php?x=delivo_c&id=$ds[0]&gudang=$ds[1]' target='_blank'  class='icon-printer2' style='cursor:pointer'></a></li>
			<li>
			<a href='javascript:void(0)' onclick=window.location='index.php?x=delivo_v&id=$ds[0]&gudang=$ds[1]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



