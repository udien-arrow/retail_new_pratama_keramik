<?php
require( '../../../webclass.php' );
$db=new kelas;
error_reporting(0);
session_start();
$tabel = "absensi";
if ($_GET['jen']=='tambah')
{
			if($_POST['shift']==1){
				$on_dutty="07:30";
				$off_dutty="16:30";
			}elseif($_POST['shift']==2){
				$on_dutty="9:00";
				$off_dutty="17:00";
			}elseif($_POST['shift']==3){
				$on_dutty="21:00";
				$off_dutty="05:00";
			}
			$id=$db->idurut($tabel,"id");
			$tgl=date("Y-m-d");
			$ce=$db->select("hr_absensi","*","id_pegawai='$_SESSION[ID_PEG]' order by id DESC limit 0,1");
			foreach($ce as $cek){}
			if(count($ce)==''){
				
				$data = array( 
					'id' => $id, 
					'id_pegawai' => $_SESSION['ID_PEG'],
					'jam' => date("H:i:s"),
					'tgl' => date("Y-m-d"),
					'latitude' => $_POST['latitude'],
					'longitude' => $_POST['longitude'],
					'hostname' => $_SERVER['HTTP_HOST'],
					'ip' => $_SERVER['REMOTE_ADDR'],
					'jenis' => 1
					);
			$exec= $db->insert($tabel, $data);	
			$id2=$db->idurut("hr_absensi","id");
			$data = array( 
					'id' => $id2, 
					'id_pegawai' => $_SESSION['ID_PEG'],
					'date' => date("Y-m-d"),
					'jenis' => 1,
					'on_duty' => $on_dutty,
					'off_duty' => $off_dutty,
					'clock_in' => date("H:i:s"),
					'id_user' => $_SESSION['ID_LOGIN'],
					);
			$exec= $db->insert("hr_absensi", $data);
				
			}else
			if($cek['clock_out']==''){
			$data = array( 
					'id' => $id, 
					'id_pegawai' => $_SESSION['ID_PEG'],
					'jam' => date("H:i:s"),
					'tgl' => date("Y-m-d"),
					'latitude' => $_POST['latitude'],
					'longitude' => $_POST['longitude'],
					'hostname' => $_SERVER['HTTP_HOST'],
					'ip' => $_SERVER['REMOTE_ADDR'],
					'jenis' => 2
					);
			$exec= $db->insert($tabel, $data);
			
			$as=$db->select("hr_absensi","*","id_pegawai='$_SESSION[ID_PEG]' order by id DESC limit 0,1");
			foreach($as as $ok){}

			$wp=date("H:i",strtotime($ok['clock_in']));
			$wk=date("H:i");
			$kini = new DateTime($wp);  
		    $kemarin = new DateTime($wk);  
		    $jadi=$kemarin->diff($kini)->format('%h:%i'); 	
			$data = array( 
					'clock_out' => date("H:i:s"),
					'att_time' => $jadi,
					);
			$exec= $db->update("hr_absensi", $data,"id_pegawai='$_SESSION[ID_PEG]' and date='$ok[date]'");
			}else{
			$data = array( 
					'id' => $id, 
					'id_pegawai' => $_SESSION['ID_PEG'],
					'jam' => date("H:i:s"),
					'tgl' => date("Y-m-d"),
					'latitude' => $_POST['latitude'],
					'longitude' => $_POST['longitude'],
					'hostname' => $_SERVER['HTTP_HOST'],
					'ip' => $_SERVER['REMOTE_ADDR'],
					'jenis' => 1
					);
			$exec= $db->insert($tabel, $data);	
			$id2=$db->idurut("hr_absensi","id");
			$data = array( 
					'id' => $id2, 
					'id_pegawai' => $_SESSION['ID_PEG'],
					'date' => date("Y-m-d"),
					'jenis' => 1,
					'on_duty' => $on_dutty,
					'off_duty' => $off_dutty,
					'clock_in' => date("H:i:s"),
					'id_user' => $_SESSION['ID_LOGIN'],
					);
			$exec= $db->insert("hr_absensi", $data);	
			
			}
			echo $ok['date'];
		
	
}
?>