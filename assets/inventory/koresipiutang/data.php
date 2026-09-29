<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_piutang3';
$primaryKey = 'id_dtl_jual';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_penjualan='$exp[1]' and id_barang NOT IN (SELECT id_barang FROM tx_koreksi_piutang_tmp) and status='1'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'hargaasli',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$h=explode("_",$d);
				return "<input type='text' name='hargaasli[]' style='height:27px; width:60px;' id='hargaasli$h[0]' class='form-control' autocomplete='off' value='$h[1]' required readonly>
				<input type='hidden' name='qty[]' style='height:27px; width:60px;' id='qty$h[0]' class='form-control' autocomplete='off' value='$h[2]' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$h[0]' class='form-control' autocomplete='off' value='$h[3]' required readonly>
				<input type='hidden' name='hpp[]' style='height:27px; width:60px;' id='hpp$h[0]' class='form-control' autocomplete='off' value='$h[4]' required readonly>";
			}
		),
	array(
			'db'        => 'hargaasli',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				return "<input type='text' name='ganti[]' style='height:27px; width:60px;' id='ganti$d' class='form-control' autocomplete='off' value='$exp[1]' required>
				<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang' class='form-control' autocomplete='off' value='$exp[0]' required readonly>";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='keterangan[]' style='height:27px; width:60px;' id='keterangan$d' class='form-control' autocomplete='off' value='' required>";
			}
		),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			
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



