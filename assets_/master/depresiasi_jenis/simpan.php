<?php
	$tabel = "am_depresiasi";
	$tgl=date("Y-m-d H:i:s");
	$per=explode("-",$_POST[aktiva]);
	$cogs=explode("-",$_POST[susut]);
	$intran=explode("-",$_POST[beban]);
	$pen=explode("-",$_POST[pendapatan]);
	$rug=explode("-",$_POST[kerugian]);
	if(!empty($_POST[kode])){
	$data = array( 'akun_aktiva' => trim($per[0]," "), 
					'akun_depresiasi' => trim($cogs[0]," "), 
					'beban_depresiasi' => trim($intran[0]," "),
					'pendapatan' => trim($pen[0]," "),
					'kerugian' => trim($rug[0]," ") 
		 );
	$exec= $db->update($tabel, $data, "id_depresiasi='$_POST[kode]'");
	
	} else {
		$data = array( 'akun_aktiva' => trim($per[0]," "), 
					'akun_depresiasi' => trim($cogs[0]," "), 
					'beban_depresiasi' => trim($intran[0]," "),
					'pendapatan' => trim($pen[0]," "),
					'kerugian' => trim($rug[0]," "),
					'nama_depresiasi' =>$_POST['nama'] ,
					'status_depresiasi' =>"1",
					'tgl_depresiasi'=> $tgl,
					'userid_depresiasi'=>$_SESSION['ID_LOGIN']
		 );
		$exec= $db->insert($tabel, $data);
		
		}
	echo "<script>window.location='index.php?x=depaset'</script>";



?>