<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;

$dt=$db->select("m_level_app_pm","level","id_jabatan='$_SESSION[ID_JABATAN]'");
foreach($dt as $dtv){}
$lvl=$dtv['level']-1;
$table = 'v_order_bm';
$primaryKey = 'id_order';
$jenis = 'view';
if($dtv['level']==1){
	$where2="id_cabang='$_SESSION[ID_CABANG]' and status='$lvl'";
}elseif($dtv['level']==2){
	$where2="status='$lvl'";
}
$limit="";
$columns = array(
	array( 'db' => 'no_order',     'dt' => 0 ),
	array( 'db' => 'tgl',     'dt' => 1 ),
	array( 'db' => 'no_spj',     'dt' => 2 ),
	array( 'db' => 'nama_gudang',     'dt' => 3 ),
	array( 'db' => 'nama_usaha',     'dt' => 4 ),
	array(
		'db'        => 'gab',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);

			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=app_pm&id=$exp[0]' class=' icon-folder-open' style='cursor:pointer'></a></li>
			
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=apptolak('$exp[2]') class=' icon-folder-remove' style='cursor:pointer'></a></li>
			</ul>
			<input type='hidden' name='sta[]' id='sta$exp[2]' value='$exp[1]'>
			<input type='hidden' name='no_order[]' id='no_order$exp[2]' value='$exp[0]'>
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



