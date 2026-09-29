<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
//==========================jenissssssssssssssss tidak 3======================================================================
	$table = 'v_ordexp';
	$primaryKey = 'id_expediture';
	$jenis = 'input';
	$where2="id_supp='$_GET[id]' and id_expediture not in(select id_expediture from ex_order_tagihan_tmp) and id_expediture not in(select id_expediture from ex_order_tagihan_dtl)";
	$limit="limit 0,10000";
	$columns = array(
		array(
			'db'        => 'no_expediture',
			'dt'        => 0,
			'formatter' => function( $d, $row ) {
				$bar= ucfirst(strtolower($d));
				return "
					$bar
				";
			}
		),
		array('db'      => 'tgl','dt'        => 1),
		array('db'        => 'no_so','dt'        => 2),
		array('db'        => 'no_spj','dt'        => 3),
		array('db'        => 'lokasi_kirim','dt'        => 4),
		array(
			'db'        => 'total_ao',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$k=number_format($d);
				return "
					$k
				";
			}
		),
		array(
			'db'        => 'gab',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				return "<ul class='icons-list'>
				<li class='text-primary-200'><a href='javascript:void(0)' onclick=tambah('$d') class='icon-add' style='cursor:pointer'></a></li>
				</ul>
				<input type='hidden' name='nobil[]' value='$d'>
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where2, $jenis, $limit )
	).');';
}



