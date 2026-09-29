<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_tagihan_kem';
$primaryKey = 'id_dtl';
$jenis = 'input';
$where2="no='$_GET[id]' and status='1'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'no_fj',     'dt' => 1 ),
	array( 'db' => 'total_piutang',     'dt' => 2 ),
	array(
			'db'        => 'id_dtl',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty_minta[]' style='height:27px; width:60px;' id='qty_minta$d' class='form-control' autocomplete='off' value='' >
				";
			}
		),
		array(
			'db'        => 'id_dtl',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty_minta[]' style='height:27px; width:60px;' id='qty_minta$d' class='form-control' autocomplete='off' value='' >
				";
			}
		),
		array(
			'db'        => 'id_dtl',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty_minta[]' style='height:27px; width:60px;' id='qty_minta$d' class='form-control' autocomplete='off' value='' >
				";
			}
		),
		array(
			'db'        => 'id_dtl',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty_minta[]' style='height:27px; width:60px;' id='qty_minta$d' class='form-control' autocomplete='off' value='' >
				";
			}
		),
	array(
		'db'        => 'id_dtl',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
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



