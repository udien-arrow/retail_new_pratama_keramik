<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
//sales level
$dt=$db->select("m_level_app_sales","level","id_jabatan='$_SESSION[ID_JABATAN]'");
foreach($dt as $dtv){}
$lvl=$dtv['level']-1;
//end lvl
if($lvl==2){ //jika bao
	$table = 'tx_sales_biaya';
	$primaryKey = 'no_sb';
	$jenis = 'view';
	$where2="(id_cabang='$_SESSION[ID_CABANG]' and id_cabang_direct is null and no_sb not in (select no_ref from tx_sales_spb) ) or (id_cabang_direct='$_SESSION[ID_CABANG]' and no_sb not in (select no_ref from tx_sales_spb)) ";
	$limit="";
	$columns = array(
		array( 'db' => 'no_sb',     'dt' => 0 ),
		array(
			'db'        => 'tgl',
			'dt'        => 1,
			'formatter' => function( $d, $row ) {
				$d=date("d-m-Y",strtotime($d));
				return "
					$d
				";
			}
		),
		array( 'db' => 'jenis_jual',     'dt' => 2 ),
		array(
			'db'        => 'no_sb',
			'dt'        => 3,
			'formatter' => function( $d, $row ) {
					$ak="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=appjual&id=$d' class=' icon-folder-open' style='cursor:pointer'></a></li>";	
				return "<ul class='icons-list'>
				$ak
				";
			}
		)
	);
}else{
	if($lvl==0){
		$tam="and no_sales not in (select no_sales from tx_sales_direct)";
		$where2="status_so='0' and id_cabang='$_SESSION[ID_CABANG]' $tam";
	}elseif($lvl==1){
		$tam="and jenis<>'DA' and (id_cabang_direct='' and status_so='1' and no_sales not in (select no_so from tx_sales_biaya_tmp)) or (id_cabang_direct='$_SESSION[ID_CABANG]' and status_so='1') and no_sales not in (select no_so from tx_sales_biaya_tmp)";
		$where2="id_cabang='$_SESSION[ID_CABANG]' $tam";
	}
	$table = 'v_sales_app';
	$primaryKey = 'id_sales';
	$jenis = 'view';
	
	$limit="";
	$columns = array(
		array( 'db' => 'no_sales',     'dt' => 0 ),
		array( 'db' => 'nama_gudang',     'dt' => 1 ),
		array(
			'db'        => 'tgl_sales',
			'dt'        => 2,
			'formatter' => function( $d, $row ) {
				$d=date("d-m-Y",strtotime($d));
				return "
					$d
				";
			}
		),
		array( 'db' => 'jenis',     'dt' => 3 ),
		array( 'db' => 'nama_usaha',     'dt' => 4 ),
		array(
			'db'        => 'gab',
			'dt'        => 5,
			'formatter' => function( $d, $row ) {
				$exp=explode('_',$d);
				if($exp[2]==1){
					$ak="<li class='text-primary-200'><a href='javascript:void(0)' onclick=tambah('$d') class=' icon-add' style='cursor:pointer'></a></li>";	
				}else{
					$ak="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=appjual&id=$exp[0]' class=' icon-folder-open' style='cursor:pointer'></a></li>";	
				}
				return "<ul class='icons-list'>
				$ak
				<input type='hidden' name='jenis_p2[]' id='jenis_p2$exp[1]' value='$exp[1]'>
				";
			}
		)
	);
}//eeend iff
	
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



