<?php
$tabel = "tx_prp";
$tabel_dtl = "tx_prp_dtl";
$tabel_ntf = "tx_po_notif";
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
		if($i>1 && $emapData[2]!=''){
			$id=$db->idurut($tabel,"id_prp");	
			//============cek shipto============================
			foreach($db->select("m_gudang_shipto a join m_gudang b on a.id_gudang=b.id_gudang","a.id_gudang,a.shipto_code,b.id_cabang","shipto_code='$emapData[8]'") as $gudv);
			if($gudv['id_gudang']==''){
					$idn=$db->idurut($tabel_ntf,"id");		
					$data = array( 
							'id' => $idn, 
							'sales_order' => $emapData[2], 
							'ket' => 'Gagal Upload!!, Kode Shipto '.$emapData[8].' belum didaftarkan. Silakan input dimaster gudang!', 
					);
					$exec= $db->insert($tabel_ntf, $data);
			}
			//============cek shipto============================
			foreach($db->select("m_barang","*","kode_barang_semen='$emapData[3]'") as $barv);
			if($barv['id_barang']==''){
				$idn=$db->idurut($tabel_ntf,"id");		
				$data = array( 
						'id' => $idn, 
						'sales_order' => $emapData[2],
						'ket' => 'Gagal Upload!!, Kode Barang Supplier '.$emapData[3].' belum didaftarkan. Silakan input dimaster Barang!', 
				);
				$exec= $db->insert($tabel_ntf, $data);
			}
			//========================================
			if($gudv['id_gudang']!='' && $barv['id_barang']!=''){
				//==============================cek head so================================================
				$jum=count($db->select($tabel,"*","no_jwa='$emapData[2]'"));
				if($jum==0){
					$total=0;
					$idgen=$db->nourut('no_prp', 'tx_prp', 'PP', sprintf("%02s",$_SESSION['ID_CABANG']), date("Y-m-d"));
					$id=$db->idurut("tx_prp","id_prp");
					$his=date('H:i:s');
					$data = array( 
					'id_prp' => $id, 
					'no_prp' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($emapData[1])).' '.$his,
					'duedate' => date('Y-m-d', strtotime('30 days', strtotime($emapData[1]))),	
					'ket' => $_POST['ket'],
					'id_gudang' => $gudv['id_gudang'],
					'id_cabang' => $gudv['id_cabang'],
					'id_supp' => $_POST['supp'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'no_order' => '',
					'jenis_p' => '1',
					'ket' => $_POST['ket'],
					'disc_persen' => '',
					'disc_jumlah' => '',
					'id_valuta' => '1',
					'kurs' => 1,
					'acc_code' => '',
					'id_daerah' => '',
					'shipto_code' => $emapData[8],
					'jenis_kirim' => $emapData[11],
					'st_upload' => 0,
					'status' => '1',
					'no_jwa' => $emapData[2],
					);
					$exec= $db->insert($tabel, $data);
					//==============================================po====================================================================
					$idgen2=$db->nourut('no_po', 'tx_po', 'PO', '00', date("Y-m-d"));
					$id2=$db->idurut("tx_po","id_po");
					$data = array( 
								'id_po' => $id2, 
								'no_po' => $idgen2, 
								'id_prp' => $id,
								'no_prp' => $idgen,
								'tgl_po' => date("Y-m-d",strtotime($emapData[1])).' '.$his,
								'duedate' => date('Y-m-d', strtotime('30 days', strtotime($emapData[1]))),	
								'jumlah' => '',
								'status' => 1,
								'id_supp' => $_POST['supp'],
								'id_gudang' => $gudv['id_gudang'],
								'id_cabang' => $gudv['id_cabang'],
								'id_user' => $_SESSION['ID_LOGIN'],
								'disc_persen' => '',
								'disc_jumlah' => '',
								'id_valuta' => '1',
								'jenis_p' => '1',
								'kurs' => '1',
								'acc_code' => '',	
								'shipto_code' => $emapData[8],	
								'st_upload' => '0',	
								'jenis_kirim' => $emapData[11],	
								'id_daerah' => '',	
								'no_jwa' => $emapData[2],
								);
					$exec= $db->insert("tx_po", $data);
				}//end if
				//==============================endcek head so================================================
				//==============================endcek dtl so================================================
				$jumd=count($db->select($tabel_dtl,"*","no_jwa='$emapData[2]' and kode_supp='$emapData[3]'"));
				if($jumd==0){
					$iddtl=$db->idurut($tabel_dtl,"id_dtl");	
					$data = array( 
							'id_dtl' => $iddtl, 
							'id_prp' => $id,
							'no_prp' => $idgen, 
							'id_barang' => $barv['id_barang'],
							'qty' => $emapData[5],
							'qty_sisa' => 0,
							'bonus' => 0,
							'sat' => $barv['id_satuan'],
							'harga_beli' => $emapData[6],
							'disc_persen' => 0,
							'disc_rupiah' => 0,
							'tgl_kirim' => date("Y-m-d",strtotime($emapData[10])),
							'kurs' => 1,
							'ppn' => 'n',
							'status' => 0,
							'no_jwa' => $emapData[2],
							'kode_supp' => $emapData[3],
							);
					$exec= $db->insert("tx_prp_dtl", $data);
					$total=$total+(($emapData[5]*$emapData[6]/10)+$emapData[5]*$emapData[6]);
				}
					$data = array( 
					'total' => $total, 
					);
					$exec= $db->update($tabel, $data,"no_jwa='$emapData[2]'");
					
					$data = array( 
					'jumlah' => $total, 
					);
					$exec= $db->update("tx_po", $data,"no_jwa='$emapData[2]'");
				
				$gudv['id_gudang']='';
				//==============================endcek dtl so================================================
			}//end if cek bar gud
		}
		$i++;
    }
    	fclose($file);
    	$jumn=count($db->select("tx_po_notif","*"));
		if($jumn==0){
    		echo "<script>window.location='index.php?x=po'</script>";
		}else{
			include('index_notif.php');
		}
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=po'</script>";
	}

?>