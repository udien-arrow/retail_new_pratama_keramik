<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();

$tabel = "m_pegawai";
if ($_GET['jen']=='pegawai')
{
		if($_POST['kode']==''){
			$id=$db->idurut($tabel,"id_pegawai");
			$data = array( 
					'id_pegawai' => $id, 
					'id_agama' => $_POST['id_agama'],
					'nama_pegawai' => $_POST['namanya'],
					'jk' => $_POST['jk'],
					'tmp_lahir' => $_POST['tmp_lahir'],
					'tgl_lahir' => date("Y-m-d",strtotime($_POST['tgl_lahir'])),
					'no_ktp' => $_POST['no_ktp'],
					'email' => $_POST['email'],
					'npwp' => $_POST['npwp'],
					'no_jamsostek' => $_POST['jamsostek'],
					'nohp' => $_POST['nohp'],
					);
			$exec= $db->insert($tabel, $data);	
			echo $id;
		}else{
			$data = array( 
					'id_agama' => $_POST['id_agama'],
					'nama_pegawai' => $_POST['namanya'],
					'jk' => $_POST['jk'],
					'tmp_lahir' => $_POST['tmp_lahir'],
					'no_ktp' => $_POST['no_ktp'],
					'email' => $_POST['email'],
					'npwp' => $_POST['npwp'],
					'no_jamsostek' => $_POST['jamsostek'],
					'nohp' => $_POST['nohp'],
					);
			$exec= $db->update($tabel, $data,"id_pegawai='$_POST[kode]'");	
		}
}
//addbank
if ($_GET['jen']=='bank')
{	
		 if($_POST['idbank']==''){
			  $id=$db->idurut("hr_pegawai_acc","id");
			  $data = array( 
						  'id' => $id, 
						  'id_peg' => $_POST['idpeg'],
						  'no_rek' => $_POST['no_rek'],
						  'nama_bank' => $_POST['nama_bank'],
						  'def' => $_POST['default'],
						  
					  );
			  $exec= $db->insert("hr_pegawai_acc", $data);
		 }else{
			  $data = array( 
						  'no_rek' => $_POST['no_rek'],
						  'nama_bank' => $_POST['nama_bank'],
						  'def' => $_POST['default'],
						  
					  );
			  $exec= $db->update("hr_pegawai_acc", $data,"id='".$_POST['idbank']."'");
		 }
}
if ($_GET['jen']=='finger')
{	
		 if($_POST['idfinger']==''){
			  $id=$db->idurut("hr_finger","id");
			  $data = array( 
						  'id' => $id, 
						  'id_pegawai' => $_POST['idpeg'],
						  'acno' => $_POST['acno'],
					  );
			  $exec= $db->insert("hr_finger", $data);
		 }else{
			  $id=$db->idurut("hr_finger","id");
			  $data = array( 
						  'acno' => $_POST['acno'],
					  );
			  $exec= $db->update("hr_finger", $data,"id='".$_POST['idfinger']."'");
		 }
		 //echo $_POST['idpeg'];
}
if ($_GET['jen']=='emer')
{	
		 if($_POST['id_hub']==''){
			  $id=$db->idurut("hr_emergency","id_hub");
			  $data = array( 
						  'id_hub' => $id, 
						  'id_pegawai' => $_POST['idpeg'],
						  'nama_hubungan' => $_POST['nama_hub'],
						  'hubungan' => $_POST['hub'],
						  'mobile' => $_POST['no_hp'],
						  'telp' => $_POST['no_telp'],
					  );
			  $exec= $db->insert("hr_emergency", $data);
		 }else{
			  $data = array( 
						  'nama_hubungan' => $_POST['nama_hub'],
						  'hubungan' => $_POST['hub'],
						  'mobile' => $_POST['no_hp'],
						  'telp' => $_POST['no_telp'],
					  );
			  $exec= $db->update("hr_emergency", $data,"id_hub='".$_POST['id_hub']."'");
		 }
}
if ($_GET['jen']=='alamat')
{	
		 if($_POST['id_alamat']==''){
			  $id=$db->idurut("hr_alamat","id_alamat");
			  $data = array( 
						  'id_alamat' => $id, 
						  'id_pegawai' => $_POST['idpeg'],
						  'alamat_peg' => $_POST['alamat'],
						  'ket' => $_POST['ket'],
					  );
			  $exec= $db->insert("hr_alamat", $data);
		 }else{
			  $data = array( 
						  'alamat_peg' => $_POST['alamat'],
						  'ket' => $_POST['ket'],
					  );
			  $exec= $db->update("hr_alamat", $data,"id_alamat='".$_POST['id_alamat']."'");
		 }
}
if ($_GET['jen']=='pendidikan')
{	
		 if($_POST['id_pend']==''){
			 $s=explode("/",$_POST['tgl_lulus']);
			  $id=$db->idurut("hr_pendidikan","id_pend");
			  $data = array( 
						  'id_pend' => $id, 
						  'jenispend' => $_POST['nama_pend'],
						  'id_pegawai' => $_POST['idpeg'],
						  'tempat' => $_POST['tempat'],
						  'tahun_awal' => $_POST['tahun_awal'],
						  'tahun_akhir' => $_POST['tahun_akhir'],
						  'jurusan' => $_POST['jurusan'],
						  'universitas' => $_POST['universitas'],
						  'nomor_ijazah' => $_POST['nomor_ijazah'],
						  'tgl_lulus' => $s[2]."-".$s[0]."-".$s[1],
						  'nilai' => $_POST['nilai'],
						  'ket_pend' => $_POST['ket'],
					  );
			  $exec= $db->insert("hr_pendidikan", $data);
		 }else{
			 $s=explode("/",$_POST['tgl_lulus']);
			  $data = array( 
						  'jenispend' => $_POST['nama_pend'],
						  'tempat' => $_POST['tempat'],
						  'tahun_awal' => $_POST['tahun_awal'],
						  'tahun_akhir' => $_POST['tahun_akhir'],
						  'ket_pend' => $_POST['ket'],
						   'jurusan' => $_POST['jurusan'],
						  'universitas' => $_POST['universitas'],
						  'nomor_ijazah' => $_POST['nomor_ijazah'],
						  'tgl_lulus' => $s[2]."-".$s[0]."-".$s[1],
						  'nilai' => $_POST['nilai'],
					  );
			  $exec= $db->update("hr_pendidikan", $data,"id_pend='".$_POST['id_pend']."'");
		 }
}
if ($_GET['jen']=='statuskel')
{	
		 if($_POST['id_statuskel']==''){
			  $id=$db->idurut("hr_statuskel","id_tdstatuskel");
			  $data = array( 
						  'id_tdstatuskel' => $id, 
						  'id_statuskel' => $_POST['statuskel'],
						  'id_pegawai' => $_POST['idpeg'],
						  'anak' => $_POST['anak'],
						  'userid_tdsts' => $_SESSION['ID_LOGIN'],
						  'tglinput' => date("Y-m-d H:i:s"),
					  );
			  $exec= $db->insert("hr_statuskel", $data);
		 }else{
			  $data = array( 
						  'id_statuskel' => $_POST['statuskel'],
						  'anak' => $_POST['anak'],
					  );
			  $exec= $db->update("hr_statuskel", $data,"id_tdstatuskel='".$_POST['id_statuskel']."'");
		 }
}
if ($_GET['jen']=='kedudukan')
{	
		 if($_POST['id_tdjab']==''){
			  $id=$db->idurut("hr_jabatanpeg","id_tdjab");
			  $fileName = $_FILES['imagesk']['name'];
			  $data = array( 
						  'id_tdjab' => $id, 
						  'id_jabatan' => $_POST['nmjab'],
						  'id_st_jabatan' => $_POST['stjab'],
						  'id_pegawai' => $_POST['idpeg'],
						  'id_tingkat_gol' => $_POST['golongan'],
						  'id_pangkat' => $_POST['pangkat'],
						  'jenis' => $_POST['jenis'],
						  'no_sk' => $_POST['nosk'],
						  'tgl_sk' => date("Y-m-d",strtotime($_POST['tglsk'])),
						  'tgl_jabat' => date("Y-m-d",strtotime($_POST['tgljab'])),
						  'ket_tdjabpeg' => $_POST['ket'],
						  'id_cabang' => $_POST['caba'],
						  'jenis_param' => $_POST['jenpar'],
						  'tgl_inputjab' => date("Y-m-d H:i:s"),
						  'userid_jabpeg' => $_SESSION['ID_LOGIN'],
						  'imagesk' => $fileName,
					  );
					  
			  echo $fileName.'-'.$_POST['nmjab'].'-'.$_POST['stjab'].'-'.$_POST['idpeg'].'-'.$_POST['golongan'].'-'.$_POST['jenis'].'-'.$_POST['pangkat'].'-'.$_POST['caba'].'-'.$_POST['ket'].'-'.$_POST['nosk'].'-'.$id ;
			  move_uploaded_file($_FILES['imagesk']['tmp_name'], "images/".$_FILES['imagesk']['name']);
			  $exec= $db->insert("hr_jabatanpeg", $data);
			  //peg
			  $data = array( 
						  'id_jabatan' => $_POST['nmjab'], 
						  'id_cabang' => $_POST['caba'], 
						  'id_pangkat' => $_POST['pangkat'], 
						  'id_st_jabatan' => $_POST['stjab'], 
					  );
			  $exec= $db->update("m_pegawai", $data,"id_pegawai='$_POST[idpeg]'");
		 }else{
			  $fileName = $_FILES['imagesk']['name'];
			  $data = array( 
						  'id_jabatan' => $_POST['nmjab'],
						  'id_st_jabatan' => $_POST['stjab'],
						  'id_pegawai' => $_POST['idpeg'],
						  'id_tingkat_gol' => $_POST['golongan'],
						  'id_pangkat' => $_POST['pangkat'],
						  'jenis' => $_POST['jenis'],
						  'no_sk' => $_POST['nosk'],
						  'tgl_sk' => date("Y-m-d",strtotime($_POST['tglsk'])),
						  'tgl_jabat' => date("Y-m-d",strtotime($_POST['tgljab'])),
						  'ket_tdjabpeg' => $_POST['ket'],
						  'id_cabang' => $_POST['caba'],
						  'imagesk' => $fileName,
					  );
			  move_uploaded_file($_FILES['imagesk']['tmp_name'], "asset/master/pegawai/images/".$_FILES['imagesk']['name']);
			  $exec= $db->update("hr_jabatanpeg", $data,"id_tdjab='".$_POST['id_tdjab']."'");
			  //peg
			  $data = array( 
						  'id_jabatan' => $_POST['nmjab'], 
						  'id_cabang' => $_POST['caba'], 
					  );
			  $exec= $db->update("m_pegawai", $data,"id_pegawai='$_POST[idpeg]'");
		 }
}
if ($_GET['jen']=='kontrak')
{	
		foreach($db->select("m_pegawai","tgl_lahir","id_pegawai='$_POST[idpeg]'")as $dp);
		
		$exp=explode("/",$dp['tgl_lahir']);
		$expwa=explode("/",$_POST['tglmulai']);
		if($_POST['idstatus']==1){
			foreach($db->select("m_pegawai","max(substr(nik,5,4))as nik","nik like 'tkwa%'")as $maxi);
			$urutan=(int) $maxi['nik']+1;	
			$nik="TKWA".sprintf("%04s", $urutan);
		}elseif($_POST['idstatus']==3 || $_POST['idstatus']==2){
			foreach($db->select("m_pegawai","max(substr(nik,7,3))as nik","nik like 'wa%'")as $maxi);
			$urutan=(int) $maxi['nik']+1;
			$nik="WA".substr($exp[0],2,2).substr($expwa[2],2,2).sprintf("%03s", $urutan);
		}elseif($_POST['idstatus']==6){
			$nik=$_POST['nikhon'];
		} 
		 
		 if($_POST['id_kontrak']==''){
			  $id=$db->idurut("hr_kontrakpeg","id_kontrak");
			  $data = array( 
						  'id_kontrak' => $id, 
						  'id_status' => $_POST['idstatus'],
						  'id_pegawai' => $_POST['idpeg'],
						  'id_aktif' => $_POST['aktif'],
						  'nik_peg' => $nik,
						  'sk_kontrak' => $_POST['nosk'],
						  'tglmulai' => date("Y-m-d",strtotime($_POST['tglmulai'])),
						  'tglakhir' => date("Y-m-d",strtotime($_POST['tglakhir'])),
						  'ket_tdjab' => $_POST['ket'],
						  'tgl_inputkontrak' => date("Y-m-d H:i:s"),
						  'userid' => $_SESSION['ID_LOGIN'],
					  );
			  $exec= $db->insert("hr_kontrakpeg", $data);
			  
			  //peg
			  $data = array( 
						  'nik' => $nik, 
						  'id_aktif' => $_POST['aktif'], 
						  'id_status' => $_POST['idstatus'], 
						  'tgl_mulai' => date("Y-m-d",strtotime($_POST['tglmulai'])), 
					  );
			  $exec= $db->update("m_pegawai", $data,"id_pegawai='$_POST[idpeg]'");
		 }else{
			  $data = array( 
						  'id_status' => $_POST['idstatus'],
						  'id_pegawai' => $_POST['idpeg'],
						  'id_aktif' => $_POST['aktif'],
						  'sk_kontrak' => $_POST['nosk'],
						  'tglmulai' => date("Y-m-d",strtotime($_POST['tglmulai'])),
						  'tglakhir' => date("Y-m-d",strtotime($_POST['tglakhir'])),
						  'ket_tdjab' => $_POST['ket'],
					  );
			  $exec= $db->update("hr_kontrakpeg", $data,"id_kontrak='".$_POST['id_kontrak']."'");
		 }
}
if ($_GET['jen']=='pengalaman')
{	
		 if($_POST['id_peru']==''){
			  $id=$db->idurut("hr_pegawai_pengalaman","id");
			  $data = array( 
						  'id' => $id, 
						  'id_peg' => $_POST['idpeg'],
						  'nama_perusahaan' => $_POST['nama_peru'],
						  'tahun_mulai' => $_POST['tahun_mulai'],
						  'tahun_akhir' => $_POST['tahun_akhir'],
						  'bagian' => $_POST['bagian'],
						  'jabatan' => $_POST['jabatan'],
					  );
			  $exec= $db->insert("hr_pegawai_pengalaman", $data);
		 }else{
			  $data = array( 
						   'nama_perusahaan' => $_POST['nama_peru'],
						  'tahun_mulai' => $_POST['tahun_mulai'],
						  'tahun_akhir' => $_POST['tahun_akhir'],
						  'bagian' => $_POST['bagian'],
						  'jabatan' => $_POST['jabatan'],
					  );
			  $exec= $db->update("hr_pegawai_pengalaman", $data,"id='".$_POST['id_peru']."'");
		 }
}




?>