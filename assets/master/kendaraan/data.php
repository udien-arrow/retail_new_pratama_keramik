<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_kendaraan';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nia',     'dt' => 0 ),
	array( 'db' => 'nopol',     'dt' => 1 ),
	array( 'db' => 'nik',     'dt' => 2 ),
	array( 'db' => 'nama',     'dt' => 3 ),
	array( 'db' => 'tahunbuat',     'dt' => 4 ),
	array( 'db' => 'nomesin',     'dt' => 5 ),
	array( 'db' => 'nosasis',     'dt' => 6 ),
	array( 'db' => 'stnk',     'dt' => 7 ),
	array( 'db' => 'nama_cabang',     'dt' => 8 ),
	array( 'db' => 'nama_pegawai',     'dt' => 9 ),
	array(
		'db'        => 'jenis_angkutan',
		'dt'        => 10,
		'formatter' => function( $d, $row ) {
			if($d==1){$a="Expeditur";}else{$a="Reguler";}
			return "$a
			";
		}
	),
	array( 'db' => 'km',     'dt' => 11 ),
	array( 'db' => 'muatan',     'dt' => 12 ),
	array(
		'db'        => 'id',
		'dt'        => 13,
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



