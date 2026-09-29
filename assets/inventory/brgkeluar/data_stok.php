<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_brgkeluar_transit';
$primaryKey = 'id_keluar';
$jenis = 'view';
$where2="id_gudang='$_SESSION[ID_GUDANG]'";
$limit="";
$columns = array(
	array( 'db' => 'no_keluar',     'dt' => 0 ),
	array( 'db' => 'darigudang',     'dt' => 1 ),
	array( 'db' => 'kegudang',     'dt' => 2 ),
	array( 'db' => 'tgl',     'dt' => 3 ),
	array(
		'db'        => 'status',
		'dt'        => 4,
		'formatter' => function( $d, $row ) 
		{
			if($d==0){
				$d='Belum(BM)';
				$h='danger';
			}elseif($d==1){
				$d='Sudah(BM)';
				$h='info';
			}elseif($d==2){
				$d='Tolak(BM)';
				$h='danger';
			}elseif($d==3){
				$d='Sudah Terima';
				$h='success';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>";
		}
	),
	array(
		'db'        => 'gud',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$ds=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=brgkeluar&id=$ds[0]') class='icon-printer2' style='cursor:pointer'></a></li>
			<li>
			<a href='javascript:void(0)' onclick=window.location='index.php?x=brgkeluar_v&id=$ds[0]&gudang=$ds[1]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



