<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_lap_peg';
$primaryKey = 'id_pegawai';
$jenis = 'input';
if($_GET['cab']=='all'){
$where2="";}
else{
$where2="id_cabang='$_GET[cab]'";
}
$limit="limit 0,1000";
$columns = array(
	array( 'db' => 'nama_pegawai', 'dt' => 0 ),
	array( 'db' => 'nik', 'dt' => 1 ),
	array( 'db' => 'tgl_lahir', 'dt' => 2 ),
	array(
		'db'        => 'jk',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==1)
			{ $s="Laki-Laki";}elseif($d==2){
			$s="Perempuan";}else{ $s="";}
			return "
			$s
			";
		}
	),
	array( 'db' => 'no_ktp', 'dt' => 4 ),
	array( 'db' => 'tgl_mulai', 'dt' => 5 ),
	array( 'db' => 'kode_pendidikan', 'dt' => 6 ),
	array( 'db' => 'npwp', 'dt' => 7),
	array( 'db' => 'email', 'dt' => 8 ),
	array( 'db' => 'no_jamsostek', 'dt' => 9 ),
	array( 'db' => 'nama_jabatan', 'dt' => 10 ),
	array( 'db' => 'st_jabatan', 'dt' => 11 ),
	array( 'db' => 'pangkat', 'dt' => 12 ),
	array( 'db' => 'nama_cabang', 'dt' => 13 ),
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



