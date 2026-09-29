<?php
foreach ($_POST['app'] as $key => $value) {
			 if($value!=""){
					$datas = array(  
					 'status' => 1,
					);
		$exec= $db->update("tx_tagihan_kembali_dtl", $datas,"no_fj='".$_POST['app'][$key]."'");
		$sd=$db->select("tx_tagihan_kembali_dtl","*","no_fj='".$_POST['app'][$key]."'");
		foreach($sd as $tel){
		$id=$db->idurut("tx_pembayaran_sales","id");
		$data = array( 
						'id' => $id, 
						'no_tk' => $_POST['link'],
						'no_faktur' => $tel['no_fj'],
						'no_spj' => $tel['no_spj'],
						'jenis_pembayaran' => $tel['jenis_pem'],
						'id_cus' => $tel['id_cus'],
						'total_piutang' => $tel['total_piutang'],
						'total_dibayar' => $tel['dibayar'],
						'id_user' => $_SESSION['ID_LOGIN'],
						'stampdate' => date("Y-m-d H:i:s")
						);
		$exec= $db->insert("tx_pembayaran_sales", $data);	
		if($tel['dibayar']>=$tel['total_piutang']){
			$data = array( 
						'status' => 1, 
							);
		$exec=$db->update("tx_do",$data,"no_spj='$tel[no_spj]'");
			}
		}
		
		   }}  
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