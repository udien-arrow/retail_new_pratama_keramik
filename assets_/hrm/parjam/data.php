<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'hr_m_jamsos';
$primaryKey = 'id_jamsos';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_jamsos',     'dt' => 0 ),
	array( 'db' => 'tarif_perusahaan',     'dt' => 1 ),
	array( 'db' => 'umr',     'dt' => 2 ),
	array( 'db' => 'tarif_bayar',     'dt' => 3 ),
	array( 'db' => 'tgl_berlaku',     'dt' => 4 ),
	array(
		'db'        => 'id_jamsos',
		'dt'        => 5,
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
$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
	$_GET['callback'] :
	false;
if ( $jsonp ) {
	echo $jsonp.'('.json_encode(
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis , $limit)
	).');';
}



