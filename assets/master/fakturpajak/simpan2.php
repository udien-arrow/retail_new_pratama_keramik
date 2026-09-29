<?php
$tabel = "tx_so";
$tabel_dtl = "tx_so_dtl";
$tabel_ntf = "tx_so_notif";
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
		if($i>1 && $emapData[3]!=''){
			$id=$db->idurut($tabel,"id_sales");		
			foreach($db->select("m_gudang_shipto","*","shipto_code='$emapData[13]'") as $gudv);
			foreach($db->select("m_barang","*","kode_barang_semen='$emapData[17]'") as $barv);
			
			if($gudv['id_gudang']==''){
				$idn=$db->idurut($tabel_ntf,"id");		
				$data = array( 
						'id' => $idn, 
						'sales_order' => $emapData[3], 
						'ket' => 'Gagal Upload!!, Kode Shipto '.$emapData[13].' belum didaftarkan. Silakan input dimaster gudang!', 
				);
				$exec= $db->insert($tabel_ntf, $data);
			}
			if($barv['id_barang']==''){
				$idn=$db->idurut($tabel_ntf,"id");		
				$data = array( 
						'id' => $idn, 
						'sales_order' => $emapData[3],
						'ket' => 'Gagal Upload!!, Kode Barang Supplier '.$emapData[17].' belum didaftarkan. Silakan input dimaster Barang!', 
				);
				$exec= $db->insert($tabel_ntf, $data);
			}
			if($gudv['id_gudang']!='' && $barv['id_barang']!=''){
				//==============================cek head so================================================
				$jum=count($db->select($tabel,"*","sales_order='$emapData[3]'"));
				if($jum==0){
					$data = array( 
						'id_sales' => $id, 
						'sales_order' => str_replace(",","",$emapData[3]), 
						'so_date' => str_replace(",","",date('Y-m-d',strtotime($emapData[4]))), 
						'incoterm' => str_replace(",","",$emapData[7]), 
						'district_code' => str_replace(",","",$emapData[11]), 
						'shipto_code' => str_replace(",","",$emapData[13]), 
						'id_gudang' => $gudv['id_gudang'],
						'id_supp' => $_POST['supp'],
						'id_user' => $_SESSION['ID_LOGIN'],  
					);
					$exec= $db->insert($tabel, $data);
				}//end if
				//==============================endcek head so================================================
				//==============================endcek dtl so================================================
				$jumd=count($db->select($tabel_dtl,"*","sales_order='$emapData[3]' and line='$emapData[25]'"));
				if($jumd==0){
					$iddtl=$db->idurut($tabel_dtl,"id_dtl");	
					$data = array( 
						'id_dtl' => $iddtl, 
						'sales_order' => str_replace(",","",$emapData[3]), 
						'delivery_date' => str_replace(",","",date('Y-m-d',strtotime($emapData[5]))), 
						'material_code' => str_replace(",","",$emapData[17]), 
						'id_barang' => $barv['id_barang'],
						'id_satuan' => $barv['id_satuan'],
						'so_qty' => str_replace(",","",$emapData[19]), 
						'real_qty' => str_replace(",","",$emapData[21]), 
						'so_open' => str_replace(",","",$emapData[22]), 
						'price' => str_replace(",","",$emapData[23]), 
						'line' => str_replace(",","",$emapData[25]),  
					);
					$exec= $db->insert($tabel_dtl, $data);
				}
				//==============================endcek dtl so================================================
			}//end if cek bar gud
		}
		$i++;
    }
    	fclose($file);
    	$jumn=count($db->select("tx_so_notif","*"));
		if($jumn==0){
    		echo "<script>window.location='index.php?x=up_so'</script>";
		}else{
			include('index_notif.php');
		}
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=up_so'</script>";
	}

?>