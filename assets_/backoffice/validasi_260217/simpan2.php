<?php
session_start();
$etgl=explode("-",$_POST[tgl]);
$tbl="tx_".(int)($etgl[1])."".$etgl[0];
		if($_POST[jenis]==3){
		$data=array("nama_pax"=>$_POST['nama'],
					"dep"=>$_POST['dep'],
					"qty"=>$_POST['qty'],
					"nominal"=>$_POST['total']
					);
					
		$db->update("$tbl",$data,"id_inc='$_POST[id]'");			
		
		echo "<script>
		window.location='index.php?x=vdasi&jenis=3&tgl=$_POST[tgl]&unit=$_POST[unit]'</script>";
		
		}
		
		
	
?>