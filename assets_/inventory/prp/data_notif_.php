
<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
if($_GET[jenis]==2 && $_GET[spb]!=''){
	$table = 'v_barang_order';
	$jenis = 'input';
	$where2="id_barang in(select id_barang from tx_order_dtl where no_order='$_GET[spb]') and id_barang not in(select id_barang from tx_prp_tmp where no_order='$_GET[spb]')";
	$limit="limit 0,100";
}else{
	$table = 'v_barang_order';
	$jenis = 'input';
	$where2="";
	$limit="limit 0,0";
}
$primaryKey = 'id_barang';
$columns = array(
	array(
		'db'        => 'kode_barang',
		'dt'        => 0,
		'formatter' => function( $d, $row ) {
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'nama_barang',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				<select name='sat[]' id='sat$d'  style='height:27px; width:50px; bprp: 1px solid #DDD' class='select-search' onChange='satuan2($d,this.value)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuan($d,'')</script>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty_minta[]' style='height:27px; width:40px;' id='qty_minta$d' class='form-control' autocomplete='off' value='' readonly>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty[]' style='height:27px; width:40px;' id='qty$d' class='form-control' autocomplete='off' value='' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='bonus[]' style='height:27px; width:40px;' id='bonus$d' class='form-control' autocomplete='off' value=''>
			<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='harga[]' style='height:27px; width:70px;' id='harga$d' class='form-control' autocomplete='off' value='' required>
			<input type='hidden' name='harga_asli[]' style='height:27px; width:80px;' id='harga_asli$d' class='form-control' autocomplete='off' value='' required>
			
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='disc[]' style='height:27px; width:40px;' id='disc$d' class='form-control' autocomplete='off' value=''>
			";
		}
	),
	
	array(
		'db'        => 'id_barang',
		'dt'        => 8,
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





