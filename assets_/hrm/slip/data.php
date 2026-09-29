<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_slip';
$primaryKey = 'id';
$jenis = 'input';
$where2="tahun='$_GET[tahun]' and bulan='$_GET[bulan]'";
$limit="";
$columns = array(
	array( 'db' => 'nik',     'dt' => 0),
	array( 'db' => 'nama_pegawai',     'dt' => 1 ),
	array( 'db' => 'id_aktif',     'dt' => 2,
			'formatter' => function( $d, $row ) {
			if($d==1){
				$d="Aktif";	
			}
			return "
			$d
			";
		} ),
	array( 'db' => 'nama_kontrak',     'dt' => 3 ),
	array( 'db' => 'pangkat',     'dt' => 4 ),
	array( 'db' => 'st_jabatan',     'dt' => 5 ),
	array( 'db' => 'tingkat_golongan',     'dt' => 6 ),	
	array( 'db' => 'statuskel',     'dt' => 7 ),	
	array( 'db' => 'nama_cabang',     'dt' => 8 ),	
	array( 'db' => 'jumlah_kotor',     'dt' => 9,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'jumlah_terima',     'dt' => 10,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array(
		'db'        => 'gab',
		'dt'        => 11,
		'formatter' => function( $d, $row ) {
			$d=explode("_",$d);
			if($d[1]==0){
				$e="Belum ACC";	
			}elseif($d[1]==1){
				$e="<div align='center'><ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=slip&id=$d[0]&jenis=1') class='icon-printer2' style='cursor:pointer'></a></li>
			</ul>
			</div>";	
			}
			return "
			$e
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
