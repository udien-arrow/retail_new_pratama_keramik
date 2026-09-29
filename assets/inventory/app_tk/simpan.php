<?php
foreach ($_POST['app'] as $key => $value) {
		$asd=explode("_",$value);
			 if($value!=""){
					$datas = array(  
					 'status' => 1,
					);
		$exec= $db->update("tx_tagihan_kembali_dtl", $datas,"no_fj='".$asd['0']."'and urut='".$asd['1']."'");
		}
		}  
		$sd=$db->select("tx_tagihan_kembali_dtl","id_dtl","no_ta='$_POST[link]' and status='1'");
		$ds=$db->select("tx_tagihan_kembali_dtl","id_dtl","no_ta='$_POST[link]'");
		$cek=count($sd);
		$cek2=count($ds);
		if($cek2==$cek){
			 $datas = array(  
					 'status' => 1,
					);
		$exec=$db->update("tx_tagihan_kembali",$datas,"no_ta='$_POST[link]'");
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
	echo "<script>window.location='index.php?x=apptagkem&id=$_POST[link]'</script>"; 
	
		

?>