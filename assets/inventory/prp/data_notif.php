<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_notif';
$primaryKey = 'id';
$jenis = 'view';
$where2="id_gudang='$_GET[gud]' and min>=ifnull(akhir,0) and id_barang not in (select id_barang from tx_prp_notif where id_gudang='$_GET[gud]')"; 
$limit="";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array(
		'db'        => 'id_barang',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			return "
				<input type='hidden' name='idbar[]' style='height:27px; width:50px;' id='qty$d' class='form-control' autocomplete='off' value='$d' required>
				<select name='sat[]' id='sat$d'  style='height:27px; width:80px; bprp: 1px solid #DDD' class='select-search' onChange='satuan2($d,this.value)'>
				      <option value='' selected>-pilih-</option>                	 
				</select>
				<script>satuan($d)</script>
			";
		}
	),
	array( 'db' => 'min',     'dt' => 3 ),
	array( 'db' => 'max',     'dt' => 4 ),
	array(
		'db'        => 'akhir',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' style='height:27px; width:70px;' id='qty_akhir$d' class='form-control' autocomplete='off' value='$d' readonly>
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



