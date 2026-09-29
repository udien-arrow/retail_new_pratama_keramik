<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_brg_masuk_transit';
$primaryKey = 'id_keluar';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_keluar='$exp[0]' and id_barang NOT IN (SELECT id_barang FROM tx_brg_masuk_tmp WHERE id_gudang = '$exp[1]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'diberi',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				$gud=explode("_",$_GET['id']);
				return "<input type='text' name='qty_diberi[]' style='height:27px; width:60px;' id='qty_diberi$diberi[0]' class='form-control' autocomplete='off' value='$diberi[1]' required readonly>
				<input type='hidden' name='hpp[]' style='height:27px; width:60px;' id='hpp$diberi[0]' class='form-control' autocomplete='off' value='$diberi[2]' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$diberi[0]' class='form-control' autocomplete='off' value='$diberi[3]' required readonly>
				<input type='hidden' name='gudan' style='height:27px; width:60px;' id='gudan' class='form-control' autocomplete='off' value='$gud[1]' required readonly>
				";
			}
		),
	array(
			'db'        => 'diberi',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				$diberi=explode("_",$d);
				return "<input type='text' name='qty_terima[]' style='height:27px; width:60px;' id='qty_terima$diberi[0]' class='form-control' autocomplete='off' value='$diberi[1]' required>
				<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang' class='form-control' autocomplete='off' value='$d' required readonly>
				
				";
			}
		),
	array(
		'db'        => 'id_barang',
		'dt'        => 5,
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



