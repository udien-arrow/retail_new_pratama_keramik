<?php
$tabel = "tx_billing";
$tabel_dtl = "tx_billing_dtl";
$tabel_ntf = "tx_billing_notif";
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
		if($i>1 && $emapData[1]!=''){
			$id=$db->idurut($tabel,"id_billing");		
			foreach($db->select("m_gudang_shipto","*","shipto_code='$emapData[8]'") as $gudv);
			foreach($db->select("m_barang","*","kode_barang_semen='$emapData[11]'") as $barv);
			
			if($gudv['id_gudang']==''){
				$idn=$db->idurut($tabel_ntf,"id");		
				$data = array( 
						'id' => $idn, 
						'sales_order' => $emapData[3], 
						'ket' => 'Gagal Upload!!, Kode Shipto '.$emapData[8].' belum didaftarkan. Silakan input dimaster gudang!', 
				);
				$exec= $db->insert($tabel_ntf, $data);
			}
			if($barv['id_barang']==''){
				$idn=$db->idurut($tabel_ntf,"id");		
				$data = array( 
						'id' => $idn, 
						'sales_order' => $emapData[3],
						'ket' => 'Gagal Upload!!, Kode Barang Supplier '.$emapData[11].' belum didaftarkan. Silakan input dimaster Barang!', 
				);
				$exec= $db->insert($tabel_ntf, $data);
			}
			if($gudv['id_gudang']!='' && $barv['id_barang']!=''){
				//==============================cek head so================================================
				$jum=count($db->select($tabel,"*","no_billing='$emapData[1]'"));
				if($jum==0){
					$data = array( 
						'id_billing' => $id, 
						'no_billing' => str_replace(",","",$emapData[1]), 
						'tgl' => str_replace(",","",date('Y-m-d',strtotime($emapData[2]))),
						'id_supp' => $_POST['supp2'], 
						'no_ref' => '', 
						'status' => 0, 
						'id_user' => $_SESSION['ID_LOGIN'], 
						'jenis' => 1, 
					);
					$exec= $db->insert($tabel, $data);
				}//end if
				//==============================endcek head so================================================
				//==============================endcek dtl so================================================
				$jumd=count($db->select($tabel_dtl,"*","no_billing='$emapData[1]' and no_spj='$emapData[3]'"));
				if($jumd==0){
					$iddtl=$db->idurut($tabel_dtl,"id_dtl");	
					$data = array( 
						'id_dtl' => $iddtl,
						'no_billing' => str_replace(",","",$emapData[1]),
						'no_masuk' => '',
						'no_so' => str_replace(",","",$emapData[7]),
						'tgl_masuk' => '',
						'no_spj' => str_replace(",","",$emapData[3]),
						'id_barang' => $barv['id_barang'],
						'id_satuan' => $barv['id_satuan'],
						'qty' => str_replace(",","",$emapData[13]),
						'harga' => str_replace(",","",$emapData[15]),
						'total' => str_replace(",","",$emapData[18]), 
					);
					$exec= $db->insert($tabel_dtl, $data);
				}
				//==============================endcek dtl so================================================
					foreach($db->select($tabel_dtl,"sum(total)as totalan","no_billing='$emapData[1]'") as $jumbv);
					$data = array( 
						'total_bil' => $jumbv['totalan'], 
					);
					$exec= $db->update($tabel, $data,"no_billing='$emapData[1]'");
					
			}//end if cek bar gud
		}
		$i++;
    }
    	fclose($file);
    	$jumn=count($db->select("tx_billing_notif","*"));
		if($jumn==0){
    		echo "<script>alert('Sukses Upload Data!'); window.location='index.php?x=billing'</script>";
		}else{
			include('index_notif.php');
		}
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=billing'</script>";
	}

?>