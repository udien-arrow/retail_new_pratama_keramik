<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_sales_order';
$primaryKey = 'id_sales';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_sales',     'dt' => 0 ),
	array( 'db' => 'tgl_sales',     'dt' => 1 ),
	array( 'db' => 'jenis',     'dt' => 2 ),
	array( 'db' => 'nama_usaha',     'dt' => 3 ),
	array(
		'db'        => 'status_so',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum(BM)';
				$h='success';
			}elseif($d==1){
				$d='Belum(POA)';
				$h='success';
			}elseif($d==2){
				$d='Belum(BAO)';
				$h='success';
			}elseif($d==3){
				$d='Belum(CHK)';
				$h='success';
			}elseif($d==4){
				$d='Sudah(DO)';
				$h='info';
			}elseif($d==6){
				$d='Ditolak';
				$h='danger';
			}elseif($d==7){
				$d='Void';
				$h='danger';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'no_sales',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=salesorder&id=$d') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=salesorder_v&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



