<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_barang_pl';
$primaryKey = 'id_barang';
$jenis = 'input';
$where2="";
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
				<select name='sat$d' id='sat$d'  style='height:27px; width:70px; border: 1px solid #DDD' onFocus='satuan($d)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<input type='text' name='harga$d' style='height:27px; width:80px;' id='harga$d' class='form-control' autocomplete='off' value='' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 4,
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



