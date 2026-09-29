<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;

	$table = 'v_tkbm';
	$primaryKey = 'id_barang';
	$jenis = 'view';
	$where2="id_cabang='$_GET[cabang]'";
	$limit="";
	$columns = array(
		array( 'db' => 'kode_barang',     'dt' => 0 ),
		array( 'db' => 'nama_barang',     'dt' => 1 ),
		array(
				'db'        => 'gab',
				'dt'        => 2,
				'formatter' => function( $d, $row ) {
					$exp=explode("_",$d);
					return "<input type='text' name='bongkar[]' style='height:27px; width:100px;'  class='form-control' autocomplete='off' value='$exp[1]'>
					<input type='hidden' name='barang[]' style='height:27px; width:60px;' class='form-control' autocomplete='off' value='$exp[0]' required>
					<input type='hidden' name='idtkbm[]' style='height:27px; width:60px;' class='form-control' autocomplete='off' value='$exp[2]' required>
					
				";
				}
			),
		array(
				'db'        => 'nilai_muat',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
					$exp=explode("_",$d);
					return "<input type='text' name='muat[]' style='height:27px; width:100px;'  class='form-control' autocomplete='off' value='$d'>
					
				";
				}
			),
		array(
				'db'        => 'nilai_pok',
				'dt'        => 4,
				'formatter' => function( $d, $row ) {
					$exp=explode("_",$d);
					return "<input type='text' name='pok[]' style='height:27px; width:100px;'  class='form-control' autocomplete='off' value='$d'>
					
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
