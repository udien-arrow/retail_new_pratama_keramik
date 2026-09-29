<?php
require( '../../../webclass.php' );
$db=new kelas;
session_start();
$table = 'v_stok_opname';
$primaryKey = 'id';
$jenis = 'view';
$where2="id_user='$_SESSION[ID_LOGIN]'";
$limit="";
$columns = array(
	array( 'db' => 'id',     'dt' => 0 ),
	array( 'db' => 'id_stok_opname',     'dt' => 1 ),
	array( 'db' => 'nama_gudang',     'dt' => 2 ),
	array(
		'db'        => 'status',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==0){$k="<font color='red'>Belum Di Setujui</font>";}else{$k="<font color='green'>Sudah Di Setujui</font>";}
			return "$k";
		}
	),
	array(
		'db'        => 'gud',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$ds=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-danger' value='Detil' onClick=window.location='index.php?x=so_v&id=$ds[0]&gudang=$ds[1]'></button></li>
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



