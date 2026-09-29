<?php
$dttmp=$db->select("tx_brg_masuk_tmp","id_user,id_gudang,no_po,id_po,id_supp,kurs,id_valuta,line,jenis","id_user='$_SESSION[ID_LOGIN]' and id_gudang='$_SESSION[ID_GUDANG]' and jenis='$_POST[jenis_in]' group by id_gudang,jenis");

	foreach($dttmp as $valtmp){	
	  $his=date('H:i:s');	
	  $tgl=date("Y-m-d",strtotime($_POST['tgl']));  
	  if($valtmp['id_user']<>''){ 
	  			if($valtmp['jenis']==5 or $valtmp['jenis']==6 or $valtmp['jenis']==7){
					$jen=1;	
				}else{
					$jen=$valtmp['jenis'];	
				}
				
		$idgen=$db->nourut('no_masuk', 'tx_brg_masuk', 'IM', sprintf("%02s", $_SESSION['ID_CABANG']), date('Y-m-d'));
		$id=$db->idurut("tx_brg_masuk","id_masuk");		
		//echo $id; 
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
					'id_cabang' => $_SESSION['ID_CABANG'],
					);
		$exec= $db->insert("tx_brg_masuk", $data);	
		
		$dttmp2=$db->select("tx_brg_masuk_tmp","*","id_user='$valtmp[id_user]' and id_gudang='$valtmp[id_gudang]'");
				$isi=0;
				$total=0;
				$jumlah=0;		
		foreach($dttmp2 as $valtmp2){					//===========================================================================copas===========================================================
				if($valtmp2['jenis']==5){
					$valtmp2['jenis']=2;	
				}else{
					$valtmp2['jenis']=$valtmp2['jenis'];	
				}
				//cek barang_unit
				$qtyter=$valtmp2['qty_terima']-$valtmp2['claim_utuh'];
				$total_tmp=$qtyter*$valtmp2['harga_beli'];
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
				$qty_terima=($valtmp2['qty_terima']-$valtmp2['claim_utuh']-$valtmp2['claim_ktg'])*$kon;
				$qty_ktg=$valtmp2['claim_ktg']*$kon;
				$qty2=$valtmp2['qty'];
				$qty_bonus2=$valtmp2['qty_bonus'];
				$qtytot=$qty2+$qty_bonus2;
				//$total=$_POST['total'][$key]; 
				if($_POST['total_ongkos']==''){
					$ongkos_bag=0;
				}else{
					/*$ongkos=str_replace(",","",$_POST['total_ongkos']);
					$ongkos_bag=$ongkos/$_POST['count'];*/
					$ongkos_bag=0;
				}
				//====================================end hitung================
				//perhitungan harga bila ada bonus
				//if($valtmp2['qty_terima']>$valtmp2['qty']){
				if($qtyter>$valtmp2['qty']){
					$jumpes=$valtmp2['qty']*$valtmp2['harga_beli'];
					$harga_beli=((($jumpes*$valtmp2['kurs'])+$ongkos_bag)/$valtmp2['qty'])/$kon;
					$harga_beli_bm=($harga_beli/$valtmp2['kurs'])*$kon;
					$jum=$qty*(($harga_beli_bm*$valtmp2['kurs'])/$kon);
					$hbqty=$qty*$harga_beli;  //total jurnal
					if($valtmp2['ppn']=='n'){ $ppn_jurnal=0;}else{$ppn_jurnal=$hbqty/10 ;} //ppn jurnal
						$total=$qty*$harga_beli; 
						$harga_beli=$total/$qty_terima;
						//echo $harga_beli."-".$total."-".$harga_beli_bm."<br>";
				}else{
					$harga_beli=((($total_tmp*$valtmp2['kurs'])+$ongkos_bag)/$qtyter)/$kon;
					$harga_beli_bm=($harga_beli/$valtmp2['kurs'])*$kon;
					$jum=$qty_terima*(($harga_beli_bm*$valtmp2['kurs'])/$kon);
					$hbqty=$qty_terima*$harga_beli; 
					if($valtmp2['ppn']=='n'){ $ppn_jurnal=0;}else{$ppn_jurnal=$hbqty/10; }
					$harga_beli=$harga_beli;
				}////////// pehitungan harga bila ada bonus
				//end perhitungan bonus
				$qtykur=(($valtmp2['qty']+$valtmp2['qty_bonus'])-$valtmp2['qty_terima']);
				$stokbarang=$ambilstok['stok']+$qty_terima;//stok akhir
				$totkali=$hbqty+$ppn_jurnal;
				if($ambilstok['total']==0){
						$hpp=$harga_beli; //harga beli doank  40 + 4
						//$hpp=$harga_beli + $ppn_hargabeli; //harga beli doank  40 + 4
						$totper=$hpp*$qty_terima;//harga beli kali qty  44*10000 440000
						//$totkali=($hpp + $ppn_hargabeli)* $qty_terima; //brgmasuk
				}else{
						$totaltbl_stok=$ambilstok['hpp']*$ambilstok['stok']; 
						$hpp=round(($totaltbl_stok+($qty_terima*$harga_beli))/$stokbarang, 4);
						//$hpp=round(($totaltbl_stok+($qty_terima*($harga_beli+$ppn_hargabeli)))/$stokbarang, 4);
						$totper=$hpp*$stokbarang;
						//$totkali=$qty_terima*($harga_beli+$ppn_hargabeli); //brgmasuk
				}
				//mysql_query("update barang_gudang set hpp='$hpp',total='$totper',stok='$stokbarang' where kd_brg='$value' and id_unit='$_POST[id_gud]'");
				$data = array( 		
						'hpp' => $hpp, 
						'total' => $totper, 
						'stok' => $stokbarang,  
						);
				$exec= $db->update("m_barang_gudang", $data,"id_barang='$valtmp2[id_barang]' and id_gudang='$valtmp2[id_gudang]'");
				//die();
				//===========================TUTUP HPP=======================
				//$sqldetil="INSERT INTO brg_masuk_dtl$periode(no_masuk,kd_brg,qty,qty_terima,qty_kurang,harga_beli,ppn,total,status,sat,kurs) VALUES ('$id','$value','".$qtytot."','".$_POST[qty_terima][$key]."','$qtykur','".$harga_beli_bm."','$ppn_jurnal','$totkali','1','".$_POST[sat][$key]."','".$_POST[kurs][$key]."')";	
				$iddtl=$db->idurut("tx_brg_masuk_dtl","id_dtl");	
				$data2 = array( 		
						'id_dtl' => $iddtl,
						'id_masuk' => $id,
						'no_masuk' => $idgen,
						'id_barang' => $valtmp2['id_barang'],
						'qty' => $qtytot,
						'qty_terima' => $valtmp2['qty_terima'],
						'claim_utuh' => $valtmp2['claim_utuh'],
						'claim_ktg' => $valtmp2['claim_ktg'],
						'qty_kurang' => $qtykur,
						'harga_beli' => $harga_beli_bm,
						'kurs' => $valtmp2[kurs],
						'ppn' => $ppn_jurnal,
						'total' => $totkali,
						'status' => 1,
						'sat' => $valtmp2[sat],
					);
				$exec= $db->insert("tx_brg_masuk_dtl", $data2);
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
						//$sql="update prp_dtl$periode_trans set status='0',qty_sisa='$sumjum' where no_prp='$dtprp[NO_PRP]' and id_barang='$value'";		
					}
				}elseif($valtmp2['jenis']==2){
						/*$data = array( 		
							'status_tx' => 2,
						);
						$exec= $db->update("tx_upload_so", $data,"sales_order='$valtmp2[no_po]' and line='$valtmp2[line]'");
						*/
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
				if($jenis==1 || $jenis==6 || $jenis==7){
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
						$ppn=$jumlah/10;
					}else{
						$ppn=0;
					}
					$total=$jumlah+$ppn;
					//include("jurnal_lawan.php");
					//disc
				}
			}
		
		
	  }
	}//end if jumlah
	if($_POST['param']==''){
		echo "<script>window.location='index.php?x=brg_masuk'</script>";
	}else{
		echo "<script>window.location='index.php?x=brg_masuk_transit'</script>";
	}
?>