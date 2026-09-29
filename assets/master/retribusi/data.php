<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'm_retribusi';
$primaryKey = 'id_retribusi';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_retribusi',     'dt' => 0 ),
	array( 'db' => 'nama_retribusi',     'dt' => 1 ),
	array(
		'db'        => 'st_franco',
		'dt'        => 2,
		'formatter' => function( $d, $row ) {
			if($d==1){
				$hh=" icon-checkmark4";
				}else{
					$hh="icon-cross2";
					}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)'  class='$hh' ></a></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'st_locco',
		'dt'        => 3,
		'formatter' => function( $d, $row ) {
			if($d==1){
				$hh=" icon-checkmark4";
				}else{
					$hh="icon-cross2";
					}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)'  class='$hh' ></a></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'st_da',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			if($d==1){
				$hh=" icon-checkmark4";
				}else{
					$hh="icon-cross2";
					}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)'  class='$hh' ></a></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'id_retribusi',
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
	).');';
}



