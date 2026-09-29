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
//$table = "tx_".(int)($etgl[1])."".$etgl[0];
$table = "bo_validasi_dtl";

// Table's primary key
$primaryKey = 'id_validasi';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array('db'      => 'a.no_trx','dt'   => 0, 'field' => 'no_trx',),
	array('db'        => 'a.tgl_trx','dt' => 1, 'field' => 'tgl_trx',),	
	array('db'      => 'c.nama_pax','dt'   => 2, 'field' => 'nama_pax',),
	//array('db'      => 'c.nama_bank','dt'   => 3, 'field' => 'nama_bank',),
	array('db'      => 'c.id_cardtx','dt'   => 3, 'field' => 'id_cardtx',),
	array('db'      => 'c.flight','dt'       => 4, 'field' => 'flight',),
	array('db'        => 'c.arrives','dt'     => 5, 'field' => 'arrives',),
	array('db'        => 'c.qty','dt'  => 6, 'field' => 'qty',),
	array('db'        => 'TIME(c.tgl)','dt' => 7, 'field' => 'tgl',),
			
	/*array(
		'db'        => 'c.id_inc',
		'dt'        => 8,
		'field' => 'id_inc',
		'formatter' => function( $d, $row ) {
			$bar= ucfirst(strtolower($d));
			return "<a href='index.php?x=vdasi&jenis=3&tgl=$_GET[tgl]&idj=$d'>Edit</a>";
		}
	)*/		
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

$joinQuery = "FROM bo_validasi_dtl a JOIN bo_validasi b ON a.no_trx=b.no_validasi JOIN tx_".(int)($etgl[1])."".$etgl[0]." c ON c.id_inc=a.id_trx";
//$extraWhere = "c.jenis='3' and c.unit='$unit' and c.cabang='$_GET[cab]' and date(tgl_val)='$_GET[tgl]')";
$extraWhere = "c.jenis='3' and c.unit='1' and c.cabang='6' and date(a.tgl_val)='2017-02-21'";        

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);