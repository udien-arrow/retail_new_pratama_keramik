<?php
session_start();
error_reporting(0);
//require( 'ssp.class.php' );
//$db=new SSP;
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$etgl=explode("-",$_GET['tgl']);
$unit=$_GET['unit'];
$table = "tx_".(int)($etgl[1])."".$etgl[0];

// Table's primary key
$primaryKey = 'id_inc';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array('db'      => 'a.id_inc','dt'   => 0, 'field' => 'id_inc',
		   'formatter' => function( $d, $row ) {
			return"$d";
			}
		  ),
	array('db'      => 'a.id_tx','dt'   => 1, 'field' => 'id_tx',
		   'formatter' => function( $d, $row ) {
			return"$d";
			}
		  ),
	array(
		'db'        => 'a.nama_pax',
		'dt'        => 2,
		'field' => 'nama_pax',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}		
	),	
	array('db'      => 'a.id_cardtx','dt'   => 3, 'field' => 'id_cardtx',),
	//array('db'      => 'c.nama_bank','dt'   => 3, 'field' => 'nama_bank',),
	array(
			'db'      => 'b.nama_card',
			'dt'   => 4, 
			'field' => 'nama_card',
			'formatter' => function( $d, $row ) {
			return ($d);
		}
	),
	array('db'      => 'a.arrives','dt'       => 5, 'field' => 'arrives',),
	array('db'        => 'a.qty','dt'     => 6, 'field' => 'qty',),
	array(
		'db'        => 'tarif',
		'dt'        => 7,
		'field' => 'tarif',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return number_format($d);
		}
	),
	array(
		'db'        => 'a.nominal',
		'dt'        => 8,
		'field' => 'nominal',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return number_format($d);
		}
	),
	
	array(
		'db'        => 'a.id_inc',
		'dt'        => 9,
		'field' => 'id_inc',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<input name=\"tick[$d]\" id=\"tick\" type=\"checkbox\" value=\"$d\" />";
		}
		
	),
			
	array(
		'db'        => 'a.id_inc',
		'dt'        => 10,
		'field' => 'id_inc',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<a href='index.php?x=vdasi&jenis=1&tgl=$_GET[tgl]&idj=$d&spk=$_GET[spk]&kartu=$_GET[kartu]&unit=$_GET[unit]'>Edit</a>";
		}
	)		
);

// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
); 

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

if($_GET[kartu]==0 || empty($_GET[kartu])){
	$kartu="";
	} else {
		
		$kartu="AND a.id_card='$_GET[kartu]'";
		//echo"ada kartu";
		}

$joinQuery = "FROM tx_".(int)($etgl[1])."".$etgl[0]." a JOIN bo_m_card b ON a.id_card=b.id_card JOIN bo_m_bank c ON b.id_bank=c.id_bank JOIN bo_spk_head d ON c.id_bank=d.id_mitra and d.status='1'";
$extraWhere = "a.v='0' and a.jenis='1' and b.id_bank='$_GET[spk]' and a.unit='$unit' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' AND d.jenis_mitra='1'
				$kartu 
			  	AND id_inc not in(select id_trx from bo_validasi_tmp)
				AND id_inc not in(select id_trx from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]')";        

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);