<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_bbm';
$primaryKey = 'id_bbm';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'id_bbm',     'dt' => 0 ),
	array( 'db' => 'nama_cabang',     'dt' => 1 ),
	array( 'db' => 'keterangan',     'dt' => 2 ),
	array(
				'db'        => 'id_bbm',
				'dt'        => 3,
				'formatter' => function( $d, $row ) {
					//return date( 'jS M y', strtotime($d));
					return "<div align='center'>
					<a href='index.php?x=hargabbm&slug=1&id=$d' class=' label label-primary' style='cursor:pointer'>Detil Harga</a>
					</div>
					";
				}
			),
	array(
		'db'        => 'id_bbm',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			//return date( 'jS M y', strtotime($d));
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



