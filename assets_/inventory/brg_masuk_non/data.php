<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_brgmasuk_non';
$primaryKey = 'id_dtl';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_order='$exp[0]' and id_barang ";
$limit="limit 0,10000";
if($exp[2]==5){

$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				$gud=explode("_",$_GET['id']);
				$sd=$diberi[1]-$diberi[3];
				return "<input type='text' name='qty_order[]' style='height:27px; width:60px;' id='qty_order$diberi[0]' class='form-control' autocomplete='off' value='$sd' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$diberi[0]' class='form-control' autocomplete='off' value='$diberi[2]' required readonly>
				<input type='hidden' name='gudan' style='height:27px; width:60px;' id='gudan' class='form-control' autocomplete='off' value='$gud[1]' required readonly>
				";
			}
		),
	array(
			'db'        => 'gab',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				return "<input type='text' name='qty_beli[]' style='height:27px; width:60px;' id='qty_beli$diberi[0]' class='form-control' autocomplete='off' value='1' required>
				<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang' class='form-control' autocomplete='off' value='$d' required readonly>
				
				";
			}
		),
		array(
			'db'        => 'har',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				$s=number_format($diberi[1]);
				return "<input type='text' name='harga[]' style='height:27px; width:50px;' id='harga$diberi[0]' class='form-control' autocomplete='off' value='$s' required readonly>
				";
			}
		),
	array(
			'db'        => 'har',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				$exp=explode("_",$_GET['id']);
				return "<input type='text' name='hargabel[]' style='height:27px; width:50px;' id='hargabel$diberi[0]' class='form-control' autocomplete='off' value='$diberi[1]' required>
				<input type='hidden' name='jenisnya' style='height:27px; width:50px;' id='jenisnya$diberi[0]' class='form-control' autocomplete='off' value='$exp[2]' required>
				";
			}
		),
		
	array(
			'db'        => 'id_barang',
			'dt'        => 7,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='sn[]' style='height:27px; width:70px;' id='sn$d' class='form-control' autocomplete='off' value='' required>
				";
			}
		),
	array(
		'db'        => 'id_barang',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			
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

}else{
	
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				$gud=explode("_",$_GET['id']);
				return "<input type='text' name='qty_order[]' style='height:27px; width:60px;' id='qty_order$diberi[0]' class='form-control' autocomplete='off' value='$diberi[1]' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$diberi[0]' class='form-control' autocomplete='off' value='$diberi[2]' required readonly>
				<input type='hidden' name='gudan' style='height:27px; width:60px;' id='gudan' class='form-control' autocomplete='off' value='$gud[1]' required readonly>
				";
			}
		),
	array(
			'db'        => 'gab',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				return "<input type='text' name='qty_beli[]' style='height:27px; width:60px;' id='qty_beli$diberi[0]' class='form-control' autocomplete='off' value='$diberi[1]' required>
				<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang' class='form-control' autocomplete='off' value='$d' required readonly>
				
				";
			}
		),
		array(
			'db'        => 'har',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				$s=number_format($diberi[1]);
				$exp=explode("_",$_GET['id']);
				return "<input type='text' name='harga[]' style='height:27px; width:100px;' id='harga$diberi[0]' class='form-control' autocomplete='off' value='$s' required readonly>
				<input type='hidden' name='jenisnya' style='height:27px; width:50px;' id='jenisnya$diberi[0]' class='form-control' autocomplete='off' value='$exp[2]' required>
				";
			}
		),
	array(
			'db'        => 'har',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				return "<input type='text' name='hargabel[]' style='height:27px; width:100px;' id='hargabel$diberi[0]' class='form-control' autocomplete='off' value='$diberi[1]' required>
				";
			}
		),
	array(
		'db'        => 'id_barang',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			
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
	
}