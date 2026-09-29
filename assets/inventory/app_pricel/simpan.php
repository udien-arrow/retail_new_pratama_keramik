<?php
if($_POST['simpan']=="setuju"){	
		$datas = array(  
					 'status' => 1,
					 'note_tolak' => $_POST['keter'],
					);
		$exec=$db->update("m_pricelist",$datas,"kode_price='$_POST[link]'");
		$id=$db->idurut("m_approving","id");
		$data = array( 
						'id' => $id, 
						'no' => $_POST['link'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 20,
						'level' => 1,
						'type' => 0,
						);
		$exec= $db->insert("m_approving", $data);	
			
	echo "<script>window.location='index.php?x=app-price'</script>"; 
}

elseif($_POST['simpan']=="tolak"){	
	$datas = array(  
					 'status' => 2,
					 'note_tolak' => $_POST['keter'],
					);
		$exec=$db->update("m_pricelist",$datas,"kode_price='$_POST[link]'");
		$id=$db->idurut("m_approving","id");
		$data = array( 
						'id' => $id, 
						'no' => $_POST['link'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 20,
						'level' => 1,
						'type' => 1,
						);
		$exec= $db->insert("m_approving", $data);	
			
	echo "<script>window.location='index.php?x=app-price'</script>"; 
	
}
		

?>