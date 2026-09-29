<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_pengbum_v';
$primaryKey = 'id_pengbum';
$jenis = 'view';
$where2="id_user='$_SESSION[ID_LOGIN]'";
$limit="";
$columns = array(
	array( 'db' => 'no_pengbum',     'dt' => 0 ),
	array( 'db' => 'nama_gudang',     'dt' => 1 ),
	array( 'db' => 'tgl',     'dt' => 2 ),
	array( 'db' => 'duedate',     'dt' => 3 ),
	array(
		'db'        => 'status',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
			}elseif($d==1){
				$d='Sudah(BM)';
			}elseif($d==3){
				$d='Sudah(GD)';
			}elseif($d==2){
				$d='Tolak(BM)';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_pengbum',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=pengbum&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=pengbum_kel_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



