<?php
require( '../../../webclass.php' );
$db=new kelas;
		$table = "v_biaya_retribusi_dtl";
		$primaryKey = "id_dtl";
		$jenis = 'view';
		$where2="id_biaya='$_GET[id]' and tgl_berlaku='$_GET[tgl]'";
		$limit="";
		$columns = array(
			array( 'db' => 'nama_retribusi',     'dt' => 0 ),
			array( 'db' => 'nilai',     'dt' => 1 ),
			array( 'db' => 'tgl_berlaku',     'dt' => 2 )
			
		);
		$sql_details = array(
			
		);
		$jsonp = preg_match('/^[$A-Z_][0-9A-Z_$]*$/i', $_GET['callback']) ?
			$_GET['callback'] :
			false;
		if ( $jsonp ) {
			echo $jsonp.'('.json_encode(
				kelas::simple( $_POST, $sql_details, $table, $primaryKey, $columns , $where2, $jenis, $limit)
			).');';
		}

