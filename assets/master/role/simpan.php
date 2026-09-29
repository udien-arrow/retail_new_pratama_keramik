<?php
$tabel = "m_role";
$tabels = "m_role_dtl";

		 	if($_POST['kode']==''){
				$id=$db->idurut($tabel,"id_role");
				$data = array( 'id_role' => $id, 
				 'nama_role' => $_POST['username'],
				);
		  $exec= $db->insert($tabel, $data);
			}else{
				$id=$_POST['kode'];	
				$where = array( 'id_role' => $_POST['kode'], 	 
				);	
				$exec= $db->delete($tabels, $where);
				$data = array(  
				 'nama_role' => $_POST['username'],
				);
		 		 $exec= $db->update($tabel, $data,"id_role='$_POST[kode]'");
			}
			
			
		 foreach ($_POST['hak'] as $key => $value) {
			 if($value!=""){
				$explo=explode("_",$value);
				$value= $explo[1];
				 //======cek paren hak
			    $cek=count($db->select("m_role_dtl","*","id_role='$id' AND id_menu='$explo[0]'"));
				//echo $explo[0].'-'.$explo[1].'-'.$explo[2];
				if($cek==0){
					$datas = array(  
					 'id_role' => $id,
					 'id_menu' => $explo[0]
					);	
					$exec= $db->insert($tabels, $datas);
				}
				
				//======cek paren hak 
				$cek=count($db->select("m_role_dtl","*","id_role='$id' AND id_menu='$explo[2]'"));
				if($cek==0){
					$datas = array(  
					 'id_role' => $id,
					 'id_menu' => $explo[2]
					);	
					$exec= $db->insert($tabels, $datas);
				}  
				//======cek paren hak 
				$datas = array(  
					 'id_role' => $id,
					 'id_menu' => $explo[1]
					);	
				$exec= $db->insert($tabels, $datas);
				
		   }
		  
		
	echo "<script>window.location='index.php?x=role'</script>"; }
	
		

?>