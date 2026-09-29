<?php
$tabel = "m_pegawai";
if($_POST[kode]==''){	
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
			$fot=$_FILES["foto"]["name"];
		
		$id=$db->idurut($tabel,"id_pegawai");
		/*$exp=explode("/",$_POST['ttl']);
		if($_POST['status_pegawai']==1){
			$nik="TKWA".sprintf("%03s", $id);
		}else{
			$nik="WA".substr($exp[2],0,2).sprintf("%03s", $id);
		}*/ 
		$data = array( 
				'id_pegawai' => $id, 
				'id_cabang' => $_POST['id_cabang'],
				'id_jabatan' => $_POST['id_jabatan'],
				'nik' => '',
				'nama_pegawai' => $_POST['nama_pegawai'],
				'jk' => $_POST['jk'],
				'tmp_lahir' => $_POST['tmp_lahir'],
				'tgl_lahir' => date("Y-m-d",strtotime($_POST['tgl_lahir'])),
				'no_ktp' => $_POST['no_ktp'],
				'foto' => $fot,
				);
		$exec= $db->insert($tabel, $data);		
		//acc=======================================
		$no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			$ids=$db->idurut("hr_pegawai_acc","id");
			$data = array( 
						'id' => $ids, 
						'id_peg' => $id,
						'no_rek' => $_POST['no_rek'][$key],
						'nama_bank' => $val,
						'jenis' => $_POST['jenis'][$key],
						'urut' => $no,
					 
					);
			$exec= $db->insert("hr_pegawai_acc", $data);	
		  }
		  $no++;
		}
		//finger=======================================
		$no=1;
		foreach($_POST['acno'] as $key => $val){
		  if($val!=''){
			$ids=$db->idurut("hr_finger","id");
			$data = array( 
						'id' => $ids, 
						'id_pegawai' => $id,
						'acno' => $val,
						'urut' => $_POST['urut'][$key],
					 
					);
			$exec= $db->insert("hr_finger", $data);	
		  }
		  $no++;
		}
		echo "<script>window.location='index.php?x=pegawai'</script>";
}else{
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
			$fot=$_FILES["foto"]["name"];
	
	$data = array( 
				'id_cabang' => $_POST['id_cabang'],
				'id_jabatan' => $_POST['id_jabatan'],
				'nik' => '',
				'nama_pegawai' => $_POST['nama_pegawai'],
				'jk' => $_POST['jk'],
				'tmp_lahir' => $_POST['tmp_lahir'],
				'tgl_lahir' => date("Y-m-d",strtotime($_POST['tgl_lahir'])),
				'no_ktp' => $_POST['no_ktp'],
				'foto' => $fot,
		 );
	$exec= $db->update($tabel, $data, "id_pegawai='$_POST[kode]'");
	$no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl_acc'][$key]==''){
					$id=$db->idurut("hr_pegawai_acc","id");
					$data = array( 
								'id' => $id, 
								'id_peg' => $_POST['kode'],
								'no_rek' => $_POST['no_rek'][$key],
								'nama_bank' => $val,
								'jenis' => $_POST['jenis'][$key],
								'urut' => $no,
							);
					$exec= $db->insert("hr_pegawai_acc", $data);
			   }else{
				    $id=$db->idurut("hr_pegawai_acc","id");
					$data = array( 
								'no_rek' => $_POST['no_rek'][$key],
								'nama_bank' => $val,
								'jenis' => $_POST['jenis'][$key],
							);
					$exec= $db->update("hr_pegawai_acc", $data,"id='".$_POST['id_dtl_acc'][$key]."'");
			   }
		  }
		  $no++;
		}
		//finger
		$no=1;
		foreach($_POST['acno'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl'][$key]==''){
					$id=$db->idurut("hr_finger","id");
					$data = array( 
								'id' => $id, 
								'id_pegawai' => $_POST['kode'],
								'acno' => $val,
								'urut' => $_POST['urut'][$key],
							);
					$exec= $db->insert("hr_finger", $data);
					
			   }else{
				    $id=$db->idurut("hr_finger","id");
					$data = array( 
								'acno' => $val,
								'urut' => $_POST['urut'][$key],
							);
					$exec= $db->update("hr_finger", $data,"id='".$_POST['id_dtl'][$key]."'");
			   }
		  }
		  $no++;
		}	
	
	echo "<script>window.location='index.php?x=pegawai'</script>";
}


?>