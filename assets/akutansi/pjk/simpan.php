<?php
$tabel = "ak_pjk_tmp";
if($_POST[kode]==''){
		$max=$db->select("ak_pjk_tmp","max(ID)as id");
		foreach($max as $val){}
		$id=$val['id']+1;
		 $jumlah = $_POST['jml'];
		  $new_jml = str_replace(',', '',$jumlah);
		   $st = $_POST['curr'];
		  $pos = $new_jml;
		  if($st=='kredit'){
			  	$new_jml=0-$new_jml;
			  }else{
				  $new_jml=$new_jml;
				  }
		  
		$acc=explode("-",$_POST['norek']);
		$ck=$db->select("ak_pum","*","NO_PUM='$_POST[jenjur]'");
		foreach($ck as $cas){}
		$fi=$db->select($tabel,"sum(JUMLAH)as jum","USER='$_SESSION[ID_LOGIN]'");
		foreach($fi as $dk){}
		$data = array( 'ID' => $id, 
				 'KETERANGAN' => $_POST['ket'],
				 'ACC_CODE' => trim($acc[0]," "),
				 'NO_PUM' => $_POST['jenjur'],
				 'JUMLAH' =>  $new_jml,
				 'USER' => $_SESSION['ID_LOGIN'],
				 'ST' => $st
				);
		$exec= $db->insert($tabel, $data);
	echo "<script>window.location='index.php?x=pjk&pum=$_POST[jenjur]&jen=$_POST[jum]'</script>";
}else{
	echo "<script>window.location='index.php?x=pjk'</script>";
}
?>