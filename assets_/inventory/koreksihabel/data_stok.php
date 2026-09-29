<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_korhabel';


$primaryKey = 'id_koreksi';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_koreksi',     'dt' => 0 ),
	array( 'db' => 'tgl_koreksi',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array(
		'db'        => 'status',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==0){
					$d="Belum";
					}elseif($d==1){
					$d="Sudah";	
					}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='$d' ></button></li>
			</ul>";
		}
	),
	array(
		'db'        => 'no_koreksi',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='Detil' onClick=window.location='index.php?x=korhabel_v&id=$d'></button></li>
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



