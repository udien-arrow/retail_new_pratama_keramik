<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_l_bisup';
$primaryKey = 'id';
$jenis = 'input';
$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
$b=explode("/",$_GET['b']);
$wp=$b[2]."-".$b[0]."-".$b[1];
if($_GET['sopir']==''){
	$sop="and id_supir like '%%'";		
}else{
	$sop="and id_supir='$_GET[sopir]'";			
}

$where2="id_cabang='$_GET[cab]' AND date(tgl) BETWEEN '$gg' AND '$wp' $sop";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'no_sb', 'dt' => 0 ),
	array( 'db' => 'tgl', 'dt' => 1 ),
	array( 'db' => 'nama_pegawai', 'dt' => 2 ),
	array( 'db' => 'nama_usaha', 'dt' => 3 ),
	array( 'db' => 'nama_truk', 'dt'  => 4),
	array( 'db' => 'nama_barang', 'dt' => 5 ),
	array( 'db' => 'qty', 'dt' => 6 ),
	array(
		'db'        => 'gab',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$a=explode('_',$d);
			$s=number_format($a[1]);
			return "
			<div style='text-align:right'>$s</div>
			<input type='hidden' value='$a[1]' name='hit[]' class='hit' id='hit$a[0]'>
			";
		}
	),
	array(
		'db'        => 'gab',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$a=explode('_',$d);
			if($a[2]==0){
				$dd="<input type='checkbox' name='split[]' id='split$a[0]' class='split' value='$d'>";	
			}else{
				$dd="";
			}
			return "
			<div align='center'>
			$dd
			</div>
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



