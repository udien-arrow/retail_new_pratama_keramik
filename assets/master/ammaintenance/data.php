<?php
require( '../../../webclass.php' );
$db=new kelas;
$table = 'v_maintasset';
$primaryKey = 'ID_MAINT';
$jenis = 'view';
$where2="";
$limit="";
$columns = array(
	array( 'db' => 'NO_AMM', 'dt' => 0 ),
	array( 'db' => 'ASSET_NAME', 'dt' => 1 ),
	array( 'db' => 'TGL_MAINT', 'dt' => 2 ),
	array( 'db' => 'COMPLETE_MAINT', 'dt' => 3 ),
	array( 'db' => 'KET_MAINT', 'dt' => 4 ),
	array( 'db' => 'COST_MAINT', 'dt' => 5 ),
	array( 'db' => 'ST', 'dt' => 6 ),
	array( 'db' => 'LOKASI', 'dt' => 7 ),
	array( 'db'        => 'gab',
		   'dt'        => 8,
		   'formatter' => function( $d, $row ) {
			   $k=explode('-',$d);
			   if($k[1]==1){
				   $s="<li class='text-danger-200'><a href='javascript:void(0)' onclick='edit($k[0])' style='cursor:pointer' class='icon-pencil'></a></li>";
			   }else{
				   $s="";
				   }
				return "<ul class='icons-list'>
				$s
				
				</ul>
				";
			} 
	),
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



