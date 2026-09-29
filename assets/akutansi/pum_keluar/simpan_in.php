<?php
$dttmp=$db->select("tx_prp_tmp","id_user,id_supp,no_order,jenis_barang,id_daerah,shipto_code,jenis_kirim","id_user='$_SESSION[ID_LOGIN]' and id_supp='$_POST[id_supp]' group by id_supp");
	foreach($dttmp as $valtmp){	
	
		$tgl=date("Y-m-d",strtotime($_POST['tgl']));
	  if($valtmp['id_user']<>''){ 
		$idgen=$db->nourut('no_prp', 'tx_prp', 'PP', '00', date("Y-m-d"));
		$id=$db->idurut("tx_prp","id_prp");
		$his=date('H:i:s');
		
		foreach($db->select("m_gudang","id_cabang","id_gudang='$_POST[gudang]'")as $cab);
		
		$data = array( 
					'id_prp' => $id, 
					'no_prp' => $idgen, 
					'stampdate' => date('Y-m-d H:i:s'),
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])).' '.$his,
					'duedate' => date("Y-m-d",strtotime($_POST['duedate'])),
					'ket' => $_POST['ket'],
					'id_gudang' => $_POST['gudang'],
					'id_cabang' => $cab['id_cabang'],
					'id_supp' => $_POST['id_supp'],
					'id_user' => $valtmp['id_user'],
					'no_order' => $valtmp['no_order'],
					'jenis_p' => $valtmp['jenis_barang'],
					'ket' => $_POST['ket'],
					'disc_persen' => $_POST['dg_persen'],
					'disc_jumlah' => $_POST['dg_rupiah'],
					'total' => $_POST['grant'],
					'id_valuta' => $_POST['id_valuta'],
					'kurs' => $_POST['kurs'],
					'acc_code' => $_POST['rekening'],
					'id_daerah' => $_POST['id_daerah'],
					'shipto_code' => $_POST['shipto_code'],
					'jenis_kirim' => $_POST['jenkir'],
					'st_upload' => $_POST['st_upload'],
					'status' => '0',
					);
		$exec= $db->insert("tx_prp", $data);

		$dttmp2=$db->select("tx_prp_tmp","*","id_user='$valtmp[id_user]' and id_supp='$valtmp[id_supp]'");
		foreach($dttmp2 as $valtmp2){
			$iddtl=$db->idurut("tx_prp_dtl","id_dtl");
			if($_POST['ppn']>0){$ppn="y";}else{$ppn="n";}
			if($valtmp2['tgl_kirim']==''){
				//$tgl="";	
			}else{
				$tgl=date("Y-m-d",strtotime($valtmp2['tgl_kirim']));	
			}
			$data = array( 
					'id_dtl' => $iddtl, 
					'id_prp' => $id,
					'no_prp' => $idgen, 
					'id_barang' => $valtmp2['id_barang'],
					'qty' => $valtmp2['qty'],
					'qty_sisa' => 0,
					'bonus' => $valtmp2['bonus'],
					'sat' => $valtmp2['sat'],
					'harga_beli' => $valtmp2['harga_beli'],
					'disc_persen' => $valtmp2['disc'],
					'disc_rupiah' => $valtmp2['disc_rupiah'],
					'tgl_kirim' => $valtmp2['tgl_kirim'],
					'kurs' => $_POST['kurs'],
					'ppn' => $ppn,
					'status' => 0,
					);
			$exec= $db->insert("tx_prp_dtl", $data);
		
			//==update notif=======
			if($valtmp2['jenis']==3){
				/*$data = array( 
						'status' => 1, 
						);
				$exec= $db->update("tx_prp_notif", $data,"id_barang='$valtmp2[id_barang]' and id_gudang='$_POST[gudang]'");
				*/
				$where = array( 
						'id_barang' => $valtmp2['id_barang'], 
						'id_gudang' => $_POST['gudang'], 
						);
				$exec= $db->delete("tx_prp_notif", $where);
			}elseif($valtmp2['jenis']==2){
				/*$data = array( 
						'status' => 1, 
						);
				$exec= $db->update("tx_order_dtl", $data,"id_barang='$valtmp2[id_barang]'");*/
			}
			//==update order===========
			//==end update order=======
			$where = array(	 "id_user" => $valtmp['id_user'],
							 "id_supp" => $valtmp['id_supp']);
			$db->delete("tx_prp_tmp",$where);
		}//en for
		
		if($valtmp['no_order']!=''){
			/*$cekorddtl=$db->select("tx_order_dtl","count(*)as jum","no_order='$valtmp[no_order]' and status=0");
			foreach($cekorddtl as $valj){}
			if($valj['jum']==0){*/
				$data = array( 
						'status' => 1, 
						);
				$exec= $db->update("tx_order", $data,"no_order='$valtmp[no_order]'");	
			//}
		}
		
	  }//end if jumlah
	}//end for
    echo "<script>alert('Sukses Simpan Data Dengan Nomer PP $idgen'); window.location='index.php?x=prp'</script>";
    ?>