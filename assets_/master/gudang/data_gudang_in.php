<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_barang';
$primaryKey = 'id_barang';
$jenis = 'input';
$where2="id_barang not in (select id_barang from m_barang_gudang where id_gudang='$_GET[id]') and kode_barang!=''";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<input type='text' name='min[]' style='height:27px; width:50px;' id='min$d' class='form-control' autocomplete='off' value='0' required>
			<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'id_barang',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<input type='text' name='max[]' style='height:27px; width:50px;' id='max$d' class='form-control' autocomplete='off' value='0' required>
			";
		}
	),
	array(
		'db'        => 'tipe',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			if($d==1){$d="Dagang";}if($d==2){$d="Non";}
			return "
					<span class='btn btn-warning' style='height:27px; ';>$d</span>
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



