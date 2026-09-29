<?php
$tabel = "m_customer";
//echo $_POS['kode'].'a';
//die();

if($_POST[kode]==''){
		$dp=strtoupper(substr($_POST['nama_usaha'],0,3));
		$max=$db->select("m_customer","max(substr(kode_cus, 4,3)) as id","substr(kode_cus,1,3)='$dp'");
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
		$idku=$dp.sprintf("%03s", $idnya).'000';
		$idhead=$db->idurut("m_customer","id_cus");
		$data = array( 
				 	'id_cus' => $idhead,
					'kode_cus' => $idku, 
				 	'id_cabang' => $_POST['cabang'],
					'entitas_usaha' => $_POST['entitas_usaha'],
					'nama_cus' => $_POST['nama_cus'],
					'ttl' => $_POST['ttl'],
					'no_ktp' => $_POST['no_ktp'],
					'jk' => $_POST['jk'],
					'alamat' => $_POST['alamat'],
					'bangsa' => $_POST['bangsa'],
					'pendidikan' => $_POST['pendidikan'],
					'status_rumah' => $_POST['status_rumah'],
					'no_telp' => $_POST['no_telp'],
					'no_hp' => $_POST['no_hp'],
					'nama_usaha' => $_POST['nama_usaha'],
					'alamat_usaha' => $_POST['alamat_usaha'],
					'email_usaha' => $_POST['email_usaha'],
					'status_tempat' => $_POST['status_tempat'],
					'menempati_sejak' => $_POST['menempati_sejak'],
					'no_telp_usaha' => $_POST['no_telp_usaha'],
					'bidang_usaha' => $_POST['bidang_usaha'],
					'no_siup' => $_POST['no_siup'],
					'npwp' => $_POST['npwp'],
					'tdp' => $_POST['tdp'],
					'stpg' => $_POST['stpg'],
					'akta_notaris' => $_POST['akta_notaris'],
					'npwp_pemilik' => $_POST['npwp_pemilik'],
					'email1' => $_POST['email1'],
					'email2' => $_POST['email2'],
					'kode_pos' => $_POST['kode_pos'],
					'no_fax' => $_POST['no_fax'],
					'kabupaten' => $_POST['kabupaten'],
					'foto' => $_FILES['foto']['name'],
					'nama_keluarga' => $_POST['nama_keluarga'],
					'hubungan_keluarga' => $_POST['hubungan_keluarga'],
					'alamat_keluarga' => $_POST['alamat_keluarga'],
					'no_telp_keluarga' => $_POST['no_telp_keluarga'],
					'no_hp_keluarga' => $_POST['no_hp_keluarga'],
					'no_telp_kantor' => $_POST['no_telp_kantor'],
					'nama_keluarga_rmh' => $_POST['nama_keluarga_rmh'],
					'no_telp_keluarga_rmh' => $_POST['no_telp_keluarga_rmh'],
					'hubungan_keluarga_rmh' => $_POST['hubungan_keluarga_rmh'],
					'jenis_kelamin_rmh' => $_POST['jenis_kelamin_rmh'],
					'ship_to' => $_POST['ship_to'],
					'status' => 1
				 
				);
		$exec= $db->insert($tabel, $data);	
		//acc
		$no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			$id=$db->idurut("m_customer_acc","id");
			$data = array( 
						'id' => $id, 
						'id_cus' => $idhead,
						'no_rek' => $_POST['no_rek'][$key],
						'nama_bank' => $val,
						'jenis' => $_POST['jenis'][$key],
						'urut' => $no,
					 
					);
			$exec= $db->insert("m_customer_acc", $data);	
			
		  }
		  $no++;
		}
		//plafon
		$no=1;
		foreach($_POST['limit_plafon'] as $key => $val){
		  if($val!=''){
			$id=$db->idurut("m_customer_plafon","id");
			$data = array( 
						'id' => $id, 
						'id_cus' => $idhead,
						'jenis_plafon' => $_POST['jenis_plafon'][$key],
						'limit_plafon' => $val,
						'tempo_pembayaran' => $_POST['tempo'][$key],
						'urut' => $no,
					 
					);
			$exec= $db->insert("m_customer_plafon", $data);	
			
		  }
		  $no++;
		}
		//end cus
		
		//die();
			
	echo "<script>window.location='index.php?x=customer'</script>";
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
					'id_cabang' => $_POST['cabang'],
					'entitas_usaha' => $_POST['entitas_usaha'],
					'nama_cus' => $_POST['nama_cus'],
					'ttl' => $_POST['ttl'],
					'no_ktp' => $_POST['no_ktp'],
					'jk' => $_POST['jk'],
					'alamat' => $_POST['alamat'],
					'bangsa' => $_POST['bangsa'],
					'pendidikan' => $_POST['pendidikan'],
					'status_rumah' => $_POST['status_rumah'],
					'no_telp' => $_POST['no_telp'],
					'no_hp' => $_POST['no_hp'],
					'nama_usaha' => $_POST['nama_usaha'],
					'alamat_usaha' => $_POST['alamat_usaha'],
					'email_usaha' => $_POST['email_usaha'],
					'status_tempat' => $_POST['status_tempat'],
					'menempati_sejak' => $_POST['menempati_sejak'],
					'no_telp_usaha' => $_POST['no_telp_usaha'],
					'bidang_usaha' => $_POST['bidang_usaha'],
					'no_siup' => $_POST['no_siup'],
					'npwp' => $_POST['npwp'],
					'tdp' => $_POST['tdp'],
					'stpg' => $_POST['stpg'],
					'akta_notaris' => $_POST['akta_notaris'],
					'nama_bank' => $_POST['nama_bank'],
					'no_rek' => $_POST['no_rek'],
					'jenis' => $_POST['jenis'],
					'nama_keluarga' => $_POST['nama_keluarga'],
					'hubungan_keluarga' => $_POST['hubungan_keluarga'],
					'alamat_keluarga' => $_POST['alamat_keluarga'],
					'no_telp_keluarga' => $_POST['no_telp_keluarga'],
					'no_hp_keluarga' => $_POST['no_hp_keluarga'],
					'no_telp_kantor' => $_POST['no_telp_kantor'],
					'nama_keluarga_rmh' => $_POST['nama_keluarga_rmh'],
					'no_telp_keluarga_rmh' => $_POST['no_telp_keluarga_rmh'],
					'hubungan_keluarga_rmh' => $_POST['hubungan_keluarga_rmh'],
					'jenis_kelamin_rmh' => $_POST['jenis_kelamin_rmh'],
					'ship_to' => $_POST['ship_to'],
					'foto' => $_FILES['foto']['name'],
		 );
	$exec= $db->update($tabel, $data, "id_cus='$_POST[kode]'");
		$no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl_acc'][$key]==''){
					$id=$db->idurut("m_customer_acc","id");
					$data = array( 
								'id' => $id, 
								'id_cus' => $_POST['kode'],
								'no_rek' => $_POST['no_rek'][$key],
								'nama_bank' => $val,
								'jenis' => $_POST['jenis'][$key],
								'urut' => $no,
							);
					$exec= $db->insert("m_customer_acc", $data);
			   }else{
				    $id=$db->idurut("m_customer_acc","id");
					$data = array( 
								'no_rek' => $_POST['no_rek'][$key],
								'nama_bank' => $val,
								'jenis' => $_POST['jenis'][$key],
							);
					$exec= $db->update("m_customer_acc", $data,"id='".$_POST['id_dtl_acc'][$key]."'");
			   }
		  }
		  $no++;
		}
		//plafon
		$no=1;
		foreach($_POST['limit_plafon'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl_plafon'][$key]==''){
					$id=$db->idurut("m_customer_plafon","id");
					$data = array( 
								'id' => $id, 
								'id_cus' => $_POST['kode'],
								'jenis_plafon' => $_POST['jenis_plafon'][$key],
								'limit_plafon' => $val,
								'tempo_pembayaran' => $_POST['tempo'][$key],
								'urut' => $no,
							 
							);
					$exec= $db->insert("m_customer_plafon", $data);
			   }else{
				    $id=$db->idurut("m_customer_plafon","id");
					$data = array( 
								'jenis_plafon' => $_POST['jenis_plafon'][$key],
								'limit_plafon' => $val,
								'tempo_pembayaran' => $_POST['tempo'][$key],
							);
					$exec= $db->update("m_customer_plafon", $data,"id='".$_POST['id_dtl_plafon'][$key]."'");
			   }
		  }
		  $no++;
		}
		//end cus
	
	echo "<script>window.location='index.php?x=customer&cd=b2'</script>";
}


?>