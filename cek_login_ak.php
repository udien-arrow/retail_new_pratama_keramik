<?php
session_start ();
date_default_timezone_set ( 'Asia/Jakarta' );
include 'webclass.php';
$db = new kelas();

$username = $_POST['username'];
$pass = md5($_POST['pwd']);
if($username=='admin'){
	$tabel = "r_user_login a join m_pegawai b on a.id_pegawai=b.id_pegawai";
	$fild  = "a.ID,a.ID_GUDANG,b.id_cabang,b.id_jabatan,b.nama_pegawai,b.id_pegawai,a.ID_ROLE"; //menampilkan semua fild
	$where = "a.username='$username' AND a.password='$pass'";
	$dtk=$db->select($tabel,$fild,$where);
}else{
	$tabel = "r_user_login a join m_pegawai b on a.id_pegawai=b.id_pegawai";
	$fild  = "a.ID,a.ID_GUDANG,b.id_cabang,b.id_jabatan,b.nama_pegawai,b.id_pegawai,a.ID_ROLE"; //menampilkan semua fild
	$where = "a.username='$username' AND a.password='$pass'";
	$dtk=$db->select($tabel,$fild,$where);
}
	if(count($dtk)>=1){
		foreach($dtk as $value){
			$_SESSION ['ID_LOGIN'] = $value['ID'];
			$_SESSION ['ID_PEG'] = $value['id_pegawai'];
			$_SESSION ['ID_GUDANG'] = $value['ID_GUDANG'];
			$_SESSION ['ID_CABANG'] = $value['id_cabang'];
			$_SESSION ['ID_JABATAN'] = $value['id_jabatan'];
			$_SESSION ['ID_ROLE'] = $value['ID_ROLE'];
			//$_SESSION ['ID_DIV'] = $value['id_divisi'];
			$_SESSION ['NAMA_PEG'] = $value['nama_pegawai'];
			//echo $value['id_cabang'].'-'.$_SESSION ['ID_CABANG'];
			//die();
			$user_ip = getenv('REMOTE_ADDR');
			$name = gethostbyaddr($user_ip);
			
			$datas = array(  
		   'username' => $_POST['username'],
		   'ip' => $user_ip,
		   'hostname' => $name,
		   'stampdate' => date("Y-m-d H:i:s"),
		  );
	$exec=$db->insert("user_log",$datas);
			if($_SESSION ['ID_JABATAN']==1 || $_SESSION ['ID_JABATAN']==3){
				echo "<script>location.href='login2.php'</script>";
			}else{
        		echo "<script>location.href='$hs';</script>";	
			}
	   }	
	} else {
			echo "<script>location.href='$hs';</script>"; 
	}
	
?>
