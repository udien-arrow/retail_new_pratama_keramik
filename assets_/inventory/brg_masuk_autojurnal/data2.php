
<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;
if($_GET['spj']!=''){
	$exp=explode("_",$_GET['spj']);
	$expprp=explode("/",$exp[1]);
	$periode="_".intval(substr($expprp[2],4,2)).substr($expprp[2],0,4);
	$table = "v_spj_rilis";	
	$jenis = 'input';
	$where2 = "id_barang not in(select id_barang from tx_brg_masuk_tmp where no_prp='$exp[1]' and id_gudang='$_SESSION[ID_GUDANG]') and no_spj='$exp[1]' and id_gudang='$_SESSION[ID_GUDANG]'";
	$limit = 'limit 0,1000';
}else{
	$table = "m_barang";	
	$jenis = 'input';
	$where2 = "status=2";
	$limit = 'limit 0,0';
}
$primaryKey = 'id_barang';
$columns = array(
	array('db'      => 'kode_barang','dt'   => 0),
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
	array('db'      => 'nama_satuan','dt'   => 2),
	array(
		'db'        => 'qty_do',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty_pesan[]' style='height:27px; width:40px;' id='qty_pesan$d' class='form-control' autocomplete='off' value='$d' readonly>
			";
		}
	),
	array(
		'db'        => 'qty_bonus',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			
			return "
			<input type='text' name='qty_bonus[]' style='height:27px; width:40px;' id='qty_bonus$d' class='form-control' autocomplete='off' value='$d' readonly>
			";
		}
	),
	array(
		'db'        => 'gabung',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$expl=explode("#",$d);
			return "
			<input type='text' name='qty_terima[]' style='height:27px; width:40px;' id='qty_terima$d' class='form-control' autocomplete='off' value='$expl[5]' readonly>
			<input type='hidden' name='gabung[]' style='height:27px; width:50px;' class='form-control' autocomplete='off' value='$d' required>
			";
		}
	),
	array(
		'db'        => 'qty_bonus',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			return "
			<input type='text' name='claim_utuh[]' style='height:27px; width:40px;' id='claim_utuh$d' class='form-control' autocomplete='off' value='0'>
			";
		}
	),
	array(
		'db'        => 'qty_bonus',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			if($_GET['jenis']==1){
				$re="readonly";
			}else{
				$re="";
			}
			return "
			<input type='text' name='claim_ktg[]' style='height:27px; width:40px;' $re id='claim_ktg$d' class='form-control' autocomplete='off' value='0'>
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





