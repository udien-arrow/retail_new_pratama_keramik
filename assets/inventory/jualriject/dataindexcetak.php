<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
//==========================jenissssssssssssssss tidak 3======================================================================
	$table = 'v_barang_order';
	$primaryKey = 'id_barang';
	$jenis = 'input';
	$where2="id_dep='$_GET[jen]' and id_gudang='$_GET[gud]' and id_barang not in(select id_barang from tx_sales_order_tmp where id_gudang='$_GET[gud]')";
	$limit="limit 0,0";
	$columns = array(
		array(
			'db'        => 'nama_barang',
			'dt'        => 0,
			'formatter' => function( $d, $row ) {
				$bar= ucfirst(strtolower($d));
				return "
					$bar
				";
			}
		),
		array(
			'db'        => 'gab',
			'dt'        => 1,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				return "
					<input type='hidden' name='sat[]' style='height:27px; width:60px;' id='sat$exp[0]' class='form-control' autocomplete='off' value='$exp[1]' required>
					$exp[2]
				";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 2,
			'formatter' => function( $d, $row ) {
						$gud=$_GET['gud'];
				
				return "
				<span class='form-control' style='height:27px; width:60px;padding: 3px 12px' id='tes$d'><script>$('#tes$d').load('assets/inventory/salesorder/mutasi.php?id=$d&gud=$gud');</script></span>
				";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				return "<span class='form-control' style='height:27px; width:60px;padding: 3px 2px' id='tes2$d'><script>$('#tes2$d').load('assets/inventory/salesorder/hargapatok.php?id=$d&gud=$gud');</script></span>
				
			";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='harga[]' style='height:27px; width:60px;' id='harga$d' class='form-control' autocomplete='off' value='' required>
			";
			}
		),
		array(
			'db'        => 'id_barang',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='qty[]' style='height:27px; width:60px;' id='qty$d' class='form-control' autocomplete='off' value='' required>
				<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='idbar$d' class='form-control' autocomplete='off' value='$d' required>
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where2, $jenis, $limit )
	).');';
}



