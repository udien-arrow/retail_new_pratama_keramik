<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_retur_pen';
$primaryKey = 'id_dtl';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_spj='$exp[0]' and id_barang NOT IN (SELECT id_barang FROM tx_retur_pen_tmp WHERE id_gudang='$exp[2]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$sc=explode("_",$d);
				return "<input type='text' name='qty_terima[]' style='height:27px; width:60px;' id='qty_terima$sc[0]' class='form-control' autocomplete='off' value='$sc[1]' required readonly>
				<input type='hidden' name='hpp[]' style='height:27px; width:60px;' id='hpp$sc[0]' class='form-control' autocomplete='off' value='$sc[3]' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$sc[0]' class='form-control' autocomplete='off' value='$sc[5]' required readonly>
				<input type='hidden' name='hargajual[]' style='height:27px; width:60px;' id='hargajual$sc[0]' class='form-control' autocomplete='off' value='$sc[2]' required readonly>
				<input type='hidden' name='cus' style='height:27px; width:60px;' id='cus$sc[0]' class='form-control' autocomplete='off' value='$sc[4]' required readonly>
				";
			}
		),
	array(
			'db'        => 'id_barang',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty_kembali[]' style='height:27px; width:60px;' id='qty_kembali$d' class='form-control' autocomplete='off' value='' required>
				<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang' class='form-control' autocomplete='off' value='$d' required readonly>
				
				
				";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='keterangan[]' style='height:27px; width:60px;' id='keterangan$d' class='form-control' autocomplete='off' value='' required>
				
				";
			}
		),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
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



