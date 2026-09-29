<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$expl=explode("/",$_GET['so']);
if(substr($expl[0],0,3)=='JWA'){
	$table = 'v_tx_expediture_jwa';
}else{
	$table = 'v_tx_expediture';
}
$primaryKey = 'id_barang';
$jenis = 'input';
$where2="no_so='$_GET[so]' and id_barang NOT IN (select id_barang from ex_expediture_tmp where id_user='$_SESSION[ID_LOGIN]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$c=explode("_",$d);
				return "<input type='text' name='qty_do[]' style='height:27px; width:60px;' id='qty_do$c[0]' class='form-control' autocomplete='off' value='$c[1]' required readonly>
						<input type='hidden' name='berat[]' style='height:27px; width:60px;' id='berat$c[0]' class='form-control' autocomplete='off' value='$c[2]' required readonly>
						<input type='hidden' name='id_barang[]' style='height:27px; width:60px;' id='id_barang$c[0]' class='form-control' autocomplete='off' value='$c[0]' required readonly>
						<input type='hidden' name='id_sat[]' style='height:27px; width:60px;' id='id_sat$c[0]' class='form-control' autocomplete='off' value='$c[3]' required readonly>
						<input type='hidden' name='id_gud[]' style='height:27px; width:60px;' id='id_gud$c[0]' class='form-control' autocomplete='off' value='$c[4]' required readonly>
				";
			}
		),
	array(
		'db'        => 'id_barang',
		'dt'        => 4,
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



