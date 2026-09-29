<?php
if($_POST['posting']){
	$ril=$db->select("v_spj_rilis","*","status_tx=1 and status_jurnal is null ");
	foreach($ril as $hah){
		//start auto jurnal total
		$s=$db->select("m_supplier","ifnull(pph,0) as pph,ifnull(account,0) as account,account_pph,jenis_aging,term","id_supp='$hah[id_supp]'");
		foreach($s as $pps){}
		$idgen=$hah['no_spj'];
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $hah['id_cabang']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$id=$val['id']+1;
				$datajur = array(  'IDJ' => $id,
					   'IDKM'=> $idgen,
					   'NO_JURNAL' => $idj,
					   'DEBET' => 0,
					   'KREDIT' => 0,
					   'TGL_JURNAL' => $hah['tgl_spj'],
					   'USER' => $_SESSION['ID_LOGIN'],
					   'ID_CAB' => $hah['id_cabang'],
					   'ID_GUD' => $hah['id_gudang'],
					  );
				$execjur= $db->insert("ak_jurnal", $datajur);
		//end auto jurnal total
		//start auto jurnal
				if($pps['pph']!=0){
					$th=$pps['pph']/100;	
				}else{
					$th=0;
				}
				//$dpp=$hah['price']/1.1;
				$dpp=$hah['price']/(1.1+$th);
				$ppn=$dpp*(10/100)*$hah['qty_do'];				

				if($pps['pph']==0){
					$hrgbeli=$dpp*$hah['qty_do'];
					$pph=0;
				}else{
					$pph=($dpp*($pps['pph']/100))*$hah['qty_do'];
					$hrgbeli=($dpp*$hah['qty_do']);
					
				}
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","intransit","a.id_barang='$hah[id_barang]'");
				foreach($ba as $bar){}
				$tppn=$ppn;
				$tpph=$pph;
				$thutang=$ppn+$pph+$hrgbeli;
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['intransit'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal persediaan dalam perjalanan",
							   'TGL_JURNAL' => $hah['tgl_spj'],
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $hah['id_cabang'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $hah['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//start auto jurnal pph
		//$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='2' and status='1'");
		$ckpph=$db->select("ak_umpph","*","id_jenisum='$pps[account_pph]'");
		
		$dttime=date("Y-m-d H:i:s");
		foreach($ckpph as $ckpph2){}
		//echo $ckpph2['account'].'1';
		//die();
		if($pps['pph']==0){
		}else{
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['account'],
							   'DEBET' => $tpph,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Penerimaan Barang PPH",
							   'TGL_JURNAL' => $hah['tgl_spj'],
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $hah['id_cabang'],
							   'ID_GUD' => $hah['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
		}
		//end auto jurnal pph
		//start auto jurnal ppn
		$ckpph=$db->select("ak_parameterjur","*","id_m_parameterjur='1' and status='1'");
		foreach($ckpph as $ckpph2){}
		$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $ckpph2['acc_code'],
							   'DEBET' => $tppn,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Persediaan dalam perjalanan PPN",
							   'TGL_JURNAL' => $hah['tgl_spj'],
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $hah['id_cabang'],
							   'ID_GUD' => $hah['id_gudang'],
							  );
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal ppn
			//start auto jurnal hutang
			$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $pps['account'],
							   'DEBET' => "0",
							   'KREDIT' => $thutang,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal persediaan dalam perjalanan Hutang",
							   'TGL_JURNAL' => $hah['tgl_spj'],
							   'TANGGAL' => $dttime,
							   'NO_INVOICE' => $idgen,
							   'ID_CAB' => $hah['id_cabang'],
							   'ID_GUD' => $hah['id_gudang'],
							  );
							
			$execjur= $db->insert("ak_jurnal_dtl", $datajur);
			//end auto jurnal hutang
			$datajur = array( 
					   'DEBET' => $thutang,
					   'KREDIT' => $thutang,
					  );
			$execjur= $db->update("ak_jurnal", $datajur,"IDJ='$id'");
			
			if($pps['jenis_aging']==1){
			//update rilis and insert 
			$tgl=date("Y-m-d");
			$dataril = array( 
					   'status_jurnal' => 1,
					   'tgl_jt' => date('Y-m-d', strtotime($pps['term'].'days', strtotime($tgl))),
						'term' => $pps['term'],
					  );
			}elseif($pps['jenis_aging']==2){
			$dataril = array( 
					   'status_jurnal' => 1,
					  );
			}
			$execjur= $db->update("tx_rilis_dtl", $dataril,"no_spj='$hah[no_spj]'");
		
		
	}
	echo "<script>
		alert('Sukses Posting!');
		window.location='index.php?x=up_rilis'</script>";
	//die();
}else{
	$tabel = "tx_rilis";
	$tabel_dtl = "tx_rilis_dtl";
	$tabel_ntf = "tx_rilis_notif";
	$filename=$_FILES["file"]["tmp_name"];
   if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
		if($i>1 && $emapData[4]!=''){
			$emapData[4]=intval($emapData[4]);
			$id=$db->idurut($tabel,"id_sales");	
			$gudv['id_gudang']='';	
			foreach($db->select("m_gudang_shipto","*","shipto_code='$emapData[22]'") as $gudv);
			if($gudv['id_gudang']==''){
				foreach($db->select("m_customer_shipto","shipto_code as ship_to","shipto_code='$emapData[22]'") as $cusv);
			}
			if($cusv['ship_to']==''){
				if($gudv['id_gudang']==''){
					$idn=$db->idurut($tabel_ntf,"id");		
					$data = array( 
							'id' => $idn, 
							'sales_order' => $emapData[4], 
							'ket' => 'Gagal Upload!!, Kode Shipto '.$emapData[22].' belum didaftarkan. Silakan input dimaster gudang!', 
					);
					$exec= $db->insert($tabel_ntf, $data);
				}
			}
			
			if($gudv['id_gudang']==''){			
				if($cusv['ship_to']==''){
					$idn=$db->idurut($tabel_ntf,"id");		
					$data = array( 
							'id' => $idn, 
							'sales_order' => $emapData[4],
							'ket' => 'Gagal Upload!!, Kode Shipto '.$emapData[22].' belum didaftarkan. Silakan input dimaster Pelanggan!', 
					);
					$exec= $db->insert($tabel_ntf, $data);
				}
			}
			
			if($gudv['id_gudang']!='' || $cusv['ship_to']!=''){
				//==============================cek head so================================================
				$jum=count($db->select($tabel,"*","no_so='$emapData[4]'"));
				if($jum==0){
					if($gudv['id_gudang']!=''){
						$jenis=0;
					}
					if($cusv['ship_to']!=''){
						$jenis=1;
					}
					$data = array( 
						'id_sales' => $id, 
						'no_so' => str_replace(",","",$emapData[4]), 
						'tgl_so' => str_replace(",","",date('Y-m-d',strtotime($emapData[6]))), 
						'incoterm' => str_replace(",","",$emapData[7]), 
						'kode_shipto' => str_replace(",","",$emapData[22]), 
						'kode_distrik' => str_replace(",","",$emapData[25]), 
						'id_supp' => $_POST['supp'],
						'id_user' => $_SESSION['ID_LOGIN'],  
						'jenis' => $jenis,  
						'st_upload' => $_POST['st_upload'],  
						'stampdate' => date("Y-m-d H:i:s"),  
					);
					$exec= $db->insert($tabel, $data);
				}//end if
				//==============================endcek head so================================================
				//==============================endcek dtl so================================================
				if($_POST['st_upload']==1){
					$jumd=count($db->select($tabel_dtl,"*","no_so='$emapData[4]' and no_spj='$emapData[14]'"));
				}else{
					$jumd=count($db->select($tabel_dtl,"*","no_so='$emapData[4]' and no_spj='$emapData[14]' and line='$emapData[33]'"));
				}
				if($jumd==0){
					$iddtl=$db->idurut($tabel_dtl,"id_dtl");	
					$data = array( 
						'id_dtl' => $iddtl, 
						'no_so' => str_replace(",","",$emapData[4]), 
						'no_do' => str_replace(",","",$emapData[8]), 
						'tgl_do' => str_replace(",","",date('Y-m-d',strtotime($emapData[9]))), 
						'produk' => str_replace(",","",$emapData[10]), 
						'qty_do' => str_replace(",","",$emapData[11]), 
						'kode_shipto' => str_replace(",","",$emapData[22]), 
						'no_spj' => str_replace(",","",$emapData[14]), 
						'no_polisi' => str_replace(",","",$emapData[18]), 
						'nama_sopir' => str_replace(",","",$emapData[19]), 
						'kode_exp' => str_replace(",","",$emapData[20]), 
						'tgl_spj' => str_replace(",","",date('Y-m-d',strtotime($emapData[15]))), 
						'jam_spj' => str_replace(",","",$emapData[16]), 
						'no_spps' => str_replace(",","",$emapData[17]), 
						'line_item' => str_replace(",","",$emapData[33]),  
						'st_upload_dtl' => $_POST['st_upload'],  
					);
					$exec= $db->insert($tabel_dtl, $data);
				}
				$gudv['id_gudang']='';
				$cusv['ship_to']='';
				//==============================endcek dtl so================================================
			}//end if cek bar gud
		}
		$i++;
    }
    	fclose($file);
    	$jumn=count($db->select("tx_rilis_notif","*"));
		if($jumn==0){
			echo "<script>alert('Data sudah diupload, silahkan melakukan Posting Jurnal SDP!');</script>";
    		echo "<script>window.location='index.php?x=up_rilis'</script>";
		}else{
			include('index_notif.php');
		}
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=up_rilis'</script>";
	}
}
?>