<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_ex_order_tag';
$primaryKey = 'id_pt';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];

$where2="tgl_pt BETWEEN '$gg' AND '$wp'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'no_pt', 'dt' => 0 ),
	array(
		'db'        => 'tgl_pt',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$s=date("d-m-Y",strtotime($d));
			return "
			$s
			";
		}
	),
	array( 'db' => 'nama_usaha', 'dt' => 2 ),
	array(
		'db'        => 'gab',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$a=explode('_',$d);
			$s=number_format($a[1]);
			return "
			<div style='text-align:right'>$s</div>
			<input type='hidden' value='$a[1]' name='hit[]' class='hit' id='hit$a[0]'>
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



