<?php
foreach ($_POST['app'] as $key => $value) {
					$datas = array(  
					 'status' => 1,);
		$exec= $db->update("tx_tagihan_kembali_dtl", $datas,"no_ta='$_POST[link]' and no_fj='".$_POST['app'][$key]."'");
		$sd=$db->select("tx_tagihan_kembali_dtl","*","no_ta='$_POST[link]' and no_fj='$value'");
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
		$s=$db->select("tx_tagihan_kembali_dtl","sum(dibayar) as dibayar","no_fj='$tel[no_fj]' and status='1'");
		foreach($s as $v){
		$a=$v['dibayar'];
		}
		if($a>=$tel['total_piutang']){
			$data = array( 
						'status_bayar' => 1, 
							);
		$exec=$db->update("tx_piutang",$data,"no_ref='$tel[no_spj]' and no_faktur_jual='$tel[no_fj]' and status='1'");
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
			}
	echo "<script>window.location='index.php?x=app_pembayaran&id=$_POST[link]'</script>"; 
	
		

?>