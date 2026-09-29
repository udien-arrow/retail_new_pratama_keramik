<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'm_umur';
$primaryKey = 'id_aging';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'nama_aging',     'dt' => 0 ),
	array(
				'db'        => 'jenis',
				'dt'        => 1,
				'formatter' => function( $d, $row ) {
					if($d==1){
						$d="Piutang Usaha";	
					}elseif($d==2){
						$d="Hutang";	
					}elseif($d==3){
						$d="Piutang Angkutan";		
					}
					return "
					$d
					";
				}
			),
	array(
				'db'        => 'id_aging',
				'dt'        => 2,
				'formatter' => function( $d, $row ) {
					
					return "<div align='center'>
					<a href='index.php?x=umuraging&slug=1&id=$d' class=' label label-primary' style='cursor:pointer'>Detil Umur</a>
					</div>
					";
				}
			),
	array(
		'db'        => 'id_aging',
		'dt'        => 3,
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



