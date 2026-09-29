<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'kas_kecil';
$primaryKey = 'ID';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'ID',     'dt' => 0 ),
	array( 'db' => 'NO',     'dt' => 1 ),
	array( 'db' => 'TANGGAL', 'dt' => 2 ,
		'formatter' => function( $d, $row ) {
			$s=date('d-m-Y',strtotime($d));
			return "
			$s
			
			";
		} ),	
	array( 'db' => 'TANGGAL_SETOR', 'dt' => 3 ,
		'formatter' => function( $d, $row ) {
			if ($d != ''){
			$s=date('d-m-Y',strtotime($d));}
			else{
			$s = 'blm setor';
			}
			return "
			$s
			";
		} ),	
	array(
		'db'        => 'NOMINAL',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$s=number_format($d);
			return "
			<div style='text-align:right'>$s</div>
			
			";
		}
	),	
	array( 'db' => 'SETOR',     'dt' => 5 ),	
	array(
		'db'        => 'SISA',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$s=number_format($d);
			return "
			<div style='text-align:right'>$s</div>
			
			";
		}
	),	
	array(
		'db'        => 'SISA',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			$s=number_format($d);
			return "
			<div style='text-align:right'>$s</div>
			
			";
		}
	),	
	array(
		'db'        => 'STATUS',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			switch ($d){
			case "1" : $s = "Open" ;break;
			case "0" : $s = "Close" ;break;
			}
			return "
			<div style='text-align:right'>$s</div>
			
			";
		}
	),			
	array( 'db' => 'ID',     'dt' => 8 ,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			</ul>
			";
		}	
		)
);
$sql_details = array(
	
);

$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ? $_GET['callback'] : false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



