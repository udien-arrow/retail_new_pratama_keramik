<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_ex_pricelist';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'lokasi_kirim',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array(
		'db'        => 'tarif_oa',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			$g=number_format($d);
			return "$g
			";
		}
	),
	array(
		'db'        => 'gaji_sopir',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$g=number_format($d);
			return "$g
			";
		}
	),
	array(
		'db'        => 'gaji_kernet',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$g=number_format($d);
			return "$g
			";
		}
	),
	array(
		'db'        => 'ujs',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$g=number_format($d);
			return "$g
			";
		}
	),
	array( 'db' => 'km',     'dt' => 6 ),
	array(
		'db'        => 'kosongan',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$g=number_format($d);
			return "$g
			";
		}
	),
	array(
		'db'        => 'premi',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$g=number_format($d);
			return "$g
			";
		}
	),
	array(
		'db'        => 'tgl_berlaku',
		'dt'        => 9,
		'formatter' => function( $d, $row ) {
			return "$d
			";
		}
	),
	array(
		'db'        => 'status',
		'dt'        => 10,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Belum';
				$h='info';
			}elseif($d==1){
				$d='Sudah';
				$h='success';
			}elseif($d==2){
				$d='Tolak';
				$h='danger';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'id',
		'dt'        => 11,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
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



