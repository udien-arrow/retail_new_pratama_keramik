<?php
require( '../../../webclass.php' );
$db=new kelas;
if($_GET['jen']=='1'){
		$table = 'm_fakturpajak';
		$primaryKey = 'no_faktur';
		$jenis = 'view';
		$where2=" status=0";
		
		$limit="";
		$columns = array(
			array( 'db' => 'no_faktur',     'dt' => 0 ),
			array( 'db' => 'tgl',     'dt' => 1 )
			
		);
		$sql_details = array(
			
		);
		$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
			$_GET['callback'] :
			false;
		if( $jsonp ) {
			echo $jsonp.'('.json_encode(
				kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
			).');';
		}
}elseif($_GET['jen']=='2'){
		$table = 'v_fakturpakai';
		$primaryKey = 'no_faktur';
		$jenis = 'view';
		$where2=" status=1";
		$limit="";
		$columns = array(
			array( 'db' => 'no_faktur',     'dt' => 0 ),
			array( 'db' => 'tgl',     'dt' => 1 ),
			array( 'db' => 'no_spj',     'dt' => 2 ),
			array( 'db' => 'nama_cabang',     'dt' => 3 )
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
	
}



