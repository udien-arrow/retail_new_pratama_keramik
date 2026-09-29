<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_buku_bg';
$primaryKey = 'id_buku';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]' and status='1'";
$limit="";
$columns = array(
  	array( 'db' => 'no_ta',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array( 'db' => 'no_spj',     'dt' => 2 ),
	array( 'db' => 'no_fj',     'dt' => 3 ),
	array( 'db' => 'no_seribg',     'dt' => 4 ),
	array(
		'db'        => 'nilai_bg',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$a=number_format($d);
			return "$a
			";
		}
	),
	array( 'db' => 'no_seribg',     'dt' => 6 ),
	array( 'db' => 'jatuh_tempo',     'dt' => 7 ),
	array(
		'db'        => 'jenis_bg',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			if($d==1){
				$d="Cair";	
			}elseif($d==2){
				$d="Blonk";
			}
			return "
			$d
			";
		}
	),
	array(
		'db'        => 'gab',
		'dt'        => 9,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			if($exp[4]==1){
				$e="<input type='button' class='button' value='Blonk' name='blonkan' id='blonkan' onClick=roll('$exp[5]')>";	
			}elseif($exp[4]==2){
				$e="";
			}
			return "
			$e
			<input type='hidden' name='idbuku[]' id='idbuku$exp[5]' value='$d'>
			
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



