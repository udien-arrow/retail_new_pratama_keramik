<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
//if($_GET['cabang']<>''){
$table = 'v_m_biayasupir_edit';
$primaryKey = 'id';
$jenis = 'input';
$where2="id_cabang='$_GET[cabang]'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array(
			'db'        => 'dn',
			'dt'        => 2,
			'formatter' => function( $d, $row ) {
			$dnj=explode("_",$d);
				return "<input type='text' name='biaya[]' style='height:27px; width:100px;' id='biaya$dnj[1]' class='form-control' autocomplete='off' value='$dnj[1]'>
				<input type='hidden' name='kirim[]' style='height:27px; width:60px;' id='kirim[0]' class='form-control' autocomplete='off' value='$d'>
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
