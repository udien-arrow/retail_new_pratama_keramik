<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'tm_kas';
$primaryKey = 'id_kas';
$jenis = 'table';
$where2="ID_PEG='$_SESSION[ID_LOGIN]'";
$limit="";
$columns = array(
	array( 'db' => 'NO_KAS',     'dt' => 0 ),
	array( 'db' => 'TGL1',     'dt' => 1 ),
	array( 'db' => 'TGL2',     'dt' => 2 ),	
		array(
			'db'        => 'SETOR_KAS',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
				$k=number_format($d);
				return "
					$k
				";
			}
		),
	array( 'db' => 'ID_MEJA',     'dt' => 4 ),	
	array(
		'db'        => 'ID_KAS',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=\"window.location='index.php?x=closing&id=$d'\" class='icon-folder-open' style='cursor:pointer' title='Lihat Detil'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=\"window.open('cetak.php?page=closing&id=$d', '_blank')\" class='icon-printer2' style='cursor:pointer' title='Cetak PDF'></a></li>
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



