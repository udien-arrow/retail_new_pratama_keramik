<?php	
$tabel = "tm_kas";
$data = array( 
					'SETOR_KAS' => str_replace(",","",$_POST[setor]),
					'TOTAL_TRANSAKSI' => str_replace(",","",$_POST[totpj]),
					'SISA_KAS' => str_replace(",","",$_POST[sisa]),
					'TGL1' => $_POST[tgl1],	
					'TGL2' => $_POST[tgl2],									
						);
$exec=$db->update($tabel, $data, "ID_KAS='$_POST[id_kas]'")

?>
<Script>
//window.location='printpos:closing:<?=$_POST['id_kas']?>:<?=$_POST['tgl1']?>:<?=$_POST['tgl2']?>'; 
window.location='printpos:setorkas:<?=$_POST['id_kas']?>:<?=$_SESSION['ID_LOGIN']?>'; 
window.location="index.php?x=setorkas";

window.open("assets/inventory/penjualan/lapclosing.php?id=<?=$_POST[id_kas]?>&tgl1=<?=$_POST[tgl1]?>&tgl2=<?=$_POST[tgl2]?>");
</Script>
