<?php	
$idj=$db->nourut('NO_KAS', 'tm_kas', 'SK', sprintf("%02s", $_SESSION['ID_GUDANG']), date("Y-m-d"));
$tabel = "tm_kas";
$data = array( 
					'ID_PEG' => $_SESSION[ID_LOGIN],
					'ID_MEJA' => str_replace(",","",$_POST['meja']),
					'NO_KAS' => $idj,
					'TANGGAL_KAS' => date("Y-m-d H:i:s"),
					'AWAL_KAS' => str_replace(",","",$_POST['kas_awal']),
					'SETOR_KAS' => "0",
					'TOTAL_TRANSAKSI' => "0",
					'SISA_KAS' => "0",
						);
$exec=$db->insert($tabel, $data)

?>
<Script>
window.location="index.php?x=setorkas";</Script>
