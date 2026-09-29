<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_penjualan_dtl';
$primaryKey = 'id_dtl_jual';
$jenis = 'view';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];

if($_GET['jenis']=='2'){
	
$where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and jenis_jual='$_GET[jenis_jual]'";
}
else if($_GET['jenis']=='3'){
	
$where2="date(tgl_penjualan) BETWEEN '$gg' AND '$wp' and jenis_bayar='$_GET[jenis_bayar]'";
}

$limit="";
$columns = array(
	array( 'db' => 'no_penjualan', 'dt' => 0 ),
	array( 'db' => 'tgl_penjualan', 'dt' => 1 ),
	array( 'db' => 'id_customer', 'dt' => 2 ),
	array( 'db' => 'jenis_jual', 
	       'dt'  => 3,
		   'formatter' => function( $d, $row ) {
			if($d==1){
				$d='Retail';
			}elseif($d==2){
				$d='Grosir';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='$d' ></button></li>
			</ul>
			"; }  
		   ),
	array( 'db' => 'jenis_bayar', 
		   'dt' => 4 ,
		   'formatter' => function( $d, $row ) {
			if($d==1){
				$d='Langsung';
			}elseif($d==2){
				$d='Kredit';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-info' value='$d' ></button></li>
			</ul>
			"; }
		   ),
	array( 'db' => 'nama_barang', 'dt' => 5 ),
	array( 'db' => 'qty_jual', 'dt' => 6 ),
	array( 'db' => 'harga_jual', 
		   'dt' => 7 
		   ),
	array( 'db' => 'discprs', 'dt' => 8 ),
	array( 'db' => 'discrp', 'dt' => 9 ),
	array( 'db'  => 'total_jual','dt'  => 10)
	
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



