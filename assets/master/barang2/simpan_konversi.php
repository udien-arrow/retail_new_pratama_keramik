<?php
require( '../../../webclass.php' );
$db=new kelas;

if($_POST['action']=="add"){
	//$query=mysql_query("insert into master_konversi(ID_BRG,SAT2,KONV) VALUES('$_POST[ID]','$_POST[SAT2]','$_POST[KONV]')");
	//$query2=mysql_query("update barang set SAT='$_POST[SAT]' where ID_BRG='$_POST[ID]'");

	$data = array( 'id_barang' => $_POST['ID'], 
				 'sat2' => $_POST['SAT2'],
				 'konv' => $_POST['KONV'],
				 'def' => $_POST['def'],
				);
	$exec= $db->insert("m_konversi", $data);
	
	$data = array( 'id_satuan' => $_POST['SAT'],  
				);
	$exec= $db->update("m_barang", $data, "id_barang='$_POST[ID]'");
	
	echo "added";
	
}
if($_POST['action']=="hapus"){
	$where = array("id_konv" => $_POST['ID']);
	$db->delete("m_konversi",$where);
}

?>