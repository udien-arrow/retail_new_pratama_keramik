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
	array( 'db' => 'gaji_pokok',     'dt' => 9 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_umum',     'dt' => 10 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_repre',     'dt' => 11 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_fungsi',     'dt' => 12 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_presensi',     'dt' => 13 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_penempatan',     'dt' => 14 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_pengabdian',     'dt' => 15 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'ub_notebook',     'dt' => 16 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'ub_komunikasi',     'dt' => 17 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'ub_motor',     'dt' => 18 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'ub_diklat',     'dt' => 19 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'ins_cabang',     'dt' => 20 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'rapel',     'dt' => 21 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'lain2',     'dt' => 22 ),	
	array( 'db' => 'jamsostek_724',     'dt' => 23 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'tunj_sehat',     'dt' => 24 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'potpel_pr',     'dt' => 25 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'potpel_pf',     'dt' => 26 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'potpel_pp',     'dt' => 27 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'jumlah_terima',     'dt' => 28,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} ),
	array( 'db' => 'simpan_pinjam',     'dt' => 29 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'simpanan_wajib',     'dt' => 30 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'pensiun',     'dt' => 31 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'hutang',     'dt' => 32 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'lain2',     'dt' => 33 ),	
	array( 'db' => 'jamsostek_924',     'dt' => 34 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),	
	array( 'db' => 'potbpjssehat',     'dt' => 35 ,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		}),		
	array( 'db' => 'jumlah_kotor',     'dt' => 36,
			'formatter' => function( $d, $row ) {
			$d=number_format($d);
			return "
			<div align='right'>$d</div>
			";
		} )
	
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
