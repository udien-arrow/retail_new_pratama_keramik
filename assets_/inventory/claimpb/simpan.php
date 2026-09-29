	<?php
$tabel = "ex_claim_pab_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=claimpb'</script>";		
	}else{
			$exp=explode("_",$_POST['id_stok']);
			$cek=$db->select("tx_retur_pem a
JOIN tx_brg_masuk b ON a.no_ref = b.no_masuk
JOIN tx_po c ON b.no_ref = c.no_po
JOIN tx_prp d ON c.no_jwa = d.no_jwa
JOIN ex_expediture e on d.no_jwa=e.no_so
JOIN ex_expediture_dtl f on e.no_expediture=f.no_expediture
JOIN ex_expediture_biaya_dtl g on g.no_expediture=e.no_expediture","d.no_jwa,
e.tarif_ao,
f.qty,
f.berat
","a.no_retur='$_POST[idlink]' and id_barang='$_POST[id]'");
foreach($cek as $ck){}
$harga=$_POST['qty_claim2']*$ck['tarif_ao']*$ck['berat'];
			$data = array( 
					'id_barang' => $_POST['id'],
					'sat' => $_POST['satuan2'], 
					'qty_retur' => $_POST['qty_retur2'],
					'id_user' => $_SESSION['ID_LOGIN'],
					'qty_claim' => $_POST['qty_claim2'],
					'id_gudang' => $_POST['id_gudang'],
					'total' => $harga,
					'id_sup' => $_POST['sup2'],
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=claimpb&id=$_POST[idlink]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['id_barang'] as $key => $val){
	  if($val>0){
		if($_POST['qty_retur'][$key]==''){
		}else{
			$cek=$db->select("tx_retur_pem a
JOIN tx_brg_masuk b ON a.no_ref = b.no_masuk
JOIN tx_po c ON b.no_ref = c.no_po
JOIN tx_prp d ON c.no_jwa = d.no_jwa
JOIN ex_expediture e on d.no_jwa=e.no_so
JOIN ex_expediture_dtl f on e.no_expediture=f.no_expediture
JOIN ex_expediture_biaya_dtl g on g.no_expediture=e.no_expediture","d.no_jwa,
e.tarif_ao,
f.qty,
f.berat
","a.no_retur='$_POST[idlink]' and id_barang='".$_POST['id_barang'][$key]."'");
foreach($cek as $ck){}
$harga=$_POST['qty_claim'][$key]*$ck['tarif_ao']*$ck['berat'];
			$data = array( 
					'id_barang' => $_POST['id_barang'][$key],
					'sat' => $_POST['satuan'][$key], 
					'qty_retur' => $_POST['qty_retur'][$key],
					'id_user' => $_SESSION['ID_LOGIN'],
					'qty_claim' => $_POST['qty_claim'][$key],
					'id_gudang' => $_POST['gudangs'],
					'total' => $harga,
					'id_sup' => $_POST['supp'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=claimpb&id=$_POST[idlink]'</script>";	
}

?>