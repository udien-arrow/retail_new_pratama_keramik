<?php
session_start();

require( '../../../webclass.php' );
$db=new kelas;

if($_POST['action']=="add"){
	//$query=mysql_query("insert into master_konversi(ID_BRG,SAT2,KONV) VALUES('$_POST[ID]','$_POST[SAT2]','$_POST[KONV]')");
	//$query2=mysql_query("update barang set SAT='$_POST[SAT]' where ID_BRG='$_POST[ID]'");
	$explo=explode("_",$_POST['id']);
	$tgl=date("Y-m-d H:i:s");
	$data = array( 
				 'no_spj' => $explo[1], 
				 'no_so' => $explo[0],
				 'id_gudang' => $explo[2],
				 'id_barang' => $explo[3],
				 'qty_do' => $explo[4],
				 'tgl_relokasi' => $tgl,
				 'ke_gudang' => $_SESSION['ID_GUDANG'],
				 'id_cabang' => $_SESSION['ID_CABANG'],
				 'id_user' => $_SESSION['ID_LOGIN'],
				 'status' => 0,
				);
	$exec= $db->insert("tx_spj_relokasi", $data);
	
	//echo $explo[0];
}
?>