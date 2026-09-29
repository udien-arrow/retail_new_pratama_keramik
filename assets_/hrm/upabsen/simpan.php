<?php
$tabel = "hr_absensi";
$tabel_ntf = "hr_absensi_notif";
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
		if($i>1 && $emapData[3]!=''){
			$id=$db->idurut($tabel,"id");		
			foreach($db->select("hr_finger","*","acno='$emapData[1]'") as $gudv);
			if($gudv['acno']==''){			
					$idn=$db->idurut($tabel_ntf,"id");		
					$data = array( 
							'id' => $idn, 
							'sales_order' => $emapData[1],
							'ket' => 'Gagal Upload!!, AC Number '.$emapData[1].' belum didaftarkan. Silakan input dimaster Pegawai!', 
					);
					$exec= $db->insert($tabel_ntf, $data);
			}
			if($gudv['acno']!=''){
				//==============================cek head so================================================
				$tgl=date("Y-m-d",strtotime($emapData[5]));
				$jum=count($db->select($tabel,"*","acno='$emapData[1]' and date='$tgl'"));
				if($jum==0){
					$data = array( 
						'id' => $id, 
						'id_pegawai' => $gudv['id_pegawai'], 
						'acno' => str_replace(",","",$emapData[1]), 
						'date' => str_replace(",","",date('Y-m-d',strtotime($emapData[5]))), 
						'jenis' => 1, 
						'timetable' => str_replace(",","",$emapData[6]), 
						'on_duty' => str_replace(",","",$emapData[7]), 
						'off_duty' => str_replace(",","",$emapData[8]), 
						'clock_in' => str_replace(",","",$emapData[9]),   
						'att_time' => str_replace(",","",$emapData[25]),
						'clock_out' => str_replace(",","",$emapData[10]),  
						'id_user' => $_SESSION['ID_LOGIN'],   
						'work_time' => str_replace(",","",$emapData[17]) 
					);
					$exec= $db->insert($tabel, $data);
					
				}//end if
			}//end if cek bar gud
			$gudv['acno']="";
		}
		$i++;
    }
    	fclose($file);
    	$jumn=count($db->select("hr_absensi_notif","*"));
		if($jumn==0){
    		echo "<script>window.location='index.php?x=upabsen'</script>";
		}else{
			include('index_notif.php');
		}
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=up_so'</script>";
	}

?>