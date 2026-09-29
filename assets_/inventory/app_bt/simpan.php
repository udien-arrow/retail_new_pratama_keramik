<?php
foreach ($_POST['app'] as $key => $value) {
			 if($value!=""){
					$datas = array(  
					 'status' => 1,
					 'tgl_approve' => date("Y-m-d"),
					);
					$exec= $db->update("tx_buku_tagihan_dtl", $datas,"no_fj='".$_POST['app'][$key]."'");
		   } }
		 $sd=$db->select("tx_buku_tagihan_dtl","id_dtl","no='$_POST[link]' and status='1'");
		$ds=$db->select("tx_buku_tagihan_dtl","id_dtl","no='$_POST[link]'");
		$cek=count($sd);
		$cek2=count($ds);
		if($cek2==$cek){
		   $datas = array(  
					 'status' => 1,
					);
		$exec=$db->update("tx_buku_tagihan",$datas,"no='$_POST[link]'");
		$id=$db->idurut("m_approving","id");
		$data = array( 
						'id' => $id, 
						'no' => $_POST['link'],
						'id_login' => $_SESSION['ID_LOGIN'],
						'tanggal' => date("Y-m-d H:i:s"),
						'jenis' => 9,
						'level' => 1,
						'type' => 1,
						);
	$exec= $db->insert("m_approving", $data);
		}
	echo "<script>window.location='index.php?x=appbt'</script>"; 
	
		

?>