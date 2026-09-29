<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_barang';
$primaryKey = 'id_barang';
$jenis = 'view';
$where2="kode_barang!=''";
$limit="";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'kode_barang_lama',     'dt' => 1 ),
	array( 'db' => 'nama_barang',     'dt' => 2 ),
	array( 'db' => 'nama_satuan',     'dt' => 3 ),
	array( 'db' => 'nama_dep',     'dt' => 4 ),
	array( 'db' => 'nama_sub',     'dt' => 5 ),
	array( 'db' => 'nama_kat',     'dt' => 6 ),
	array(
		'db'        => 'tipe',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			if($d==1){$d='Barang Dagang';}else{$d='Non Dagang';}
			return "
				$d
			";
		}
	),
	array( 'db' => 'kode_barang_semen',     'dt' => 8 ),
	array( 'db' => 'namacv',     'dt' => 9 ),
	array(
		'db'        => 'status',
		'dt'        => 10,
		'formatter' => function( $d, $row ) {
			if($d==0){$d='Tidak Aktif';}else{$d='Aktif';}
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 11,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=barang_c&id=$d' class='icon-printer2' style='cursor:pointer'></a></li>
			</ul>
			";
		}
	),
	
);
$sql_details = array(
	
);
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis , $limit)
	).');';
}



