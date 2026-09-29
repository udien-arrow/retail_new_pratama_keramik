<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_tkbmjual';
$primaryKey = 'id_dtl';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_spj='$exp[0]'";
$limit="limit 0,10000";
if($_GET['jenis']!=3){
	$columns = array(
		array( 'db' => 'kode_barang',     'dt' => 0 ),
		array( 'db' => 'nama_barang',     'dt' => 1 ),
		array( 'db' => 'nama_satuan',     'dt' => 2 ),
		array( 'db' => 'qty',     'dt' => 3 ),
		array(
				'db'        => 'id_barang',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
					return "<input type='text' name='qty_bongkar[]' style='height:27px; width:60px;' id=qty_bongkar$d class='form-control' autocomplete='off' value='' required>
					";
				}
			),
		array( 'db' => 'berat',     'dt' => 5 ),
		array(
			'db'        => 'gab',
			'dt'        => 6,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				return "<ul class='icons-list'>
				<li class='text-primary-200'><a href='javascript:void(0)' onclick=tambah('$exp[0]') class='icon-add' style='cursor:pointer'></a></li>
				<input type='hidden' name='gab[]' style='height:27px; width:50px;' id='gab$exp[0]' class='form-control' autocomplete='off' value='$d' required>
				</ul>
				";
			}
		)	
	);
}if($_GET['jenis']==3){
	$columns = array(
		array( 'db' => 'kode_barang',     'dt' => 0 ),
		array( 'db' => 'nama_barang',     'dt' => 1 ),
		array( 'db' => 'nama_satuan',     'dt' => 2 ),
		array(
		'db'        => 'id_barang',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "
				<select name='nomas[]' onChange='ambilqty(this.value,$d)' id='nomas$d'  style='height:27px; width:70px; border: 1px solid #DDD'>
				</select>
				<script>masuk($d)</script>
			";
		}
	),
		array( 'db' => 'qty',     'dt' => 4 ),
		array(
				'db'        => 'id_barang',
				'dt'        => 5,
				'formatter' => function( $d, $row ) {
					return "<input type='text' name='qty_bongkar[]' style='height:27px; width:60px;' id=qty_bongkar$d class='form-control' autocomplete='off' value='' required>
					";
				}
			),
		array( 'db' => 'berat',     'dt' => 6 ),
		array(
			'db'        => 'gab',
			'dt'        => 7,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				return "<ul class='icons-list'>
				<li class='text-primary-200'><a href='javascript:void(0)' onclick=tambah('$exp[0]') class='icon-add' style='cursor:pointer'></a></li>
				<input type='hidden' name='gab[]' style='height:27px; width:50px;' id='gab$exp[0]' class='form-control' autocomplete='off' value='$d' required>
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



