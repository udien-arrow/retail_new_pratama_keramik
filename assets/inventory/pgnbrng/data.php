<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;

$a=explode("/",$_GET['a']);
$gg=$a[2]."-".$a[0]."-".$a[1];
//$b=explode("/",$_GET['b']);
//$wp=$b[2]."-".$b[0]."-".$b[1];
$gudang = $_SESSION['ID_GUDANG'];

$table = 'v_pngbrng';
$primaryKey = 'id_barang';
$jenis = 'input';
$where2="tgl BETWEEN '$gg' AND '$gg' AND id_gudang=$gudang";
//$where2="";
$limit="limit 0,10000";
$columns = array(
	//array( 'db' => 'id_barang', 'dt' => 0 ),
	//array( 'db' => 'id_gudang', 'dt' => 1 ),
	array( 'db' => 'nama_barang', 'dt' => 0 ),
	array( 'db' => 'tgl', 'dt'  => 1),
	array( 'db' => 'nama_satuan', 'dt'  => 2),
	array( 'db' => 'aa', 
		   'dt'  => 3,
		   'formatter' => function( $d, $row ) {
			$ex=explode("_",$d);
			return "<input type='text' name='qty_masuk[]' id='qty_masuk$ex[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off' value='$ex[4]' readonly>
			";
		}
	),
	array(
		'db'        => 'aa',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$ex=explode("_",$d);
			return "<input type='text' name='sisa[]' id='sisa$ex[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off'>
			";
		}
	),
	array(
		'db'        => 'aa',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$ex=explode("_",$d);
			return "<input type='text' name='waste[]' id='waste$ex[0]' style='height:27px; width:80px;'  class='form-control ' autocomplete='off'>
			<input type='hidden' name='id_barang[]' style='height:27px; width:50px;' id='id_barang$ex[0]' class='form-control' autocomplete='off' value='$ex[0]' required>
			<input type='hidden' name='hpp[]' style='height:27px; width:50px;' id='hpp$ex[0]' class='form-control' autocomplete='off' value='$ex[2]' required>
			<input type='hidden' name='id_satuan[]' style='height:27px; width:50px;' id='id_satuan$ex[0]' class='form-control' autocomplete='off' value='$ex[3]' required>
			<input type='hidden' name='akhir[]' style='height:27px; width:50px;' id='akhir$ex[0]' class='form-control' autocomplete='off' value='$ex[4]' required>

			";
		}
	),
	array(
		'db'        => 'aa',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			$ex=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($ex[0])' class='icon-add' style='cursor:pointer'></a></li>
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



