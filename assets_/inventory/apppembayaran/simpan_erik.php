<?php
$jum=0;
foreach ($_POST['app'] as $key => $value) {
		$asd=explode("_",$value);
		if($value!=""){
				$datas = array(  
					 'status' => 1,
					);
				$exec= $db->update("tx_tagihan_kembali_dtl", $datas,"no_fj='".$asd['0']."' and urut='".$asd['1']."'");
				//=====piutang=================  
				$sd=$db->select("tx_tagihan_kembali_dtl","*","no_ta='$_POST[link]' and no_fj='".$asd['0']."' and urut='".$asd['1']."'");
				foreach($sd as $tel){
				if($tel['jenis_bg']!=2){	
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
				}
				$s=$db->select("tx_tagihan_kembali_dtl","sum(dibayar) as dibayar","no_fj='$tel[no_fj]' and status='1' and jenis_bg!='2'");
				foreach($s as $v){
					$a=$v['dibayar'];
				}
				if($a>=$tel['total_piutang']){
					$data = array( 
								'status_bayar' => 1, 
									);
				$exec=$db->update("tx_piutang",$data,"no_ref='$tel[no_spj]' and no_faktur_jual='$tel[no_fj]' and status='1'");
					}
				}
				//=========piutang
			$jum++;			
		}	
		
}
	if($jum>0){
		$id=$db->idurut("m_approving","id");
				$data = array( 
								'id' => $id, 
								'no' => $_POST['link'],
								'id_login' => $_SESSION['ID_LOGIN'],
								'tanggal' => date("Y-m-d H:i:s"),
								'jenis' => 10,
								'level' => 1,
								'type' => 1,
								);
		$exec= $db->insert("m_approving", $data);	
		$sd=$db->select("tx_tagihan_kembali_dtl","id_dtl","no_ta='$_POST[link]' and status='0'");
		$cek=count($sd);
		if($cek==0){
		$datas = array(  
						 'status' => 1,
						);
		$exec=$db->update("tx_tagihan_kembali",$datas,"no_ta='$_POST[link]'");
		}
	}
	
	
				
	echo "<script>window.location='index.php?x=apppembayaran&id=$_POST[link]'</script>"; 
	
		

?>