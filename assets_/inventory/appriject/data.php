<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$dt=$db->select("m_level_app_riject","level","id_jabatan='$_SESSION[ID_JABATAN]'");
foreach($dt as $dtv){}
$lvl=$dtv['level']-1;

$table = 'v_order_rj';
$primaryKey = 'id_sales';
$jenis = 'view';
if($dtv['level']==1){
	$where2="id_cabang='$_SESSION[ID_CABANG]' and status_so='$lvl'";
}elseif($dtv['level']==2){
	$where2="status_so='$lvl'";
}
$limit="";
$columns = array(
	array( 'db' => 'no_sales',     'dt' => 0 ),
	array( 'db' => 'tgl_sales',     'dt' => 1 ),
	array( 'db' => 'nama_gudang',     'dt' => 2 ),
	array( 'db' => 'nama_usaha',     'dt' => 3 ),
	array(
		'db'        => 'gab',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);

			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=appriject&id=$exp[0]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



