
<?php
 define('HOST','192.168.9.5');
 define('USER','root');
 define('PASS','');
 define('DB','waruabadi');
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values
 $username = $_POST['email'];
 $password = md5($_POST['password']);

 //Creating sql query
 $sql = "SELECT * FROM r_user_login a join m_pegawai b on a.ID_PEGAWAI=b.id_pegawai WHERE USERNAME='$username' AND PASSWORD='$password'";
 //$sql = "SELECT a.ID, b.id_cabang, b.nama_pegawai FROM r_user_login a join m_pegawai b on a.ID_PEGAWAI=b.id_pegawai WHERE USERNAME='admin' AND PASSWORD='".md5(admin)."'";

 //executing query
 $result = mysqli_query($con,$sql);

 //fetching result
 $check = mysqli_fetch_array($result);

 //if we got some result
		
		if(count($check)>0){
			$response["id_cabang"] = $check['id_cabang'];
			$response["nama_pegawai"] = $check['nama_pegawai'];
			$response["id"] = $check['ID'];
		 }	else {
			 $response["id_cabang"] = "gagal";
			 $response["nama_pegawai"] = "gagal";
			$response["id"]  = "gagal";
			 
		 }//echo"$check[id_cabang]";
				

 //displaying success
echo json_encode($response);
//echo "success";
//echo json_encode('result'=>$result);
 }else{
 //displaying failure
 echo "failure";
 }
 mysqli_close($con);
 
?>
