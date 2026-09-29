<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();


if ($_GET['tp']=='bank')
{
	$where = array( 
			'id' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_pegawai_acc", $where);
}
if ($_GET['tp']=='finger')
{
	$where = array( 
			'id' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_finger", $where);
}
if ($_GET['tp']=='emer')
{
	$where = array( 
			'id_hub' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_emergency", $where);
}
if ($_GET['tp']=='alamat')
{
	$where = array( 
			'id_alamat' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_alamat", $where);
}
if ($_GET['tp']=='pendidikan')
{
	$where = array( 
			'id_pend' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_pendidikan", $where);
}
if ($_GET['tp']=='statuskel')
{
	$where = array( 
			'id_tdstatuskel' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_statuskel", $where);
}
if ($_GET['tp']=='kedudukan')
{
	$where = array( 
			'id_tdjab' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_jabatanpeg", $where);
}
if ($_GET['tp']=='kontrak')
{
	$where = array( 
			'id_kontrak' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_kontrakpeg", $where);
}
if ($_GET['tp']=='pengalaman')
{
	$where = array( 
			'id' => $_GET['id'], 
	 );
	$exec= $db->delete("hr_pegawai_pengalaman", $where);
}

?>