<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'hr_m_potongan_opr';
$primaryKey = 'id_jenis';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_jenis',     'dt' => 0 ),
	array( 'db' => 'type',     'dt' => 1, 
		'formatter' => function( $d, $row ) {
				if($d=='1'){
					$d="Potongan";
				}else{
					$d="Operasional";
				}
			return "
				$d
			";
		}
	),
	array(
		'db'        => 'id_jenis',
		'dt'        => 2,
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



