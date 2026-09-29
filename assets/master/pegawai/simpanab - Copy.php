<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
$tabel = "m_pegawai";
//addpegawai
if ($_POST['tambah']=='tambah' and $_POST['kode']=='')
{	
	 $id=$db->idurut($tabel,"id_pegawai");
	 $data = array( 
				'id_pegawai' => $id, 
				'id_cabang' => $_POST['id_cabang'],
				'id_jabatan' => $_POST['id_jabatan'],
				'nik' => '',
				'nama_pegawai' => $_POST['namanya'],
				'jk' => $_POST['jk'],
				'tmp_lahir' => $_POST['tmp_lahir'],
				'tgl_lahir' => date("Y-m-d",strtotime($_POST['tgl_lahir'])),
				'no_ktp' => $_POST['no_ktp'],
				);
	$exec= $db->insert("m_pegawai", $data);			
	echo $id;				
}

//addbank
if ($_POST['tambah']=='banknya' and $_POST['idbanknya']!='')
{	
	 $no=1;
		foreach($_POST['nama_bank'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl_acc'][$key]==''){
					$id=$db->idurut("hr_pegawai_acc","id");
					$data = array( 
								'id' => $id, 
								'id_peg' => $_POST['idbanknya'],
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
		echo $_POST['idbanknya'];
}
//addfoto
if ($_POST['tambah']=='fotonya' and $_POST['fotonnya']!='')
{	
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
				'foto' => $fot,
				);
		$exec= $db->update("m_pegawai", $data,"id_pegawai='$_POST[fotonnya]'");	
		echo $_POST['fotonnya'];
}
//addfinger
if ($_POST['tambah']=='fingernya' and $_POST['fingernnya']!='')
{	
	$no=1;
		foreach($_POST['acno'] as $key => $val){
		  if($val!=''){
			   if($_POST['id_dtl'][$key]==''){
					$id=$db->idurut("hr_finger","id");
					$data = array( 
								'id' => $id, 
								'id_pegawai' => $_POST['fingernnya'],
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
		echo $_POST['fingernnya'];
}
?>