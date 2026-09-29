<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'am_katagori';
$primaryKey = 'ID_AKATAGORI';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'NAMA_AKATAGORI',     'dt' => 0 ),
	array(
		'db'        => 'STATUS_AKATAGORI',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			if($d==1){
				$k="Aktif";}else{
				 $k="Tidak Aktif"; }
			return "$k
			";
		}
	),
	array( 'db' => 'TGL_INPUTAKAT',     'dt' => 2 ),
	array(
		'db'        => 'ID_AKATAGORI',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
			<li class='text-primary-200'><a data-toggle='modal' id='mod' data-target='#datapelanggan' href='javascript:void(0)' onclick='viewdk($d)' class='icon-list' style='cursor:pointer'></a></li>
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



