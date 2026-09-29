<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
//==========================jenissssssssssssssss tidak 3======================================================================
	$table = 'v_billing';
	$primaryKey = 'id_billing';
	$jenis = 'view';
	$where2="sta=0 and id_supp='$_GET[id]' and no_billing NOT IN (select no_billing from tx_order_tagihan_tmp) and ifnull(no_spj,'') not in (select no_spj from tx_order_tagihan_dtl) group by no_billing";
	$limit="";
	$columns = array(
		array(
			'db'        => 'no_billing',
			'dt'        => 0,
			'formatter' => function( $d, $row ) {
				$bar= ucfirst(strtolower($d));
				return "
					$bar
					
				";
			}
		),
		array('db'      => 'tgl','dt'        => 1),
		array(
			'db'        => 'no_ref',
			'dt'        => 2,
			'formatter' => function( $d, $row ) {
				return "
				$d
				";
			}
		),
		array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				$e= number_format($exp[2],2);
				return "
					$e
					
				";
			}
		),
		array(
			'db'        => 'gab',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				return "<ul class='icons-list'>
				<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($exp[0])' class='icon-add' style='cursor:pointer'></a></li>
				</ul>
				<input type='hidden' name='idbil[]' id='idbil$exp[0]' value='$exp[0]'>
				<input type='hidden' name='nobil[]' id='nobil$exp[0]' value='$exp[1]'>
				<input type='hidden' name='totalbil[]' id='totalbil$exp[0]' value='$exp[2]'>
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



