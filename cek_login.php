<?php
session_start ();
date_default_timezone_set ( 'Asia/Jakarta' );
include 'webclass.php';
$db = new kelas();
$check = $_POST ['check'];
$username = $_POST ['username'];
$pass = md5($_POST ['pwd']);
$pref =$db->select("preferences","id_pref,nopref,nama_perusahaan,logo,alamat,no_telp", "id_pref = '1'");
if($username=='admin'){
	$tabel = "r_user_login a join m_pegawai b on a.id_pegawai=b.id_pegawai";
	$fild  = "a.ID,a.ID_GUDANG,b.id_cabang,b.id_jabatan,b.nama_pegawai,b.id_pegawai,a.ID_ROLE,a.KETERANGAN"; //menampilkan semua fild
	$where = "a.username='$username' AND a.password='$pass'";
	$dtk=$db->select($tabel,$fild,$where);
}else{
	$tabel = "r_user_login a join m_pegawai b on a.id_pegawai=b.id_pegawai";
	$fild  = "a.ID,a.ID_GUDANG,b.id_cabang,b.id_jabatan,b.nama_pegawai,b.id_pegawai,a.ID_ROLE,a.KETERANGAN"; //menampilkan semua fild
	$where = "a.username='$username' AND a.password='$pass'";
	$dtk=$db->select($tabel,$fild,$where);
}
	if(count($dtk)>=1 and $check==null)
	{
		foreach($pref as $val){
		$_SESSION['ID_PREF'] = $val['id_pref'];
		$_SESSION['NOPREF'] = $val['nopref'];
		$_SESSION['NAMA_PERUSAHAAN'] = $val['nama_perusahaan'];
		$_SESSION['LOGO'] = $val['logo'];
		$_SESSION['ALAMAT'] = $val['alamat'];
		$_SESSION['NO_TELP'] = $val['no_telp'];
}
		foreach($dtk as $value){
			$_SESSION ['ID_LOGIN'] = $value['ID'];
			$_SESSION ['ID_PEG'] = $value['id_pegawai'];
			$_SESSION ['ID_GUDANG'] = $value['ID_GUDANG'];
			$_SESSION ['ID_CABANG'] = $value['id_cabang'];
			$_SESSION ['ID_JABATAN'] = $value['id_jabatan'];
			$_SESSION ['ID_ROLE'] = $value['ID_ROLE'];
			$_SESSION ['JEN'] = $value['KETERANGAN'];
			//$_SESSION ['ID_DIV'] = $value['id_divisi'];
			$_SESSION ['NAMA_PEG'] = $value['nama_pegawai'];
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
	} 
	elseif(count($dtk)>=1 and $check==1){
		foreach($dtk as $value){
			$_SESSION ['ID_LOGIN'] = $value['ID'];
			$_SESSION ['ID_PEG'] = $value['id_pegawai'];
			$_SESSION ['ID_GUDANG'] = $value['ID_GUDANG'];
			$_SESSION ['ID_CABANG'] = $value['id_cabang'];
			$_SESSION ['ID_JABATAN'] = $value['id_jabatan'];
			$_SESSION ['ID_ROLE'] = $value['ID_ROLE'];
			$_SESSION ['ANDROID'] = $check;
			//$_SESSION ['ID_DIV'] = $value['id_divisi'];
			$_SESSION ['NAMA_PEG'] = $value['nama_pegawai'];
        	echo "<script>location.href='$hsi';</script>";	
	   }	
	} 
	else {
			echo "<script>location.href='$hs';</script>"; 
	}
	
?>
