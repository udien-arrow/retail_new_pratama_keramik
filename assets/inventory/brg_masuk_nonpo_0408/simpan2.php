<?php
$tabel = "tx_bm_order_tmp";


if($_POST['aksi']=='batal'){
	$where = array("id_user" => $_SESSION['ID_LOGIN']);
	$db->delete("tx_brg_masuk_tmp",$where);
	echo "<script>window.location='index.php?x=brgmasuk2'</script>";	
				
}
if($_POST['simpan']){
		
		include("assets/inventory/brg_masuk/simpan2.php");
				
}


?>