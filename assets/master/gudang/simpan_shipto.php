<?php
require( '../../../webclass.php' );
$db=new kelas;

if($_POST['action']=="add"){
	//$query=mysql_query("insert into master_konversi(ID_BRG,SAT2,KONV) VALUES('$_POST[ID]','$_POST[SAT2]','$_POST[KONV]')");
	//$query2=mysql_query("update barang set SAT='$_POST[SAT]' where ID_BRG='$_POST[ID]'");

	$data = array( 
				 'id_gudang' => $_POST['gudang'], 
				 'shipto_code' => $_POST['code'],
				 'shipto_name' => $_POST['name'],
				);
	$exec= $db->insert("m_gudang_shipto", $data);
	echo"added";
	
}
if($_POST['action']=="hapus"){
	$where = array("id" => $_POST['ID']);
	$db->delete("m_gudang_shipto",$where);
}

?>