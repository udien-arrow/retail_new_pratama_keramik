<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_biaya_retribusi_supp';
$primaryKey = 'id_biaya';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_gudang',     'dt' => 0 ),
	array( 'db' => 'nama_usaha',     'dt' => 1 ),
	array( 'db' => 'nama',     'dt' => 2 ),
	array(
				'db'        => 'id_biaya',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
					//return date( 'jS M y', strtotime($d));
					return "<div align='center'>
					<a href='index.php?x=biayaretrisupp&slug=1&id=$d' class=' label label-primary' style='cursor:pointer'>Detil Harga</a>
					</div>
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



