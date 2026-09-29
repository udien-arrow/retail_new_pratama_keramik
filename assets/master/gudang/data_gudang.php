<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_barang_gudang';
$primaryKey = 'id_barang';
$jenis = 'view';
$where2="id_gudang='$_GET[id]'";
$limit="";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array( 'db' => 'min',     'dt' => 3 ),
	array( 'db' => 'max',     'dt' => 4 ),
	array(
		'db'        => 'status',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			if($d==1){$d="Aktif";}else{$d="Tidak Aktif";}
			return "
					<span class='btn btn-warning' style='height:27px; ';>$d</span>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus_bar($d)' style='cursor:pointer' class='icon-trash'></a></li>
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



