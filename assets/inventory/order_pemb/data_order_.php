<?php
error_reporting(0);
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_order';
$primaryKey = 'id_order';
$jenis = 'view';
$where2="id_user='$_SESSION[ID_LOGIN]' and (jenis='4' or jenis='5')";
$limit="";
$columns = array(
	array( 'db' => 'no_order',     'dt' => 0 ),
	array( 'db' => 'tgl',     'dt' => 1 ),
	array( 'db' => 'nama_daerah',     'dt' => 2 ),
	array( 'db' => 'nama_gudang',     'dt' => 3 ),
	array(
		'db'        => 'gw',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$st=explode("_",$d);
			if($st[0]==3 ){
				$d='Belum(MGR)';
				$h='info';
			}elseif($st[0]==6){
				$d='Belum(AVP)';
				$h='info';
			}elseif($st[0]==7){
				$d='Belum(VP)';
				$h='info';
			}elseif($st[0]==8){
				$d='Belum(DIR)';
				$h='info';
			}elseif($st[0]==9){
				$d='Belum(HRD)';
				$h='info';
			}elseif($st[0]==10){
				$d='Belum(TRANSPORTASI)';
				$h='info';
			}elseif($st[0]==5){
				$d='Diterima';
				$h='success';
			}elseif($st[0]==0){
				$d='Sudah';
				$h='success';
			}
			return "<ul class='icons-list'>
			<li class='text-primary-200'><input style='height:25px; line-height: 0;' type='button' class='btn btn-$h' value='$d' ></button></li>
			</ul>
			";
		}
	),
	array(
		'db'        => 'sta',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$s=explode("_",$d);
			if($s[1]=='3'){
			$c="";	
			}else{
			$c="<a href='javascript:void(0)' onClick=window.open('cetak.php?page=ordernon&id=$s[0]') class='icon-printer2' style='cursor:pointer'></a>";	
			}
			return "
			<ul class='icons-list'>
			<li class='text-primary-200'>$c</li>
			<li class='text-primary-200'><a href='javascript:void(0)' onClick=window.location='index.php?x=orderpemn_v&id=$s[0]' class=' icon-folder-open' style='cursor:pointer'></a></li>
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



