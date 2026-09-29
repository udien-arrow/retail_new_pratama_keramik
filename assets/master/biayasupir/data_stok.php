<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_m_biayasupir';
$primaryKey = 'id';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id',     'dt' => 0 ),
	array( 'db' => 'nama_pegawai',     'dt' => 1 ),
	array( 'db' => 'nama_cabang',     'dt' => 2 ),
	array(
		'db'        => 'con',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$dnj=explode("_",$d);
			return "<ul class='icons-list'>
			<li>
			<a href='javascript:void(0)' onclick=window.location='index.php?x=biayasup_v&id=$dnj[2]' class='icon-folder-open' style='cursor:pointer'></a></li>
			<li>
			<a href='javascript:void(0)' onclick=window.location='index.php?x=biayasup&id=$dnj[0]&cabang=$dnj[1]&kod=$dnj[0]' class='icon-pencil7' style='cursor:pointer'></a>
			</li>
			<li>
			<a href='javascript:void(0)' onclick='hapus($dnj[0],$dnj[1],$dnj[2])' class='icon-trash' style='cursor:pointer'></a>
			</li>
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



