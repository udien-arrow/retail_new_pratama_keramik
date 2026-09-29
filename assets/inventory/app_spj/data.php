<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;

$dt=$db->select("m_level_app_spj","level","id_jabatan='$_SESSION[ID_JABATAN]'");
foreach($dt as $dtv){}
$lvl=$dtv['level']-1;

$table = 'v_app_spj';
$primaryKey = 'id';
$jenis = 'view';
if($dtv['level']==1){
	$where2="id_cabang='$_SESSION[ID_CABANG]' and status='$lvl'";
}elseif($dtv['level']==2){
	$where2="status='$lvl'";
}else{
	$where2="";
}

$limit="";
$columns = array(
	array( 'db' => 'no_so',     'dt' => 0 ),
	array( 'db' => 'no_spj',     'dt' => 1 ),
	array( 'db' => 'nama_gudang',     'dt' => 2 ),
	array( 'db' => 'ke_nama_gudang',     'dt' => 3 ),
	array( 'db' => 'tgl_relokasi',     'dt' => 4 ),
	array( 'db' => 'nama_barang',     'dt' => 5 ),
	array( 'db' => 'qty_do',     'dt' => 6 ),
	array(
		'db'        => 'gab',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=appsetuju('$exp[0]') class=' icon-folder-check' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=apptolak('$exp[0]') class=' icon-folder-remove' style='cursor:pointer'></a></li>
			</ul>
			<input type='hidden' name='sta[]' id='sta$exp[0]' value='$exp[1]'>
			<input type='hidden' name='spj[]' id='spj$exp[0]' value='$exp[2]'>
			<input type='hidden' name='gud[]' id='gud$exp[0]' value='$exp[3]'>
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



