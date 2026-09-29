<?php
$tabel = "r_user_login";
	$pass1=md5($_POST['password1']);
	$pass2=md5($_POST['password2']);
	if($pass1===$pass2){
	$data = array('PASSWORD' => $pass1,
		 );
	$exec= $db->update($tabel, $data, "ID='$_POST[id]'");
	echo "<script>window.location='index.php'</script>";
	
}else { 
echo "<script>alert('Password Salah');</script>"."<script>window.location='index.php?x=edituser'</script>";
}
?>