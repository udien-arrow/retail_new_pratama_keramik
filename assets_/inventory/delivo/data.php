<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_do_dtl';
$primaryKey = 'id_dtl';
$jenis = 'input';
$exps=explode("_",$_GET['id']);
$where2="no_sales='$exps[0]' and id_barang NOT IN (SELECT id_barang FROM tx_do_tmp WHERE id_gudang = '$exps[1]')";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'kode_barang',     'dt' => 0 ),
	array( 'db' => 'nama_barang',     'dt' => 1 ),
	array( 'db' => 'nama_satuan',     'dt' => 2 ),
	array(
			'db'        => 'ace',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$e=explode("_",$d);
				return "<input type='text' name='qty[]' style='height:27px; width:60px;' id='qty$e[0]' class='form-control' autocomplete='off' value='$e[1]' required readonly>
				<input type='hidden' name='satuan[]' style='height:27px; width:60px;' id='satuan$e[0]' class='form-control' autocomplete='off' value='$e[2]' required readonly>
				<input type='hidden' name='harga[]' style='height:27px; width:60px;' id='harga$e[0]' class='form-control' autocomplete='off' value='$e[3]' required readonly>
				<input type='hidden' name='brg[]' style='height:27px; width:60px;' id='brg$e[0]' class='form-control' autocomplete='off' value='$e[0]' required readonly>
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



