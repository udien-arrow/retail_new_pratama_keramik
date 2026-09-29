<?php
$tabel = "tx_buku_bg";

	if($_POST['tambah_in']=='ijen'){	
			$exp=explode("_",$_POST['id']);	
			$data = array( 
					'jenis_bg' => $_POST['idbuku'],
					'status' => 1,
					);
			$exec= $db->update($tabel, $data,"id_buku='$exp[0]'");	
			
			$data = array( 
					'jenis_bg' => $_POST['idbuku'],
					'app_bg' => date('Y-m-d'),
					);
			$exec= $db->update("tx_tagihan_kembali_dtl", $data,"no_ta='$exp[2]' and no_spj='$exp[1]' and jenis_pem='3'");	
				
			//=====approve============
			$id=$db->idurut("m_approving","id");
			$data = array( 
								'id' => $id, 
								'no' => $_POST['id'],
								'id_login' => $_SESSION['ID_LOGIN'],
								'tanggal' => date("Y-m-d H:i:s"),
								'jenis' => 0,
								'level' => 11,
								'type' => 0,
								);
			$exec= $db->insert("m_approving", $data);
			
	}	
	echo "<script>window.location='index.php?x=bukubg&id=".$_POST['idlink']."'</script>";
	



?>