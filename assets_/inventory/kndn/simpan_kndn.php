<?php
	$tabel = "tx_piutang";

	foreach($_POST['kredit'] as $key =>$val){
		if($val!='' && $_POST['piu'][$key]){
			$explo=explode("_",$_POST['piu'][$key]);
			$kre=explode("_",$val);
						
			$kredit=$_POST['total_kredit'][$key];
			$debet=$explo[1];
			if(abs($kredit)>$debet){
				$kredit=0-$debet;	
			}else{
				$kredit=$_POST['total_kredit'][$key];	
			}
			//echo $kredit;
			//die();
			include("jurnal_kndn.php");
					
			$id=$db->idurut("tx_pembayaran_sales","id");
			$data = array( 
							  'id' => $id, 
							  'no_faktur' => $kre[1],
							  'no_spj' => $kre[2],
							  'jenis_pembayaran' => 0,
							  'jenis_piutang' => 1,
							  'id_cus' => $_POST['cus'],
							  'total_piutang' => 0,
							  'total_dibayar' => $kredit,
							  'id_user' => $_SESSION['ID_LOGIN'],
							  'stampdate' => date("Y-m-d H:i:s"),
							  'no_faktur_ref' => $explo[0],
							  );
			$exec= $db->insert("tx_pembayaran_sales", $data);	
			if($debet>=abs($_POST['total_kredit'][$key])){
					$data = array( 
								'status_bayar' => 1, 
								);
					$exec=$db->update("tx_piutang",$data,"id_piutang='$kre[0]'");	
			}
			$sisa=$debet-abs($kredit);
			if($sisa==0){
					$data = array( 
								'status_bayar' => 1, 
								);
					$exec=$db->update("tx_piutang",$data,"id_piutang='$explo[2]'");				
			}
			
				
		 }
		
	}	

	echo "<script>window.location='index.php?x=kndn_k&cus=".$_POST['cus']."'</script>";
	



?>