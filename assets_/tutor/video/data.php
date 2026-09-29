<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'r_tutor';
$primaryKey = 'id';
$jenis = 'view';
$where2="jenis='video'";
$limit="";
$columns = array(
	array( 'db' => 'nama',     'dt' => 0 ),
	array(
		'db'        => 'id',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='view($d)' class='icon-video-camera' style='cursor:pointer'></a></li>
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



