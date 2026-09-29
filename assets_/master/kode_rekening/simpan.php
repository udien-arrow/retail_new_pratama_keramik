<?php
$tabel = "ak_acc";

if($_POST[t]=='add'){

		$db->select($tabel,"account");
		$mata=$_POST['curr'];
		if(!empty($_POST['parent'])){ $parent='0';} else{$parent='1';}
		if($_POST['head']!=""){
		$head=$_POST['head'];$p=1;} else {$head='0';$p=0;}
	
	if(empty($_POST['jenis']))
		{   $post=0; } 
			else {
					$post=1;
					
				}
		$jenis="$_POST[jenis]";		
		$data = array( 
				 'account' => $_POST['kd_per'],
				 'description' => $_POST['nm_per'],
				 'type' => $_POST['kel'],
				 'post_flag' => $post,
				 'parent' => $head,
				 'LR' => $jenis,
				 'curr' => "IDR",
				 'bl' => $p
		);	
			//print_r($data);	
			/*var_dump($data);
			die();	*/
				
		$exec= $db->insert($tabel, $data);

}
	/*echo "<script>window.location='index.php?x=koder'</script>";*/
else{
	if(!empty($_PSOT['parent'])){ $parent='0';} else{$parent='1';}
		if($_POST['head']!=""){
		$head=$_POST['head'];$p=1;} else {$head='0';$p=0;}
	$jenis="$_POST[jenis]";
	$data = array( 
				 'description' => $_POST['nm_per'],
				 'type' => $_POST['kel'],
				 'post_flag' => $post,
				 'parent' => $head,
				 'LR' => $jenis,
				 'bl' => $p
				);	
	$exec= $db->update($tabel, $data, "account='$_POST[kd_per]'");	
}
echo "<script>window.location='index.php?x=koder'</script>"; 
?>