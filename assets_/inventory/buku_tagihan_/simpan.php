<?php
$tabel = "tx_buku_tagihan_tmp";
$no_pi=explode("_",$_POST['idlink']);
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=bukta'</script>";		
	}else{
		$ds=$db->select("v_buku_tagihan","*","id_piutang='$_POST[id]'");
		foreach($ds as $sd){}
		$dd=explode("_",$sd['gab']);
			$data = array( 
					'no_spj' => $sd['no_ref'],
					'no_fj' => $sd['no_faktur_jual'],
					'id_cus' => $sd['id_cus'],
					'total_piutang' => $dd[1],
					'id_user' => $_SESSION['ID_LOGIN'],
					'tempo_normal' => $_POST['tempo_normal2'],
					'tempo_tambahan' => $_POST['tempo_tambahan2'],
					'tgl_spj' => $sd['tgl'],
					'tgl' => date("Y-m-d"),
					'n_tempo_n' => $sd['n_tempo_n'],
					'n_tempo_t' => $sd['n_tempo_t'],
					);				
			$exec= $db->insert($tabel, $data);
			echo "<script>window.location='index.php?x=bukta'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['idp'] as $key => $val){
	  if($val>0){
		if($_POST['idcus'][$key]==''){
		}else{
			$ds=$db->select("v_buku_tagihan","*","id_piutang=".$_POST['idp'][$key]);
			foreach($ds as $sd){}
			$dd=explode("_",$sd['gab']);
			$exp=explode("_",$_POST['id_stok']);
			$data = array( 
					'no_spj' => $sd['no_ref'],
					'no_fj' => $sd['no_faktur_jual'],
					'id_cus' => $sd['id_cus'],
					'total_piutang' => $dd[1],
					'id_user' => $_SESSION['ID_LOGIN'],
					'tempo_normal' => $_POST['tempo_normal'][$key],
					'tempo_tambahan' => $_POST['tempo_tambahan'][$key],
					'tgl_spj' => $sd['tgl'],
					'tgl' => date("Y-m-d"),
					'n_tempo_n' => $sd['n_tempo_n'],
					'n_tempo_t' => $sd['n_tempo_t'],
				);
		$exec= $db->insert($tabel, $data);
	  }
	}}
	echo "<script>window.location='index.php?x=bukta'</script>";	
}

?>