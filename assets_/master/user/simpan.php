<?php
$tabel = "r_user_login";
$tabels = "r_hak_menu";
		$pegawai=explode("_",$_POST['pegawai']);
		if($pegawai[1]==0){
			$gud=0;
		}elseif($pegawai[1]==1){
			$gud=$_POST['gud'];
		}
		
		$pass1=md5($_POST['password']);
		$pass2=md5($_POST['password2']);
		if($pass1===$pass2){	
		 	if($_POST['kode']==''){
				$id=$db->idurut($tabel,"ID");
				$data = array( 'ID' => $id, 
				 'USERNAME' => $_POST['username'],
				 'ID_GUDANG' => $gud,
				 'PASSWORD' => $pass1,
				 'ID_PEGAWAI' => $pegawai[0],
				 'STATUS' => 1,
				 'ID_ROLE' => $_POST['role']
				);
		  $exec= $db->insert($tabel, $data);
			}else{
				$id=$_POST['kode'];	
				$where = array( 'ID_USER' => $_POST['kode'], 
				);	
				$exec= $db->delete($tabels, $where);
				$data = array(  
				 'USERNAME' => $_POST['username'],
				 'ID_GUDANG' => $gud,
				 'PASSWORD' => $pass1,
				 'ID_PEGAWAI' => $pegawai[0],
				 'STATUS' => 1,
				 'ID_ROLE' => $_POST['role']
				);
		 		 $exec= $db->update($tabel, $data,"id='$_POST[kode]'");
			}
			
			$aa= $db->select("m_role_dtl","*","id_role='$_POST[role]'");
			foreach ($aa as $vals) {
			$datas = array(  
					 'ID_USER' => $id,
					 'ID_MENU' => $vals['id_menu']
					);	
			$exec= $db->insert($tabels, $datas);
			
			}
			
			
		 /* foreach ($_POST['hak'] as $key => $value) {
			 if($value!=""){
				$explo=explode("_",$value);
				$value= $explo[1];
				 //======cek paren hak
			    $cek=count($db->select("r_hak_menu","*","ID_USER='$id' AND ID_MENU='$explo[0]'"));
				//echo $explo[0].'-'.$explo[1].'-'.$explo[2];
				if($cek==0){
					$datas = array(  
					 'ID_USER' => $id,
					 'ID_MENU' => $explo[0]
					);	
					$exec= $db->insert($tabels, $datas);
				}
				
				//======cek paren hak 
				$cek=count($db->select("r_hak_menu","*","ID_USER='$id' AND ID_MENU='$explo[2]'"));
				if($cek==0){
					$datas = array(  
					 'ID_USER' => $id,
					 'ID_MENU' => $explo[2]
					);	
					$exec= $db->insert($tabels, $datas);
				}  
				//======cek paren hak 
				$datas = array(  
					 'ID_USER' => $id,
					 'ID_MENU' => $explo[1]
					);	
				$exec= $db->insert($tabels, $datas);
				
		   }
		  }
		 */
		
	echo "<script>window.location='index.php?x=user'</script>"; }
	else {echo "<script>alert('Password Salah');</script>"."<script>window.location='index.php?x=user'</script>";}
		

?>