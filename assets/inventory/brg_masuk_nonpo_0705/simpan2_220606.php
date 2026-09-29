<?php
if($_POST[aksi]=='hapus'){
    $where = array("id_tmp" => $_REQUEST['id2']);
    $db->delete("tx_brg_masuk_tmp", $where);
    //var_dump($where);
	//exit;
    echo "<script>window.location='index.php?x=brgmasuk2'</script>";
}else{
$dttmp=$db->select("tx_brg_masuk_tmp","id_user,id_gudang,no_po,id_po,id_supp,kurs,id_valuta,line,jenis","id_user='$_SESSION[ID_LOGIN]' and id_gudang='$_SESSION[ID_GUDANG]' and jenis='$_POST[jenis_in]' group by id_gudang,jenis");
	foreach($dttmp as $valtmp){	
	
	$s=$db->select("m_supplier","ifnull(pph,0) as pph,ifnull(account,0) as account,jenis_aging, pkp","id_supp='$valtmp[id_supp]'");
	//echo"select * from m_supplier";
	foreach($s as $pps){}
	
	if(($pps[pkp]==1 && $pps['account']==0) && $valtmp['jenis']!=4){
		$where = array(
						"id_user" => $_SESSION['ID_LOGIN']
						);
		$db->delete("tx_brg_masuk_tmp",$where);		
		echo "<script>alert('Maaf kode rekening belum di set pada master Supplier');</script>";
		
	}else{
		
	  $his=date('H:i:s');	
	  $tgl=date("Y-m-d",strtotime($_POST['tgl']));  
	  if($valtmp['id_user']<>''){ 
	  			if($valtmp['jenis']==5 or $valtmp['jenis']==6 or $valtmp['jenis']==7){
					$jen=1;	
				}else{
					$jen=$valtmp['jenis'];	
				}
				
		$idgen=$db->nourut('no_masuk', 'tx_brg_masuk', 'BM', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
		$id=$db->idurut("tx_brg_masuk","id_masuk");		
		//echo $id; 
		
		$ter=$db->select("m_supplier","term","id_supp='$valtmp[id_supp]'");
		foreach($ter as $term){}
		//insert biaya kalo lco
		/*
		if($_POST['jenk']=='LCO'){
					$data = array( 
					'stampdate' => date("Y-m-d H:i:s"),
					'no_masuk' => $idgen,
					'no_ref' => $valtmp['no_po'],
					'surat_jalan' => $_POST['surat_jalan'],
					'id_gudang' => $valtmp['id_gudang'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'id_supp' => $valtmp['id_supp'],
					'total_retribusi' => str_replace(",","",$_POST['jumlah_retri']),
					'total_bbm' => str_replace(",","",$_POST['ujs']),
					'total_ujs' => str_replace(",","",$_POST['totujs']),
					'biaya_lain' => str_replace(",","",$_POST['bl']),
					'total_gaji_supir' => str_replace(",","",$_POST['gajisup']),
					'insentif_jarak' => str_replace(",","",$_POST['insentifjarak']),
					'total' => str_replace(",","",$_POST['totalbiayakir'])
					);
				$exec= $db->insert("tx_brg_masuk_biaya", $data);
				$bikir=str_replace(",","",$_POST['totalbiayakir']);
				//dtl reti
				foreach($_POST['idret'] as $key => $vl){
						$data2 = array( 
						'stampdate' => date("Y-m-d H:i:s"),
						'no_sb' => $idgen,
						'tgl' => $tgl,
						'id_cus' => $valtmp['id_supp'],
						'id_retribusi' => $vl,
						'nilai' => str_replace(",","",$_POST['nilai'][$key]),
						'status' => 0,
						);
					$exec= $db->insert("tx_brg_masuk_biaya_r", $data2);
				}
				//dtl retri
		}else{
			$bikir=0;	
		} */
		//end insert biaya
		if($pps['jenis_aging']==2 || $pps['jenis_aging']==''){
		$data = array( 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => $tgl.' '.$his,
					'id_masuk' => $id, 
					'no_masuk' => $idgen,
					'stampdate' => date('Y-m-d H:i:s'),
					'id_gudang' => $valtmp['id_gudang'],
					'dari_gudang' => 0,
					'status' => 0,
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_ref' => $valtmp['id_po'],
					'no_ref' => $valtmp['no_po'],
					'id_supp' => $valtmp['id_supp'],
					'disc_persen' => $_POST['discg'],
					'total' => $_POST['total'],
					'kurs' => $valtmp['kurs'],
					'id_valuta' => $valtmp['id_valuta'],
					'line' => $valtmp['line'],
					'ket' => $_POST['ket'],
					'jenis' => $jen,
					'surat_jalan' => $_POST['surat_jalan'],
					'nopol' => $_POST['nopol'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					'term' => $term['term'],
					'jatuh_tempo' => date('Y-m-d', strtotime($term['term'].'days', strtotime($tgl)))
					);
		}elseif($pps['jenis_aging']==1){
		$data = array( 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => $tgl.' '.$his,
					'id_masuk' => $id, 
					'no_masuk' => $idgen,
					'stampdate' => date('Y-m-d H:i:s'),
					'id_gudang' => $valtmp['id_gudang'],
					'dari_gudang' => 0,
					'status' => 0,
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_ref' => $valtmp['id_po'],
					'no_ref' => $valtmp['no_po'],
					'id_supp' => $valtmp['id_supp'],
					'disc_persen' => $_POST['discg'],
					'total' => $_POST['total'],
					'kurs' => $valtmp['kurs'],
					'id_valuta' => $valtmp['id_valuta'],
					'line' => $valtmp['line'],
					'ket' => $_POST['ket'],
					'jenis' => $jen,
					'surat_jalan' => $_POST['surat_jalan'],
					'nopol' => $_POST['nopol'],
					'id_cabang' => $_SESSION['ID_CABANG'],
					);
		}
		
		$exec= $db->insert("tx_brg_masuk", $data);	
		//start auto jurnal total
		$idj=$db->nourut('NO_JURNAL', 'ak_jurnal', 'AJ', sprintf("%02s", $_SESSION['ID_CABANG']), date("Y-m-d"));
				$max=$db->select("ak_jurnal","max(IDJ)as id");
				foreach($max as $val){}
				$idn=$val['id']+1;
				$datajur = array(  
					   'IDJ' => $idn,
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
		$dttmp2=$db->select("tx_brg_masuk_tmp","*","id_user='$valtmp[id_user]' and id_gudang='$valtmp[id_gudang]' and jenis='$valtmp[jenis]'");
				$isi=0;
				$total=0;
				$jumlah=0;		
		foreach($dttmp2 as $valtmp2){					
		//=============================================copas===========================================================
				if($valtmp2['jenis']==5){
					$valtmp2['jenis']=2;	
				}else{
					$valtmp2['jenis']=$valtmp2['jenis'];	
				}
				//cek barang_unit
				$qtyter=($valtmp2['qty_terima']+$valtmp2['qty_bonus'])-$valtmp2['claim_utuh'];
				if($valtmp['jenis']==1 or $valtmp['jenis']==2 or $valtmp['jenis']==3){
					
					if($pps['pph']!=0){
						$th=$pps['pph']/100;	
					}else{
						$th=0;
					}
					if($pps[pkp]==1){
						$total_tmp=$qtyter*($valtmp2['harga_beli']/(1.11+$th));
						}
					else {
						if($th==0){
						$total_tmp=$qtyter*($valtmp2['harga_beli']);}
						else {
							$total_tmp=$qtyter*($valtmp2['harga_beli']/($th));
						}
						
					}
					
					//echo"$qtyter*($valtmp2['harga_beli]/(1.11+$th))";
				}else{
					$total_tmp=$qtyter*$valtmp2['harga_beli'];
				}
				//echo $qtyter.'-'.$valtmp2['harga_beli'].'-'.$valtmp['jenis'].'<br>';
				$ambilstok2=$db->select("m_barang_gudang","*","id_barang='$valtmp2[id_barang]' and id_gudang='$valtmp2[id_gudang]'");
				foreach($ambilstok2 as $ambilstok){}
				if($ambilstok[id_satuan]==$valtmp2[sat]){	
					$kon=1;
				}else{
					$cekbarang2=$db->select("m_konversi","*","id_barang='$ambilstok[id_barang]' and sat2='$valtmp2[sat]'");
					foreach($cekbarang2 as $cekbarang){}
					$kon=$cekbarang[konv];	
				}
				//=======================HPP===============================
				//====================persen ongkir dlu=======================
				//====================itung harga-disc dlu=======================
				$qty=$valtmp2['qty']*$kon;
				//$qty_terima=$valtmp2['qty_terima']*$kon;
				$qty_terima=(($valtmp2['qty_terima']+$valtmp2['qty_bonus'])-$valtmp2['claim_utuh']-$valtmp2['claim_ktg'])*$kon;
				$qty_ktg=$valtmp2['claim_ktg']*$kon;
				$qty2=$valtmp2['qty'];
				$qty_bonus2=$valtmp2['qty_bonus'];
				$qtytot=$qty2+$qty_bonus2;
				//$total=$_POST['total'][$key]; 
				$ongkir=str_replace(",","",$_POST['totalbiayakir']);
				if($ongkir==''){
					$ongkos_bag=0;
				}else{
					$totber=($valtmp2['qty_terima']*$kon)*$valtmp2['berat'];
					$parber=$totber/$_POST['totton'];
					$ongkos_bag=$ongkir*$parber;
				}
				//echo $_POST['totton'].' tes';
				//die();
				//====================================end hitung================
				//perhitungan harga bila ada bonus
				//if($valtmp2['qty_terima']>$valtmp2['qty']){
				if($qtyter>$valtmp2['qty']){
					//echo"perhitungan bila ada bonus";
					if($valtmp['jenis']==1 or $valtmp['jenis']==2 or $valtmp['jenis']==3){
						if($pps['pph']!=0){
							$th=$pps['pph']/100;	
						}else{
							$th=0;
						}
						
						if($pps[pkp]==1){
							$jumpes=$valtmp2['qty']*($valtmp2['harga_beli']/(1.11+$th));
							//'echo"<br> bila pkp $jumpes = $valtmp2[qty]*($valtmp2[harga_beli]/(1.11+$th))";
						}
						else{
							if($th==0){
								$jumpes=$valtmp2['qty']*($valtmp2['harga_beli']);
								//echo "<br> bila bukan pkp dan tidak ada pph $jumpes = $valtmp2[qty]*($valtmp2[harga_beli])";
							}
							else {
								$jumpes=$valtmp2['qty']*($valtmp2['harga_beli']/($th));
								//echo "<br> bila bukan pkp dan ada pph $jumpes = $valtmp2[qty]*($valtmp2[harga_beli]/($th)";
								
							}
						}
					}else{
						$jumpes=$valtmp2['qty']*$valtmp2['harga_beli'];
						//echo"<br> bila jenis tidak 1,2,3 $jumpes = $valtmp2[qty]*$valtmp2[harga_beli]";
					}
					
					$harga_beli=(($jumpes*$valtmp2['kurs'])/$valtmp2['qty'])/$kon; //DPP
					
					//echo"harga beli $harga_beli<br>";
					//$harga_beli_hithpp=((($jumpes*$valtmp2['kurs'])+$ongkos_bag)/$valtmp2['qty'])/$kon;
					$harga_beli_hithpp=((($jumpes*$valtmp2['kurs'])+$ongkos_bag)/$qty_terima)/$kon;
					$harga_beli_bm=($harga_beli/$valtmp2['kurs'])*$kon;
					$jum=$qty*(($harga_beli_bm*$valtmp2['kurs'])/$kon);
					$hbqty=$qty*$harga_beli;  //total jurnal
					//if($valtmp2['ppn']=='n'){ $ppn_jurnal=0;}else{$ppn_jurnal=$hbqty*11/100 ;} //ppn jurnal
					if($pps[pkp]=='2'){ $ppn_jurnal=0;}else{$ppn_jurnal=$hbqty*(11/100) ;} //ppn jurnal
						$total=$qty*$harga_beli; 
						$harga_beli=$total/$qty_terima;
						//echo $harga_beli."-".$total."-".$harga_beli_bm." var hbqty $hbqty<br>";
						//echo"ppn jurnal ga else $ppn_jurnal<br><br>";
						
						//end perhitungan bonus
						$qtykur=(($valtmp2['qty']+$valtmp2['qty_bonus'])-($valtmp2['qty_terima']+$valtmp2['qty_bonus']));
						$stokbarang=$ambilstok['stok']+$qty_terima;//stok akhir
						
						$totkali=$hbqty;
						
					}else{
					//echo"tidak ada bonus $qty_terima<br>";
					//$harga_beli=(($valtmp2['harga_beli']*$valtmp2['kurs'])/$qtyter)/$kon;
					$harga_beli=(($valtmp2['harga_beli']*$valtmp2['kurs']))/$kon;
					//"harga beli $harga_beli =(($total_tmp*$valtmp2[kurs])/$qtyter)/$kon<br>";
					//$harga_beli_hithpp=((($valtmp2['harga_beli']*$valtmp2['kurs'])+$ongkos_bag)/$qtyter)/$kon;
					if($pps[pkp]=='2'){ $ppn_jurnal=0;}else{$ppn_jurnal=$valtmp2['harga_beli']-($valtmp2['harga_beli']/1.11) ;} //ppn jurnal
					$harga_beli_hithpp=(((($valtmp2['harga_beli']-$ppn_jurnal)*$valtmp2['kurs'])+$ongkos_bag))/$kon;
					//echo $total_tmp.'-'.$qtyter.'-'.$ongkos_bag.'<br>';
					$harga_beli_bm=($harga_beli/$valtmp2['kurs'])*$kon;
					//$jum=$qty_terima*(($harga_beli_bm*$valtmp2['kurs'])/$kon);
					$jum=$qty_terima*(($harga_beli_bm*$valtmp2['kurs'])/$kon);
					$hbqty=$qty_terima*$harga_beli; 
					//echo"$qty_terima*$harga_beli<br>$hbqty<br>";
					if($pps[pkp]=='2'){ $ppn_jurnal=0;}else{$ppn_jurnal=$hbqty*(11/100); }
					$harga_beli=$harga_beli;
					//end perhitungan bonus
					$qtykur=(($valtmp2['qty']+$valtmp2['qty_bonus'])-($valtmp2['qty_terima']+$valtmp2['qty_bonus']));
					$stokbarang=$ambilstok['stok']+$qty_terima;//stok akhir
				
					$totkali=$hbqty-$ppn_jurnal;
					//echo"ppn jurnal elses $ppn_jurnal<br><br>";
				}////////// pehitungan harga bila ada bonus
				/*
				//end perhitungan bonus
				$qtykur=(($valtmp2['qty']+$valtmp2['qty_bonus'])-($valtmp2['qty_terima']+$valtmp2['qty_bonus']));
				$stokbarang=$ambilstok['stok']+$qty_terima;//stok akhir
				
				$totkali=$hbqty-$ppn_jurnal;
				*/
				//echo"$totkali = $hbqty-$ppn_jurnal <br> ";
				if($ambilstok['total']==0){
						$hpp=$harga_beli_hithpp; //harga beli doank  40 + 4
						//$hpp=$harga_beli + $ppn_hargabeli; //harga beli doank  40 + 4
						$totper=$hpp*$qty_terima;//harga beli kali qty  44*10000 440000
						//$totkali=($hpp + $ppn_hargabeli)* $qty_terima; //brgmasuk
				}else{
						$totaltbl_stok=$ambilstok['hpp']*$ambilstok['stok']; 
						
						$hpp=round(($totaltbl_stok+($qty_terima*$harga_beli_hithpp))/$stokbarang, 4);
						$hpp=round(($totaltbl_stok+($qty_terima*($harga_beli+$ppn_hargabeli)))/$stokbarang, 4);
						//echo"round(($totaltbl_stok+($qty_terima*$harga_beli_hithpp))/$stokbarang, 4) <br>";
						$totper=$hpp*$stokbarang;
						
						//$totkali=$qty_terima*($harga_beli+$ppn_hargabeli); //brgmasuk
				}
				//echo $harga_beli_hithpp;
				//die();
				//mysql_query("update barang_gudang set hpp='$hpp',total='$totper',stok='$stokbarang' where kd_brg='$value' and id_unit='$_POST[id_gud]'");
				//'total' => $totkali,
				$iddtl=$db->idurut("tx_brg_masuk_dtl","id_dtl");	
				$data2 = array( 		
						'id_dtl' => $iddtl,
						'id_masuk' => $id,
						'no_masuk' => $idgen,
						'id_barang' => $valtmp2['id_barang'],
						'qty' => $qtytot,
						'qty_terima' => $valtmp2['qty_terima']+$valtmp2['qty_bonus'],
						'claim_utuh' => $valtmp2['claim_utuh'],
						'claim_ktg' => $valtmp2['claim_ktg'],
						'qty_kurang' => $qtykur,
						'harga_beli' => $valtmp2['harga_beli'],
						'kurs' => $valtmp2[kurs],
						'ppn' => $ppn_jurnal,
						'total' => ($valtmp2['qty_terima']*$valtmp2['harga_beli'])/$kon,
						'total_kur' => $totkali,
						'status' => 1,
						'sat' => $valtmp2[sat],
					);
				$tppn+=$ppn_jurnal;
				$thutang+=$ppn_jurnal+$totkali;
				//echo"$thutang";
				$exec= $db->insert("tx_brg_masuk_dtl", $data2);
				include("jurnal_dtl.php");
				//die();
				//==========================prp=====================================================
				if($valtmp2['jenis']==1 or $valtmp2['jenis']==6 or $valtmp2['jenis']==7){
					$dtprp2=$db->select("tx_prp_dtl","*","no_prp='$valtmp2[no_prp]' and id_barang='$valtmp2[id_barang]'");
					foreach($dtprp2 as $dtprp){}
					$sumjum=$dtprp['qty_sisa']+$valtmp2['qty_terima'];
					if($qtykur==0){
						$data = array( 		
							'status' => 1,
							'qty_sisa' => $sumjum,
						);
						$exec= $db->update("tx_prp_dtl", $data,"id_dtl='$dtprp[id_dtl]'");
						//$sql="update prp_dtl$periode_trans set status='1',qty_sisa='$sumjum' where no_prp='$dtprp[NO_PRP]' and id_barang='$value'";
					}else{
						$data = array( 		
							'status' => 0,
							'qty_sisa' => $sumjum,
						);
						$exec= $db->update("tx_prp_dtl", $data,"id_dtl='$dtprp[id_dtl]'");	
					}
				}elseif($valtmp2['jenis']==2){
						$data = array( 		
							'status_tx' => 2,
						);
						$exec= $db->update("tx_rilis_dtl", $data,"no_spj='$valtmp2[no_prp]' and line_item='$valtmp2[line]'");
				}elseif($valtmp2['jenis']==3){
						$data = array( 		
							'status' => 4,

						);
						$exec= $db->update("tx_bm_order", $data,"no_order='$valtmp2[no_po]'");
				}elseif($valtmp2['jenis']==4){
						$data = array( 		
							'status' => 3,
						);
						$exec= $db->update("tx_brg_keluar", $data,"no_keluar='$valtmp2[no_po]'");
				}
				//========================end prp===================================================
				//update stok///////////////////////////////////////////
				//insert_mutasi(norefmutasi,kd_brg,idgudang,qty,hpp,jenis_mut,user,jenis)
				$masuk_mutasi=$db->masuk_mutasi($valtmp2['no_po'],$valtmp2['id_barang'],$valtmp2['id_gudang'],$qty_terima,$hpp,$valtmp2['id_user'],'0');
				if($qty_ktg>0){
					$masuk_mutasi2=$db->masuk_mutasi_r($valtmp2['no_po'],$valtmp2['id_barang'],$valtmp2['id_gudang'],$qty_ktg,$hpp,$valtmp2['id_user'],'0');			
				}
				////ambill mutasi
				$mutasi=$db->cek_mutasi_riject($valtmp2['id_barang'],$valtmp2['id_gudang']);
				if($mutasi['akhir']==''){
					$mutasi['akhir']=0;
				}else{
					$mutasi['akhir']=$mutasi['akhir'];
				}
				$totper=($stokbarang+$mutasi['akhir'])*$hpp;
				//end ambil
				$data = array( 		
						'hpp' => $hpp, 
						'total' => $totper, 
						'stok' => $stokbarang+$mutasi['akhir'],  
						); 
				$exec= $db->update("m_barang_gudang", $data,"id_barang='$valtmp2[id_barang]' and id_gudang='$valtmp2[id_gudang]'");
				//===========================TUTUP HPP=======================
				//end update stok
				$isi++;
				//cek disc lagi
				$totppn=$totppn+$ppn_jurnal;
				$jumlah=$jumlah+$jum;
				$totaljur=$totaljur+$totkali;
				$totalppnmasukan=$totalppnmasukan+$ppn_jurnal;
				$prp=$valtmp2['no_prp'];
				$po=$valtmp2['no_po'];
				$jenis=$valtmp2['jenis'];
				//hapus keranjang
				$where = array(
						"id_tmp" => $valtmp2['id_tmp']
						);
				$db->delete("tx_brg_masuk_tmp",$where);
				//===========================================================================copas===========================================================
		} 
		
			
			
			if($isi>0){	
				if($jenis==1 || $jenis==6 || $jenis==7 || $jenis==8){
					
					include("jurnal_lawan.php");
					
					$dtpo2=$db->select("tx_prp_dtl","count(*)as jum","no_prp='$prp' and status=0");
					foreach($dtpo2 as $dtpo)
					if($dtpo[jum]==0){
						$data = array( 		
							'status' => 2,
						);
						$exec= $db->update("tx_po", $data,"no_po='$po'");
					}
					//disc
					if($totppn>0){ 
						$ppn=$jumlah*11/100;
					}else{
						$ppn=0;
					}
					$total=$jumlah+$ppn;
					//disc
				}
			}
		
		
	  }
	}//end if jumlah
	}
	
	
	if($_POST['param']==''){
		$ck=$db->select("tx_brg_masuk a JOIN tx_brg_masuk_biaya_r b on a.no_masuk=b.no_sb","*","a.no_masuk='$idgen'");
						foreach($ck as $cek){}
						$s=count($ck);
	
			if($s!='0'){
		
		echo "<script>
		alert('Sukses Simpan Dengan No IM $idgen');

		window.location='index.php?x=brgmasuk2'</script>"; 
			}else{
			 if($pps['account']==0 && $valtmp['jenis']!=4){			
				 echo "<script>window.location='index.php?x=brgmasuk2'</script>";	 
			 }else{
				
				echo "<script>
				alert('Sukses Simpan Dengan No IM $idgen');
				window.location='index.php?x=brgmasuk2'</script>"; 
			 }
			
			}
	}else{
		 echo "<script>window.location='index.php?x=brgmasuk2'</script>"; 
	}
	}
?>