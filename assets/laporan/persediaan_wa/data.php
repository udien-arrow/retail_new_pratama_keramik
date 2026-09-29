<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_notif';
$primaryKey = 'id';
$jenis = 'view';
if($_GET['gud']=='all'){
	$guda="tipe=1";
}else{
	$guda="id_gudang='$_GET[gud]' and tipe=1";
}

$where2="$guda";
$limit="";
$columns = array(
	array( 'db' => 'nama_gudang',     'dt' => 0 ),
	array( 'db' => 'kode_barang',     'dt' => 1 ),
	array( 'db' => 'nama_barang',     'dt' => 2 ),
	array(
		'db'        => 'nama_satuan',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array( 'db' => 'min',     'dt' => 4 ),
	array( 'db' => 'max',     'dt' => 5 ),
	array(
		'db'        => 'akhir',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			$d
			";
		}
	),
	array(
		'db'        => 'stat',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			if($d<=0){
				$a='warning';
			}else{
				$a='primary';
				}
			return "<ul class='icons-list'>
			<li class='text-$a'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$a' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'persediaan',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$c=explode("_",$d);
			$s=$c[1];
			$s=number_format($s,2);
			return "
			$s
			";
		}
	),
	array(
		'db'        => 'persediaan',
		'dt'        => 9,
		'formatter' => function( $d, $row ) {
			$c=explode("_",$d);
			$s=$c[0]*$c[1];
			$s=number_format($s,2);
			return "
			$s
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 10,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' onclick='mutas($d)' class='btn btn-info' value='Mutasi' ></button></li>
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



