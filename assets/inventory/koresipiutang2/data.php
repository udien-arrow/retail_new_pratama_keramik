<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_piutang2';
$primaryKey = 'id_spj';
$jenis = 'input';
$exp=explode("_",$_GET['id']);
$where2="no_spj='$exp[1]' and no_spj NOT IN (SELECT no_piutang FROM tx_koreksi_tmp) and status='1'";
$limit="limit 0,10000";
$columns = array(
	array( 'db' => 'no_faktur_jual',     'dt' => 0 ),
	array( 'db' => 'no_spj',     'dt' => 1 ),
	array( 'db' => 'tgl_spj',     'dt' => 2 ),
	array(
			'db'        => 'gab',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$exp=explode("_",$d);
				//$d=number_format($exp[1]);
				return "<input type='text' name='hargaasli[]' style='height:27px; width:80px;' id='hargaasli$exp[0]' class='form-control hargab' autocomplete='off' value='$exp[1]' required readonly>
				";
			}
		),
	array(
			'db'        => 'id_spj',
			'dt'        => 4,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='ganti[]' style='height:27px; width:80px;' id='ganti$d' class='form-control hargab' autocomplete='off' value='' required>
				<script>forma()</script>
				";
			}
		),
	array(
			'db'        => 'id_spj',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				return "<input type='text' name='ket[]' style='height:27px; width:80px;' id='keterangan$d' class='form-control' autocomplete='off' value='' required>
				";
			}
		),	
	array(
		'db'        => 'id_spj',
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



