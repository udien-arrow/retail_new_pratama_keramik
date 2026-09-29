<?php
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
			$id=$db->idurut($tabel,"id_sales");	
			$gudv['id_gudang']='';	
			foreach($db->select("m_gudang_shipto","*","shipto_code='$emapData[22]'") as $gudv);
			if($gudv['id_gudang']==''){
				foreach($db->select("m_customer","ship_to","ship_to='$emapData[22]'") as $cusv);
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
						'no_polisi' => str_replace(",","",$emapData[18]), 
						'kode_shipto' => str_replace(",","",$emapData[22]), 
						'kode_distrik' => str_replace(",","",$emapData[25]), 
						'id_supp' => $_POST['supp'],
						'id_user' => $_SESSION['ID_LOGIN'],  
						'jenis' => $jenis,  
						'st_upload' => $_POST['st_upload'],  
					);
					$exec= $db->insert($tabel, $data);
				}//end if
				//==============================endcek head so================================================
				//==============================endcek dtl so================================================
				$jumd=count($db->select($tabel_dtl,"*","no_so='$emapData[4]' and no_spj='$emapData[14]'"));
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
    		echo "<script>window.location='index.php?x=up_rilis'</script>";
		}else{
			include('index_notif.php');
		}
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=up_rilis'</script>";
	}

?>