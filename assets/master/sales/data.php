<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'sales';
$primaryKey = 'ID_SALES';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'ID_SALES',     'dt' => 0 ),
	array( 'db' => 'NAMA_SALES',     'dt' => 1 ),
	array( 'db' => 'ALAMAT_SALES',     'dt' => 2 ),
	array( 'db' => 'TELP_SALES',     'dt' => 3 ),
	array(
		'db'        => 'STATUS_SALES',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==0){
				$d='Non Aktif';
			}elseif($d==1){
				$d='Aktif';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-success' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'ID_SALES',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='edit($d)' class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus($d)' style='cursor:pointer' class='icon-trash'></a></li>
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis , $limit)
	).');';
}



