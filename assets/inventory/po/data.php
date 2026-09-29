<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_po';
$primaryKey = 'id_po';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'no_po',     'dt' => 0 ),
	array( 'db' => 'no_prp',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array(
		'db'        => 'tgl_po',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			$d=date("d-m-Y",strtotime($d));
			return "
				$d
			";
		}
	),
	array( 'db' => 'nama_gudang',     'dt' => 4 ),
	array(
		'db'        => 'gab',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			$nopo=$exp[0];
			$noso=$exp[1];
			if($noso==''){
				$so="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=po&id=$d' class='  icon-file-plus' style='cursor:pointer'></a></li>";	
			}else{
				$so="<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=po&id=$d' class='  icon-files-empty' style='cursor:pointer'></a></li>";	
			}
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.open('cetak.php?page=po&id=$nopo') class='icon-printer2' style='cursor:pointer'></a></li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=po&id=$nopo' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



