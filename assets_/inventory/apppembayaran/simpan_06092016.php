<?php
$jum=0;
//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => $_POST['total'],
					   'KREDIT' => $_POST['total'],
					   'TGL_JURNAL' => date("Y-m-d"),
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $_SESSION['ID_CABANG'],
					   'ID_GUD' => $valtmp['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		
foreach ($_POST['app'] as $key => $value) {
		$asd=explode("_",$value);
		if($value!=""){
				if($asd[2]=='oke'){
					$datas = array(  
						 'status' => 1,
						);
					$exec = $db->update("tx_tagihan_kembali_dtl", $datas,"no_fj='".$asd['0']."' and urut='".$asd['1']."'");
				}
				if($asd[3]!=''){
					$sp=explode("*",$asd[3]);
					$datas = array(  
						 'status' => 2,
						);
					$exec = $db->update("tx_buku_bg", $datas,"no_ta='".$sp[0]."' and no_spj='".$sp[1]."'");
					//dtl
					$datas = array(  
						 'status' => 1,
						);
					$exec = $db->update("tx_tagihan_kembali_dtl", $datas,"no_spj='".$sp[1]."' and no_ta='".$sp[0]."'");
					//head
					$sd=$db->select("tx_tagihan_kembali_dtl","id_dtl","no_ta='$sp[0]' and status='0'");
					$cek=count($sd);
					if($cek==0){
						$datas = array(  
										 'status' => 1,
										);
						$exec=$db->update("tx_tagihan_kembali",$datas,"no_ta='$sp[0]'");
					}
				}
				//=====piutang=================  
				$sd=$db->select("tx_tagihan_kembali_dtl","*","no_ta='$_POST[link]' and no_fj='".$asd['0']."' and urut='".$asd['1']."'");
				foreach($sd as $tel){ //foreach
				if($asd[2]=='oke' && $tel['jenis_bg']!='2'){
					
					include("jurnal_dtl.php");
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
					//=========cek kredit note===
					if($_POST['kndn'][$key]!=''){ //bila kndn
						
						$sis=0;
						$sisa=0;
						$dibay=0;
						$bay['dibayar']=0;
						$exp=explode("_",$_POST['kndn'][$key]);
						$cek=$db->select("tx_piutang","total_piutang,(select ifnull(sum(total_dibayar),0)as dibayar from tx_pembayaran_sales where no_faktur='$exp[0]')as dibayar","no_faktur_jual='$exp[0]' and status_bayar=0");
						$jum2=count($cek);
						//die();
						if($jum2>0){  //if
						foreach($cek as $bay){}
						$dibay=$bay['dibayar'];
						$sis=$bay['total_piutang']-$dibay; 
						
						if($sis<0){
								$sisa=$tel['dibayar']+$sis; //220000-2400000 = -20000  //100.0000 + -20000   
							if($sisa>0){
								$masuk=$sis;
								$data = array( 
								'status_bayar' => 1, 
									);
								$exec=$db->update("tx_piutang",$data,"no_faktur_jual='$exp[0]' and status='1'");	
							}else{
								$masuk=$sis-$sisa;	
							}
							$id=$db->idurut("tx_pembayaran_sales","id");
							$data = array( 
											'id' => $id, 
											'no_tk' => $_POST['link'],
											'no_faktur' => $exp[0],
											'no_spj' => $tel['no_spj'],
											'jenis_pembayaran' => $tel['jenis_pem'],
											'jenis_piutang' => 1,
											'id_cus' => $tel['id_cus'],
											'total_piutang' => 0,
											'total_dibayar' => $masuk,
											'id_user' => $_SESSION['ID_LOGIN'],
											'stampdate' => date("Y-m-d H:i:s"),
											'no_faktur_ref' => $tel['no_fj'],
											);
							$exec= $db->insert("tx_pembayaran_sales", $data);	
							include("jurnal_kndn.php");
						}//end if sis
						} //if jum
					} //if kndn
					//=========cek kredit note===================
				}else{ //if bawahe foreach
					$idb=$db->idurut("tx_buku_bg","id_buku");
					$data = array( 
									'id_buku' => $idb, 
									'tgl_bg' => date("Y-m-d"),
									'stampdate' => date("Y-m-d H:i:s"),
									'id_user' => $_SESSION['ID_LOGIN'],
									'id_cabang' => $_SESSION['ID_CABANG'],
									'no_ta' => $tel['no_ta'],
									'jenis_bg' => $tel['jenis_bg'],
									'no_seribg' => $tel['no_seribg'],
									'id_bank' => $tel['nama_bank'],
									'id_cus' => $tel['id_cus'],
									'jatuh_tempo' => $tel['jatuh_tempo'],
									'no_spj' => $tel['no_spj'],
									'no_fj' => $tel['no_fj'],
									'nilai_bg' => $tel['dibayar'],
									'status' => 0
									);
					$exec= $db->insert("tx_buku_bg", $data);	
				}//end if bawahe foreach
				foreach($db->select("tx_piutang","total_piutang","no_ref='$tel[no_spj]' and status='1'")as $vl);
				$s=$db->select("tx_pembayaran_sales","sum(total_dibayar) as dibayar","no_spj='$tel[no_spj]'");
				$a=0;
				foreach($s as $v){
					$a=$v['dibayar'];
				}
				if($a>=$vl['total_piutang']){
					$data = array( 
								'status_bayar' => 1, 
									);
					$exec=$db->update("tx_piutang",$data,"no_ref='$tel[no_spj]' and no_faktur_jual='$tel[no_fj]' and status='1'");
					}
				}
				//=========piutang
			$jum++;			
		}	 //end foreach
		
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
	
	
			//die();	
	echo "<script>window.location='index.php?x=apppembayaran&cd=k2&id=$_POST[link]'</script>"; 
	
		

?>