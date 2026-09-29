<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_notif';
$primaryKey = 'id';
$jenis = 'view';
$where2="id_gudang='$_GET[gud]'";
$limit="";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array(
		'db'        => 'nama_satuan',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array( 'db' => 'min',     'dt' => 3 ),
	array( 'db' => 'max',     'dt' => 4 ),
	array(
		'db'        => 'akhir',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			$d
			";
		}
	),
	array(
		'db'        => 'stat',
		'dt'        => 6,
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
		'db'        => 'hpp',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$d=number_format($d,2);
			return "
			$d
			";
		}
	),
	array(
		'db'        => 'persediaan',
		'dt'        => 8,
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
		'dt'        => 9,
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



