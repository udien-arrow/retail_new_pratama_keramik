<?php
		//==============jurnal qty terima========

				$dpp=$valtmp['hpp'];
				$hrgbeli=$dpp*$valtmp['qty_kembali'];
				//====jurnal=================
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","inventory","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Penjualan (persediaan)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//jurnal lawan
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","cogs","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['cogs'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Penjualan (persediaan)",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//jurnal lawan
			//====jurnal=================
				$dpp2=$valtmp['harga_jual']/1.1;
				$hrgbeli2=$dpp2*$valtmp['qty_kembali'];
				
				$ppn=$dpp2*(10/100)*$valtmp['qty_kembali'];	
				
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","sales","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				
				$tppn+=$ppn;
				$thutang+=$ppn+$hrgbeli2;
				
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['sales'],
							   'DEBET' => $hrgbeli2,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Retur Penjualan",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $idgen,
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);	
		
?>