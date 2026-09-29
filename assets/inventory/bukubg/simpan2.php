<?php
	$tgl=date('Y-m-d');
	$temp=$db->select("tx_buku_bg_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
	foreach($temp as $tak){}		
		foreach($temp as $tmp){
		$data = array( 
					'jenis_bg' => $tmp['jenis_bg'], 
					'status' => 0,
					'app_bg' => date("Y-m-d H:i:s") 
					);
		$exec= $db->update("tx_tagihan_kembali_dtl", $data,"no_spj='$tmp[no_spj]' and urut='$tmp[urut]'");
		$where = array(
						"id_tmp" => $tmp['id_tmp']
						);
		}
		$db->delete("tx_buku_bg_tmp",$where);
		$cc=$db->select("tx_tagihan_kembali_dtl","count(status) as asli","no_ta='$_POST[links]'");
		foreach($cc as $cct){}
		$dd=$db->select("tx_tagihan_kembali_dtl","count(status) as hasil","no_ta='$_POST[links]' and status='1'");
		foreach($dd as $dc){}
		if($cct['asli']==$dc['hasil']){
			$data = array(
						"status" => 1
						);
		$db->update("tx_tagihan_kembali",$data,"no_ta='$_POST[links]'");
		}else{}
	echo "<script>window.location='index.php?x=buku_bg'</script>";
?>