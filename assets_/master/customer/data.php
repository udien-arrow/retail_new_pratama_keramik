<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_customer';
$primaryKey = 'id_cus';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'kode_cus',     'dt' => 0 ),
	array( 'db' => 'nama_cus',     'dt' => 1 ),
	array( 'db' => 'nama_usaha',     'dt' => 2 ),
	array( 'db' => 'alamat_usaha',     'dt' => 3 ),
	array( 'db' => 'no_telp_usaha',     'dt' => 4 ),
	array( 'db' => 'no_fax',     	'dt' => 5 ),
	array( 'db' => 'nama_cabang',     'dt' => 6 ),
	array(
		'db'        => 'STATUS',
		'dt'        => 7,
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
		'db'        => 'head',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			if($exp[1]!=''){
			$ss="<li class='text-primary-200'><a href='javascript:void(0)' onclick=hapush('$exp[0]') class='icon-upload' style='cursor:pointer'></a></li>";	
			}else{
			$ss="";	
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick=edit('$exp[0]') class='icon-pencil7' style='cursor:pointer'></a></li>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick=hapus('$exp[0]') style='cursor:pointer' class='icon-trash'></a></li>
			$ss		
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



