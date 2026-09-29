<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_dtl_bayar';
$primaryKey = 'id';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];
if($_GET['cab']=='0' || $_GET['cab']=='99' || $_GET['cab']=='all'){
$where2="date(tgl_bayar) BETWEEN '$gg' AND '$wp'";
}else{
$where2="id_cabang='$_GET[cab]' AND date(tgl_bayar) BETWEEN '$gg' AND '$wp'";
}
//echo"select * from $table where $where2";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'nama_cabang', 'dt' => 0 ),
	array( 'db' => 'kode_cus', 'dt' => 1 ),
	array( 'db' => 'nama_usaha', 'dt' => 2 ),
	array( 'db' => 'no_faktur', 'dt' => 3),
	array( 'db' => 'no_tk', 'dt' => 4 ),
	array( 'db' => 'no_ref', 'dt' => 5 ),
	array( 'db' => 'jenis_pembayaran', 'dt' => 6 ),
	array( 'db' => 'tgl_bayar', 'dt' => 7 ,
		'formatter' => function( $d, $row ) {
			$s=date('d-m-Y',strtotime($d));
			return "
			$s
			
			";
		} ),
	array(
		'db'        => 'total_dibayar',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$s=number_format($d);
			return "
			<div style='text-align:right'>$s</div>
			
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



