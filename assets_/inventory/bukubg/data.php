<?php
require( '../../../webclass.php' );
session_start();
$db=new kelas;
$table = 'v_buku_bg';
$primaryKey = 'id_buku';
$jenis = 'view';
$where2="id_cabang='$_SESSION[ID_CABANG]' and status='0'";
$limit="";
$columns = array(
	array( 'db' => 'nama_usaha',     'dt' => 0 ),
	array( 'db' => 'no_spj',     'dt' => 1 ),
	array( 'db' => 'no_fj',     'dt' => 2 ),
	array( 'db' => 'no_seribg',     'dt' => 3 ),
	array(
		'db'        => 'nilai_bg',
		'dt'        => 4,
		'formatter' => function( $d, $row ) {
			$a=number_format($d);
			return "$a
			";
		}
	),
	array( 'db' => 'no_seribg',     'dt' => 5 ),
	array( 'db' => 'jatuh_tempo',     'dt' => 6 ),
	array(
		'db'        => 'gab',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			return "<select name='jenisbg[]' id='jenisbg$exp[0]'>
                                      <option value='1'>Cair</option>
									  <option value='2'>Blonk</option>  
                                    </select>
			";
		}
	),
	array(
		'db'        => 'gab',
		'dt'        => 8,
		'formatter' => function( $d, $row ) {
			$exp=explode("_",$d);
			return "<ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='tambah($exp[0])' class='icon-add' style='cursor:pointer'></a>
			<input type='hidden' id='gab$exp[0]' value='$d'>
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



