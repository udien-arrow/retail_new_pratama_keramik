<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
$tabel = "am_katagori_dtl";
if ($_GET['jen']=='simpan')
{
	foreach($_POST['id_kategori_dtl'] as $key => $val){
	if($val!=""){
	if($_POST['id_am_dtl'][$key]!=''){
	
	$idh=$db->idurut("am_asset_dtl_hs","id_hs");
	$data = array( 
						'id_hs' => $idh,
						'id_dtl' => $_POST['id_am_dtl'][$key],
						'id_asset' => $_POST['id_am'][$key],
						'id_kategori' => $_POST['id_kategori'][$key],
						'id_kategori_dtl' => $_POST['id_kategori_dtl'][$key],
						'nilai' => $_POST['nilai'][$key],
						);
	$db->insert("am_asset_dtl_hs",$data);
	
	$data = array( 
						'id_asset' => $_POST['id_am'][$key],
						'id_kategori' => $_POST['id_kategori'][$key],
						'id_kategori_dtl' => $_POST['id_kategori_dtl'][$key],
						'nilai' => $_POST['nilai'][$key],
						);
	$db->update("am_asset_dtl",$data,"id_dtl='".$_POST['id_am_dtl'][$key]."'");
	
	}else{
	$ids=$db->idurut("am_asset_dtl","id_dtl");
	$data = array( 
						'id_dtl' => $ids,
						'id_asset' => $_POST['id_am'][$key],
						'id_kategori' => $_POST['id_kategori'][$key],
						'id_kategori_dtl' => $_POST['id_kategori_dtl'][$key],
						'nilai' => $_POST['nilai'][$key],
						);
	$db->insert("am_asset_dtl",$data);
	
	$idh=$db->idurut("am_asset_dtl_hs","id_hs");
	$data = array( 
						'id_hs' => $idh,
						'id_dtl' => $ids,
						'id_asset' => $_POST['id_am'][$key],
						'id_kategori' => $_POST['id_kategori'][$key],
						'id_kategori_dtl' => $_POST['id_kategori_dtl'][$key],
						'nilai' => $_POST['nilai'][$key],
						);
	$db->insert("am_asset_dtl_hs",$data);
	}
		}
	}
	echo $_POST['relo'];
}



?>