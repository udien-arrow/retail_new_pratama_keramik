<?php
session_start();
error_reporting(0);
require( '../../../webclass.php' );
$db=new kelas;

	//$periode="_".intval(substr($expprp[2],4,2)).substr($expprp[2],0,4);
	$etgl=explode("-",$_GET['tgl']);
	$unit=$_GET['unit'];
	$table = "tx_".(int)($etgl[1])."".$etgl[0];	
	$jenis = 'view';
	$where2 = "v='0' and jenis='5' and unit='$unit' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]'
			  	AND id_inc not in(select id_trx from bo_validasi_tmp)
				AND id_inc not in(select id_trx from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]')";
	$limit = 'limit 0,1000';

$primaryKey = 'id_inc';
$columns = array(
	array('db'      => 'id_tx','dt'   => 0,
		   'formatter' => function( $d, $row ) {
			
			return"$d<input name=\"notx[]\" id=\"notx\" type=\"hidden\" value=\"$d\" />
					 <input name=\"tgl1[]\" id=\"tgl1\" type=\"hidden\" value=\"$_GET[tgl]\" />";
			}
		  ),
	array(
		'db'        => 'nama_pax',
		'dt'        => 1,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}
	),
	array('db'      => 'id_cardtx','dt'   => 2),
	array('db'      => 'arrives','dt'       => 3),
	array('db'        => 'qty','dt'     => 4),
	array(
		'db'        => 'nominal',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return number_format($d);
		}
	),
	
	array(
		'db'        => 'id_inc',
		'dt'        => 6,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<input name=\"tick[]\" id=\"tick\" type=\"checkbox\" value=\"$d\" />";
		}
			),
			
		array(
		'db'        => 'id_inc',
		'dt'        => 7,
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<a href='index.php?x=vdasi&jenis=3&tgl=$_GET[tgl]&idj=$d'>Edit</a>";
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
		kelas::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $where2, $jenis, $limit )
	).');';
}





