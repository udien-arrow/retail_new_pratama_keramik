<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
$tabel = "hr_ijin";
if ($_POST['tambah'])
{	
	  $exp=explode("_",$_POST['jenis']);
	  $idn=$db->idurut($tabel,"id_lembur");		
	  $data = array( 
						'id_lembur' => $idn, 
						'id_pegawai' => $_POST['idpeg'], 
						'date' => $_POST['date'], 
						'ket' => $_POST['ket'], 
						'stampdate' => date("Y-m-d H:i:s"), 
						'jenis' => $exp[1],  
						'id_user' => $_SESSION['ID_LOGIN'],   
					);
					$exec= $db->insert($tabel, $data);
	
	foreach($db->select("hr_jenis_absen","color","id_jenis='$exp[0]'")as $v);
					
	echo $exp[0].'_'.$_POST['idpeg'].'_'.$_POST['date'].'_'.$v['color'];				
}
?>