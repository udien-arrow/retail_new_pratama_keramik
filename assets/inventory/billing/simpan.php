<?php
$tabel = "tx_billing";
$tabeldtl = "tx_billing_dtl";
if($_POST['jum']>0 && $_POST['billing']!=''){
	    	//headn
			foreach($db->select("m_supplier","term","id_supp='$_POST[supp]'")as $sp);
			$tgl=date("Y-m-d",strtotime($_POST['tgl']));
			
			$id=$db->idurut($tabel,"id_billing");
			$data = array( 
					'id_billing' => $id, 
					'no_billing' => $_POST['billing'],
					'tgl' => date("Y-m-d",strtotime($_POST['tgl'])),
					'id_user' => $_SESSION['ID_LOGIN'],
					'no_ref' => $_POST['noref'],
					'id_supp' => $_POST['supp'],
					'total_bil' => $_POST['total_bil'],
					'status' => 0,
					'jenis' => 0,
					'tgl_jt' => date('Y-m-d', strtotime($sp['term'].'days', strtotime($tgl))),
					'term' => $sp['term'],
					);
			$exec= $db->insert($tabel, $data);
			//end head
		foreach($_POST['no_spj'] as $key => $val){
			if($val){
				$iddtl=$db->idurut($tabeldtl,"id_dtl");
				$data = array( 
						'id_dtl' => $iddtl, 
						'id_billing' => $id,
						'no_billing' => $_POST['billing'],
						'no_masuk' => $_POST['no_masuk'][$key],
						'no_spj' => $val,
						'tgl_masuk' => $_POST['tgl_masuk'][$key],
						'id_barang' => $_POST['id_barang'][$key],
						'id_satuan' => $_POST['id_satuan'][$key],
						'qty' => $_POST['qty'][$key],
						'harga' => $_POST['harga'][$key],
						'total' => $_POST['total'][$key],
						'no_faktur2' => $_POST['nof'][$key],
						'id_cabang' => $_POST['id_cabang'][$key],
						'no_so' => '',
						);
				$exec= $db->insert($tabeldtl, $data);
			}
		}
		echo "<script>alert('Sukses simpan data'); window.location='index.php?x=billing_vn'</script>";
				
}else{
	echo "<script>
	alert('Data Belum Lengkap!');
	window.location='index.php?x=billing'</script>";
	
}


?>