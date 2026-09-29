<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_prp';
$primaryKey = 'id_prp';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_prp',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array(
		'db'        => 'tgl',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$d=date("d-m-Y",strtotime($d));
			return "
				$d
			";
		}
	),
	array( 'db' => 'nama_gudang',     'dt' => 3 ),
	array(
		'db'        => 'status',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum';
				$c='success';
			}elseif($d==1){
				$d='Sudah';
				$c='info';
			}elseif($d==2){
				$d='Tolak';
				$c='danger';
			}elseif($d==3){
				$d='Void';
				$c='danger';
			}elseif($d==8){
				$d='Tolak Revisi';
				$c='danger';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$c' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_prp',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=prp&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=prp_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



