<?php	
$tabel = "tm_kas";
$data = array( 
					'SETOR_KAS' => str_replace(",","",$_POST[setor]),
					'TOTAL_TRANSAKSI' => str_replace(",","",$_POST[totpj]),
					'SISA_KAS' => str_replace(",","",$_POST[sisa]),
						);
$exec=$db->update($tabel, $data, "ID_KAS='$_POST[id_kas]'")

?>
<Script>
window.location="index.php?x=setorkas";
window.open("assets/inventory/penjualan/lapclosing.php?id=<?=$_POST[id_kas]?>&tgl1=<?=$_POST[tgl1]?>&tgl2=<?=$_POST[tgl2]?>");
</Script>
