<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_bukubg';
$primaryKey = 'id_buku';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_ta',     'dt' => 0 ),
	array( 'db' => 'no_seribg',     'dt' => 1 ),
	array( 'db' => 'id_bank',     'dt' => 2 ),
	array( 'db' => 'no_spj',     'dt' => 3 ),
	array( 'db' => 'nilai_bg',     
		   'dt' => 4 ,
		   'formatter' => function($d,$row) {
			 $d= number_format($d);
			return "$d";
		   }
		  ),
	array( 'db' => 'nama_usaha',     'dt' => 5 ),		  
	array( 'db' => 'tgl_bg',     'dt' => 6 ,
		   'formatter' => function($d,$row) {
			$d=date("d-m-Y",strtotime($d));
			return "$d";
		   }	
	),		  
	array( 'db' => 'st',     'dt' => 7 ),		  
	array(
		'db'        => 'id_buku',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis , $limit)
	).');';
}



