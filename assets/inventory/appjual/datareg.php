<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
//sales level
	foreach($db->select("m_regional","id_wilayah","id_pegawai='$_SESSION[ID_PEG]'")as $haha);
	$where2="status_so='0' and id_cabang in (select id_cabang from m_cabang where id_wilayah_pem='$haha[id_wilayah]')";
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
					$ak="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=appjualreg&id=$exp[0]' class=' icon-folder-open' style='cursor:pointer'></a></li>";	
				}
				return "<ul class='icons-list'>
				$ak
				<input type='hidden' name='jenis_p2[]' id='jenis_p2$exp[1]' value='$exp[1]'>
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



