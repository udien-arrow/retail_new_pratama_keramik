<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
if($_GET['jenis']==1){
$table = 'v_app_transit';
$primaryKey = 'id_dtl';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_transit='$exp[0]' and id_barang NOT IN (SELECT id_barang FROM tx_brg_keluar_tmp WHERE ke_gudang = '$exp[1]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$gud=$_SESSION['ID_GUDANG'];
			return "
			<span class='form-control' name='tes[]' style='height:27px; width:50px;padding: 3px 12px' id='tes$d'><script>$('#tes$d').load('assets/inventory/transit/mutasi.php?id=$d&gud=$gud');</script></span>
			";
		}
	),
	array(
			'db'        => 'ace',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
			$ex=explode("_",$d);
				return "<input type='text' name='qty_minta[]' style='height:27px; width:60px;' id='qty_minta$ex[0]' class='form-control' autocomplete='off' value='$ex[1]' required readonly>
				";
			}
		),
	array(
			'db'        => 'ace',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$ex=explode("_",$d);
				return "<input type='text' name='qty_beri[]' style='height:27px; width:60px;' id='qty_beri$ex[0]' class='form-control' autocomplete='off' value='$ex[1]' required>
				";
			}
		),
	array(
		'db'        => 'ace',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$_GET['id']);
			$ac=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($ac[0])' class='icon-add' style='cursor:pointer'></a></li>
			<input type='hidden' name='id_gud' style='height:27px; width:50px;' id='id_gud' class='form-control' autocomplete='off' value='$exp[1]' required>
			<input type='hidden' name='id_barang[]' style='height:27px; width:50px;' id='id_barang$ac[0]' class='form-control' autocomplete='off' value='$ac[0]' required>
			<input type='hidden' name='hpp[]' style='height:27px; width:50px;' id='hpp$ac[0]' class='form-control' autocomplete='off' value='$ac[2]' required>
			<input type='hidden' name='satuan[]' style='height:27px; width:50px;' id='satuan$ac[0]' class='form-control' autocomplete='off' value='$ac[3]' required>
			</ul>
			";
		}
	)
	
);
}elseif($_GET['jenis']==2){	
$table = 'v_pengbum_b';
$primaryKey = 'id_dtl';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_pengbum='$exp[0]' and sn NOT IN (SELECT sn FROM tx_brg_keluar_tmp WHERE ke_gudang = '$exp[1]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array( 'db' => 'akhir',     'dt' => 3 ),
	array(
			'db'        => 'ace',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
			$ex=explode("_",$d);
				return "<input type='text' name='qty_minta[]' style='height:27px; width:60px;' id='qty_minta$ex[0]' class='form-control' autocomplete='off' value='$ex[1]' required readonly>
				";
			}
		),
	array(
			'db'        => 'ace',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$ex=explode("_",$d);
				return "<input type='text' name='qty_beri[]' style='height:27px; width:60px;' id='qty_beri$ex[0]' class='form-control' autocomplete='off' value='$ex[1]' required>
				";
			}
		),
	array(
			'db'        => 'fu',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				$ex=explode("_",$d);
				return "<input type='text' name='nopol[]' style='height:27px; width:60px;' id='nopol$ex[0]' class='form-control' autocomplete='off' value='$ex[1]' readonly>
				";
			}
		),
	array(
			'db'        => 'fu',
			'dt'        => 7,
			'formatter' => function( $d, $row ) {
				$ex=explode("_",$d);
				return "<input type='text' name='sn[]' style='height:27px; width:60px;' id='sn$ex[0]' class='form-control' autocomplete='off' value='$ex[2]' readonly>
				<input type='hidden' name='tipe' style='height:27px; width:60px;' id='tipe$ex[0]' class='form-control' autocomplete='off' value='$ex[3]' readonly>
				";
			}
		),
	array(
		'db'        => 'ace',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$_GET['id']);
			$ac=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($ac[0])' class='icon-add' style='cursor:pointer'></a></li>
			<input type='hidden' name='id_gud' style='height:27px; width:50px;' id='id_gud' class='form-control' autocomplete='off' value='$exp[1]' required>
			<input type='hidden' name='id_barang[]' style='height:27px; width:50px;' id='id_barang$ac[0]' class='form-control' autocomplete='off' value='$ac[0]' required>
			<input type='hidden' name='hpp[]' style='height:27px; width:50px;' id='hpp$ac[0]' class='form-control' autocomplete='off' value='$ac[2]' required>
			<input type='hidden' name='satuan[]' style='height:27px; width:50px;' id='satuan$ac[0]' class='form-control' autocomplete='off' value='$ac[3]' required>
			</ul>
			";
		}
	)
	
);
}
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



