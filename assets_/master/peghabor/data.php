<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_pegawai_habor';
$primaryKey = 'id';
$jenis = 'view';
$where2="jenis<3 and status='0'";
$limit="";
$columns = array(
	array( 'db' => 'nama_pegawai',     'dt' => 0 ),
	array( 'db' => 'nama_jabatan',     'dt' => 1 ),
	array( 'db' => 'nama_kontrak',     'dt' => 2 ),
	array( 'db' => 'tgl_mulai',     'dt' => 3 ),
	array( 'db' => 'no_ktp',     'dt' => 4 ),
	
	array( 'db' => 'alamat',     'dt' => 5 ),
	array( 'db' => 'jenis',     'dt' => 6,
			'formatter' => function( $d, $row ) {
			if($d==1){$a="Input";}else{$a="Resign";}
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-info' value='$a' ></button></li>
			</ul>
			";
			}
	 ),
	array(
		'db'        => 'id',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
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



