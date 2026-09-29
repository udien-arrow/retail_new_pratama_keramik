<?php
$tabel = "m_fakturpajak";
$filename=$_FILES["file"]["tmp_name"];
if($_FILES["file"]["size"] > 0)
    {
    $file = fopen($filename, "r");
	$i=1;
    while (($emapData = fgetcsv($file, 50000, ",")) !== FALSE)
    {
			//echo $emapData[1].'a<br>';
			if($i>1 && $emapData[0]!=''){
				//==============================cek head so================================================
				$jum=count($db->select($tabel,"*","no_faktur='$emapData[0]'"));
				if($jum==0){
					$tgl=str_replace(",","",date('Y-m-d',strtotime($emapData[3])));
					//echo $tgl.'<br>';
					if($tgl=='1970-01-01'){
						$exp=explode("/",$emapData[3]);
						$tgl=$exp[2].'/'.$exp[1].'/'.$exp[0];	
					}
					//echo $tgl.'<br>';
					$data = array( 
						'no_faktur' => str_replace(",","",$emapData[0]), 
						'status' => 0,
						'tgl' => $tgl, 
						'stampdate' => date("Y-m-d H:i:s"), 
					);
					
					$exec= $db->insert($tabel, $data);
				//==============================endcek dtl so================================================
				}
		}
		$i++;
    }
    	fclose($file);
    }else{
    	echo "<script>
		alert('Format harus CSV!');
		window.location='index.php?x=fakturpajak'</script>";
	}

?>