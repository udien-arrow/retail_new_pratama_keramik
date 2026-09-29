<?php
		//==============jurnal qty terima========
				$dpp=$hpp;
				$hrgbeli=$dpp*$qty;
				//====jurnal=================
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","intransitcabang","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				$dttime=date("Y-m-d H:i:s");
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['intransitcabang'],
							   'DEBET' => $hrgbeli,
							   'KREDIT' => "0",
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Pengeluaran Transit Barang",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $_POST['id'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				
				//var_dump($datajur);
				//jurnal lawan
				$ba=$db->select("m_barang a join m_grup b on a.id_grup=b.id_grup","inventory","a.id_barang='$valtmp[id_barang]'");
				foreach($ba as $bar){}
				$datajur = array(  'NO_JURNAL' => $idj, 
							   'ACC_CODE' => $bar['inventory'],
							   'DEBET' => 0,
							   'KREDIT' => $hrgbeli,
							   'USD' => "0",
							   'KURS' => "0",
							   'KET_DTL' => "Auto Jurnal Pengeluaran Transit Barang",
							   'TGL_JURNAL' => date("Y-m-d"),
							   'TANGGAL' => $dttime,
							   'ID_CAB' => $_SESSION['ID_CABANG'],
							   'NO_INVOICE' => $_POST['id'],
							   'ID_GUD' => $valtmp['id_gudang'],
							  );
				$execjur= $db->insert("ak_jurnal_dtl", $datajur);
				//jurnal lawan
				echo"jurnal dtl <br>";

?>