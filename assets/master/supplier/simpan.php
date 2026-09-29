<?php
$tabel = "m_supplier";
//echo $_POS['kode'].'a';
//die();

if($_POST[kode]==''){
		$dp=strtoupper(substr($_POST['nama_usaha'],0,3));
		$max=$db->select("m_supplier","max(substr(kode_supp, 4,3)) as id","substr(kode_supp,1,3)='$dp'");
		foreach($max as $val){}	
		
		//=======foto===============
		if ((($_FILES["foto"]["type"] == "image/png") || ($_FILES["foto"]["type"] == "image/jpg") || ($_FILES["foto"]["type"] == "image/jpeg")) && ($_FILES["foto"]["size"] < 5000000)) {
			
			if ($_FILES["foto"]["error"] > 0) {
			echo "Return Code: " . $_FILES["foto"]["error"] . "<br/><br/>";
			} else {
			
			if (file_exists("images/" . $_FILES["foto"]["name"])) {
				echo $_FILES["foto"]["name"] . " <b>already exists.</b> ";
			} else {
				move_uploaded_file($_FILES["foto"]["tmp_name"], "images/" . $_FILES["foto"]["name"]);
				$imgFullpath = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'. "images/" . $_FILES["foto"]["name"];

			}
			
			}
			} else {
			echo "<span>***Invalid file Size or Type***<span>";
		}
		//=======foto===============
		$idnya=(int)$val['id']+1;
		$idku=$dp.sprintf("%03s", $idnya);
		$idhead=$db->idurut("m_supplier","id_supp");
		$data = array( 
				 	'id_supp' => $idhead,
					'kode_supp' => $idku, 
				 	'id_kota' => $_POST['kota'],
					'nama_supp' => $_POST['nama_supp'],
					'ttl' => $_POST['ttl'],
					'jk' => $_POST['jk'],
					'alamat' => $_POST['alamat'],
					'bangsa' => $_POST['bangsa'],
					'pendidikan' => $_POST['pendidikan'],
					'no_telp' => $_POST['no_telp'],
					'no_hp' => $_POST['no_hp'],
					'nama_usaha' => $_POST['entitas_usaha'].". ".$_POST['nama_usaha'],
					'alamat_usaha' => $_POST['alamat_usaha'],
					'email1' => $_POST['email1'],
					'email2' => $_POST['email2'],
					'kabupaten' => $_POST['kabupaten'],
					'kota' => $_POST['kota'],
					'no_telp_usaha' => $_POST['no_telp_usaha'],
					'no_fax' => $_POST['no_fax'],
					'kode_pos' => $_POST['kode_pos'],
					'bidang_usaha' => $_POST['bidang_usaha'],
					'no_siup' => $_POST['no_siup'],
					'npwp' => $_POST['npwp'],
					'tdp' => $_POST['tdp'],
					'sppkp' => $_POST['sppkp'],
					'jenis_pemb' => $_POST['jenis_pemb'],
					'term' => $_POST['term'],
					'limit_plafon' => str_replace(",","",$_POST['limit_plafon']),
					'pkp' => $_POST['pkp'],
					'id_valuta' => $_POST['id_valuta'],
					'foto' => $_FILES['foto']['name'],
					'status' => 1,
					'pph' => $_POST['pph'],
					'account' => $_POST['account'],
					'account_pph' => $_POST['pphakun'],
					'utama' => $_POST['jenis_supp'],
					'jenis_supplier' => $_POST['utama']
				);
				
		$exec= $db->insert($tabel, $data);	
		//var_dump($data);	
		//die();
		//plafon
		$no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			$id=$db->idurut("m_supplier_acc","id");
			$data = array( 
						'id' => $id, 
						'id_supp' => $idhead,
						'no_rek' => $_POST['no_rek'][$key],
						'nama_bank' => $val,
						'jenis' => $_POST['jenis'][$key],
						'urut' => $no,
					 
					);
			$exec= $db->insert("m_supplier_acc", $data);	
			
		  }
		  $no++;
		}
		//end cus
		
		//die();
			
	echo "<script>window.location='index.php?x=supplier'</script>";
}else{
	//=======foto===============
		if ((($_FILES["foto"]["type"] == "image/png") || ($_FILES["foto"]["type"] == "image/jpg") || ($_FILES["foto"]["type"] == "image/jpeg")) && ($_FILES["foto"]["size"] < 5000000)) {
			
			if ($_FILES["foto"]["error"] > 0) {
			echo "Return Code: " . $_FILES["foto"]["error"] . "<br/><br/>";
			} else {
			
			if (file_exists("images/" . $_FILES["foto"]["name"])) {
				echo $_FILES["foto"]["name"] . " <b>already exists.</b> ";
			} else {
				move_uploaded_file($_FILES["foto"]["tmp_name"], "images/" . $_FILES["foto"]["name"]);
				$imgFullpath = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'. "images/" . $_FILES["foto"]["name"];

			}
			
			}
			} else {
			echo "<span>***Invalid file Size or Type***<span>";
		}
	$data = array( 
					'id_kota' => $_POST['kota'],
					'nama_supp' => $_POST['nama_supp'],
					'ttl' => $_POST['ttl'],
					'jk' => $_POST['jk'],
					'alamat' => $_POST['alamat'],
					'bangsa' => $_POST['bangsa'],
					'pendidikan' => $_POST['pendidikan'],
					'no_telp' => $_POST['no_telp'],
					'no_hp' => $_POST['no_hp'],					
					'nama_usaha' => $_POST['entitas_usaha'].". ".$_POST['nama_usaha'],
					'alamat_usaha' => $_POST['alamat_usaha'],
					'email1' => $_POST['email1'],
					'email2' => $_POST['email2'],
					'kabupaten' => $_POST['kabupaten'],
					'kota' => $_POST['kota'],
					'no_telp_usaha' => $_POST['no_telp_usaha'],
					'no_fax' => $_POST['no_fax'],
					'kode_pos' => $_POST['kode_pos'],
					'bidang_usaha' => $_POST['bidang_usaha'],
					'no_siup' => $_POST['no_siup'],
					'npwp' => $_POST['npwp'],
					'tdp' => $_POST['tdp'],
					'sppkp' => $_POST['sppkp'],
					'jenis_pemb' => $_POST['jenis_pemb'],
					'term' => $_POST['term'],
					'limit_plafon' => str_replace(",","",$_POST['limit_plafon']),
					'pkp' => $_POST['pkp'],
					'id_valuta' => $_POST['id_valuta'],
					'foto' => $_FILES['foto']['name'],
					'pph' => $_POST['pph'],
					'account' => $_POST['account'],
					'account_pph' => $_POST['pphakun'],
					'utama' => $_POST['utama'],
					'jenis_supplier' => $_POST['jenis_supp']
		 );
	$exec= $db->update($tabel, $data, "id_supp='$_POST[kode]'");
		//plafon
		$no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl_plafon'][$key]==''){
					$id=$db->idurut("m_supplier_acc","id");
					$data = array( 
								'id' => $id, 
								'id_supp' => $_POST['kode'],
								'no_rek' => $_POST['no_rek'][$key],
								'nama_bank' => $val,
								'jenis' => $_POST['jenis'][$key],
								'urut' => $no,
							);
					$exec= $db->insert("m_supplier_acc", $data);
			   }else{
				    $id=$db->idurut("m_supplier_acc","id");
					$data = array( 
								'no_rek' => $_POST['no_rek'][$key],
								'nama_bank' => $val,
								'jenis' => $_POST['jenis'][$key],
							);
					$exec= $db->update("m_supplier_acc", $data,"id='".$_POST['id_dtl_plafon'][$key]."'");
			   }
		  }
		  $no++;
		}
		//end cus
	
	echo "<script>window.location='index.php?x=supplier&cd=b2'</script>";
}


?>