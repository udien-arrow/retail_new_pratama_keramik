<?php

$tabel = "ex_expediture";
$tabel_dtl = "ex_expediture_dtl";
$tabel_ntf = "ex_expediture_notif";
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
	$tgl=date("Y-m-d");
	$idgen=$db->nourut('no_expediture', 'ex_expediture', 'EX', sprintf("%02s", $_SESSION['ID_CABANG']), $tgl);
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
		//============cek shipto============================
		if($i>1 && $emapData[5]!=''){
			$id=$db->idurut($tabel,"id_prp");	
			foreach($db->select("m_gudang_shipto a join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,a.shipto_code,b.id_cabang","shipto_code='$emapData[5]'") as $gudv);
			if($gudv['id_gudang']==''){
				
					$idn=$db->idurut($tabel_ntf,"id");		
					$data = array( 
							'id' => $idn, 
							'sales_order' => $emapData[2], 
							'ket' => 'Gagal Upload!!, Kode Shipto '.$emapData[5].' belum didaftarkan. Silakan input dimaster gudang!', 
					);
					$exec= $db->insert($tabel_ntf, $data);
			}
		}
		if($i>1 && $emapData[6]!=''){
			$id=$db->idurut($tabel,"id_prp");	
			foreach($db->select("m_barang","*","kode_barang_semen='$emapData[6]'") as $barv);
			
			if($barv['id_barang']==''){
				$idn=$db->idurut($tabel_ntf,"id");		
				$data = array( 
						'id' => $idn, 
						'sales_order' => $emapData[2],
						'ket' => 'Gagal Upload!!, Kode Barang Supplier '.$emapData[6].' belum didaftarkan. Silakan input dimaster Barang!', 
				);
				$exec= $db->insert($tabel_ntf, $data);
			}
		}
		if($gudv['id_gudang']!='' && $barv['id_barang']!=''){
			$idd=$db->idurut($tabel_dtl,"id");		
				$data = array( 
						'id_dtl' => $idd, 
						'no_expediture' => $idgen,
						'id_barang' => $barv['id_barang'], 
						'qty' => $emapData[7],
						'berat' => $barv['berat'],
						//'nilai_ao' => $emapData[2],
						'status' => 0,
						'id_satuan' => $barv['id_satuan'],
						'id_gudang' => $gudv['id_gudang'],
				);
				$exec= $db->insert($tabel_dtl, $data);
			$sh=$db->select("m_gudang_shipto","*","shipto_code='$emapData[5]'");
			foreach($sh as $ship){}
			$gud=$db->select("m_gudang_shipto a join m_gudang b on a.id_gudang=b.id_gudang join ex_lokasi_kirim c on b.id_cabang=c.kota","c.id","a.shipto_code='$ship[shipto_code]'");
			foreach($gud as $guds){}
			$tar=$db->select("(select * from ex_tarif_oa order by tgl_berlaku desc) as aku join ex_lokasi_kirim b on aku.id_lokasi=b.id","aku.*,b.lokasi_kirim,b.kota","aku.status='1' and aku.id_lokasi='$guds[id]' group by aku.id_supp");
			foreach($tar as $rif){}
			$ken=$db->select("m_kendaraan","*","nopol='$emapData[4]'");
			foreach($ken as $da){}
			$nilai=$emapData[7]*$barv['berat']*$rif['tarif_oa'];
			$totaloa=$totaloa+($nilai=$emapData[7]*$barv['berat']*$rif['tarif_oa']);
			$no_so=$emapData[2];
			$no_spj=$emapData[3];
			$tgl=$emapData[1];
		}
	$i++;}
	if($gudv['id_gudang']!='' && $barv['id_barang']!=''){
		
			$idb=$db->idurut("ex_expediture_biaya_dtl","id");
			$data = array( 
					'id' => $idb, 
					'no_expediture' => $idgen,
					'tgl' => date("Y-m-d",strtotime($tgl)),
					'stampdate' => date('Y-m-d H:i:s'),
					'id_user' => $_SESSION['ID_LOGIN'],
					'gaji_sopir' => $rif['gaji_sopir'],
					'gaji_kernet' => $rif['gaji_kernet'],
					'ujs' => $rif['ujs'],
					'kosongan' => $rif['kosongan'],
					'premi' => $rif['premi'],
					);
			$exec= $db->insert("ex_expediture_biaya_dtl", $data);
			
			$idd=$db->idurut($tabel,"id_expediture");		
				$data = array( 
						'id_expediture' => $idd, 
						'no_expediture' => $idgen,
						'tgl' => date("Y-m-d",strtotime($tgl)), 
						'stampdate' => date("Y-m-d H:i:s"),
						'no_so' => $no_so,
						'no_spj' => $no_spj,
						'status' => 0,
						'id_lokasi' => $guds['id'],
						'tarif_ao' => $rif['tarif_oa'],
						'total_ao' => $totaloa,
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_supp' => $_POST['supp'],
						'id_kendaraan' => $da['id'],
				);
				$exec= $db->insert($tabel, $data);
				$data = array( 
					'nilai_ao' => $nilai,
					);
			$exec= $db->update("ex_expediture_dtl", $data,"no_expediture='$idgen'");
			echo "<script>
		window.location='index.php?x=txex'</script>";
		}
		fclose($file);
    	$jumn=count($db->select("tx_po_notif","*"));
		if($jumn==0){
    		echo "<script>window.location='index.php?x=txex'</script>";
		}else{
			include('index_notif.php');
		}
	}else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=txex'</script>";
	}

?>