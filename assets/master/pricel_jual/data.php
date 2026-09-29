<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_price_jual';
$primaryKey = 'id_barang';
$jenis = 'view';
$where2="id_cabang='$_GET[cab]' group by id_barang";
$limit="limit 0,0"; 
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	//array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
		'db'        => 'id_barang',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				<select name='sat[]' id='sat$d'  style='height:27px; width:70px; border: 1px solid #DDD' onChange='hitung($d)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuan($d)</script>
			";
		}
	),
	array(
		'db'        => 'hpp',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$dt=explode("-",$d);
			$harga=number_format($dt[0]);			
			return "<input type='text' align='right' name='hpp[]' style='height:27px; width:60px' id='hpp$dt[1]' class='form-control' autocomplete='off' value='$harga' readonly >
			<input type='hidden' name='hpp_h$d' style='height:27px; width:60px;' id='hpp_h$dt[1]' class='form-control' autocomplete='off' value='$harga' readonly>
			";
		}
	),
	array(
		'db'        => 'harga_retail',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$dt=explode("-",$d);
			$harga=number_format($dt[0]);

			return "<input type='text' align='right' name='harga[]' style='height:27px; width:60px;' id='harga$dt[2]' class='form-control' autocomplete='off' value='$harga' required>
			<input type='hidden' name='harga_h$d' style='height:27px; width:60px;' id='harga_h$dt[2]' class='form-control' autocomplete='off' value='$harga' required>
			";
		}
	),
	array(
		'db'        => 'harga_retail',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$dt=explode("-",$d);			
			$harga=number_format($dt[1]);

			return "<input type='text' name='harga_cetak[]' style='height:27px; width:60px;' id='harga_cetak$dt[2]' class='form-control' autocomplete='off' value='$harga'>
			<input type='hidden' name='harga_cetak_h$d' style='height:27px; width:60px;' id='harga_cetak_h$dt[2]' class='form-control' autocomplete='off' value='$harga' required>

			";
		}
	),
	array(
		'db'        => 'harga_grosir',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			$dt=explode("-",$d);
			$harga=number_format($dt[0]);

			return "<input type='text' name='harga2[]' style='height:27px; width:60px;' id='harga2$dt[2]' class='form-control' autocomplete='off' value='$harga' required>
			<input type='hidden' name='harga_h2$d' style='height:27px; width:60px;' id='harga_h2$dt[2]' class='form-control' autocomplete='off' value='$harga' required>
			";
		}
	),
	array(
		'db'        => 'harga_grosir',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$dt=explode("-",$d);
			$harga=number_format($dt[1]);

			return "<input type='text' name='harga_cetak2[]' style='height:27px; width:60px;' id='harga_cetak2$dt[2]' class='form-control' autocomplete='off' value='$harga'>
			<input type='hidden' name='harga_cetak_h2$d' style='height:27px; width:60px;' id='harga_cetak_h2$dt[2]' class='form-control' autocomplete='off' value='$harga' required>

			";
		}
	),	
	array(
		'db'        => 'id_barang',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($d)' class='icon-add' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datapelanggan' onClick='cekPel($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			</ul>
			<input type='hidden' name='idbar[]' style='height:27px; width:60px;' id='idbar[]' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	)
);
$sql_details = array(
	
);
//echo "select * from $table where $where2";
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



