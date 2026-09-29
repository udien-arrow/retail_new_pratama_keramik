<?php
require( '../../../webclass.php' );
$db=new kelas;
$kon=$db->select("preferences","*");
	/*echo"select * from pj_penjualan a
				  JOIN r_user_login b ON a.id_user = b.ID
				  JOIN m_pegawai c ON b.ID_PEGAWAI=c.id_pegawai where a.id_pj='$_GET[id]'";*/
	foreach($kon as $val2){

	}

echo json_encode($kon);
?>