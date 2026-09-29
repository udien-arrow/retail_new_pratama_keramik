<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_gudang';
$primaryKey = 'id_gudang';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_gudang',     'dt' => 0 ),
	array( 'db' => 'nama_gudang',     'dt' => 1 ),
	array( 'db' => 'nama_cabang',     'dt' => 2 ),
	array( 'db' => 'telp',     'dt' => 3 ),
	array(
		'db'        => 'id_gudang',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "
					<span class='btn btn-info' style='height:27px;'; onClick='dtlbarang($d)'>Detil Barang</span>
			";
		}
	),
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
		'db'        => 'id_gudang',
		'dt'        => 6,
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



