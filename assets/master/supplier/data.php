<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_supplier';
$primaryKey = 'id_supp';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'kode_supp',     'dt' => 0 ),
	array( 'db' => 'nama_supp',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array( 'db' => 'alamat_usaha',     'dt' => 3 ),
	array( 'db' => 'no_telp_usaha',     'dt' => 4 ),
	array( 'db' => 'no_fax',     'dt' => 5 ),
	array(
		'db'        => 'status',
		'dt'        => 6,
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
		'db'        => 'id_supp',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick=edit('$d') class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick=hapus('$d') style='cursor:pointer' class='icon-trash'></a></li>
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



