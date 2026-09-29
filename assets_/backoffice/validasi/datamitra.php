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
	array('db'      => 'id_inc','dt'   => 0, 'field' => 'id_inc',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
			}
		  ),
	array('db'      => 'id_tx','dt'   => 1, 'field' => 'id_tx',
		   'formatter' => function( $d, $row ) {
			
			return"$d";
					 
			}
		  ),
	array(
		'db'        => 'nama_pax',
		'dt'        => 2,
		'field' => 'nama_pax',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "
				$bar
			";
		}		
	),	
	array('db'      => 'b.nama','dt'   => 3, 'field' => 'nama',),
	//array('db'      => 'b.id_card','dt'   => 2, 'field' => 'nama_bank',),

	array('db'      => 'a.arrives','dt'       => 4, 'field' => 'arrives',),
	array('db'        => 'a.qty','dt'     => 5, 'field' => 'qty',),
	array(
		'db'        => 'c.tarif',
		'dt'        => 6,
		'field' => 'tarif',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return number_format($d);
		}
	),
	array(
		'db'        => 'a.id_inc',
		'dt'        => 7,
		'field' => 'id_inc',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<a href='index.php?x=vdasi&jenis=3&tgl=$_GET[tgl]&idj=$d'>Edit</a>";
		}
	),	
	array(
		'db'        => 'a.id_inc',
		'dt'        => 8,
		'field' => 'id_inc',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<input name=\"tick[$d]\" id=\"tick\" type=\"checkbox\" value=\"$d\" />";
		}
		
	),
			
	array(
		'db'        => 'a.id_inc',
		'dt'        => 9	,
		'field' => 'id_inc',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<a href='index.php?x=vdasi&jenis=3&tgl=$_GET[tgl]&idj=$d'>Edit</a>";
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

$joinQuery = "FROM tx_".(int)($etgl[1])."".$etgl[0]." a JOIN bo_pkslain b ON a.id_card = b.idpks JOIN bo_spk_head c ON b.idpks=c.id_mitra and c.status='1'";
$extraWhere = "v='0' AND b.idpks='$_GET[spk]' and jenis='5' and unit='$unit' and cabang='$_SESSION[ID_CABANG]' and date(tgl)='$_GET[tgl]' AND c.jenis_mitra='2'
			  	AND id_inc not in(select id_trx from bo_validasi_tmp)
				AND id_inc not in(select id_trx from bo_validasi_dtl where month(tgl_trx)='$etgl[1]' and year(tgl_trx)='$etgl[0]')";        

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);