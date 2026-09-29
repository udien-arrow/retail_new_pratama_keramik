<?php
if($_POST['simpan']=='simpan'){
	$total=str_replace(",","",$_POST['dibayar']);
	$nil=0;
	foreach ($_POST['app'] as $key => $value) {
		$asd=explode("_",$value);
		//$nil=$asd[1];
		$nil=str_replace(",","",$_POST['nilaipiutang'][$key]);
			 if($value!="" && $nil>0){
					if($total>=$nil){
						$dibayar=$nil;
						$total=$total-$nil;	
					}else{
						$dibayar=$total;
						$total=$total-$nil;	
					}
					$b=explode("/",$_POST['jatuh_tempo']);
					if($dibayar>0){
						$sel=$db->select("tx_buku_tagihan_dtl","*","id_dtl='".$asd['0']."'");
						foreach($sel as $bis){}
						$urut=$db->idurut("tx_tagihan_kembali_tmp","urut");
						$data = array(  
						'id_user' => $_SESSION['ID_LOGIN'],
						'total_piutang' =>  $asd['1'],
						'dibayar' =>  $dibayar,
						'jenis_pem' =>  $_POST['jenispem'],
						'nama_bank' =>  $_POST['nama_bank'],
						'no_seribg' =>  $_POST['no_seribg'],
						'id_cus' => $bis['id_cus'],
						'no_spj' => $bis['no_spj'],
						'no_fj' => $bis['no_fj'],
						'no_rekening' => $_POST['no_rek'],
						'jatuh_tempo' => $b[2]."-".$b[0]."-".$b[1],
						'total' => $asd['1']-$dibayar,
						'tempo_normal' => $bis['tempo_normal'],
						'tempo_tambahan' => $bis['tempo_tambahan'],
						'urut' => $urut
						);
						$exec= $db->insert("tx_tagihan_kembali_tmp", $data);
						echo "<script>window.location='index.php?x=tagkem&id=$_POST[links]&jenispem=$_POST[jenis]&jenisb=$_POST[jenisb]'</script>";
					}
		   } 
		}
	}
if($_POST['tambah_in']=='ijen'){	
	if($_POST[id]==''){
			echo "<script>window.location='index.php?x=bukta'</script>";		
	}else{
	$b=explode("/",$_POST['jatuh_tempox']);
	$urut=$db->idurut("tx_tagihan_kembali_tmp","urut");
	$data = array(  
					'id_user' => $_SESSION['ID_LOGIN'],
					'total_piutang' =>  $_POST['totalpiutangx'],
					'dibayar' =>  $_POST['dibayarx'],
					'jenis_pem' =>  $_POST['jenispem'],
					'nama_bank' =>  $_POST['nama_bankx'],
					'no_seribg' =>  $_POST['no_seribgx'],
					'id_cus' => $_POST['id_cusx'],
					'no_spj' => $_POST['no_spjx'],
					'no_fj' => $_POST['no_fjx'],
					'no_rekening' => $_POST['no_rekx'],
					'jatuh_tempo' => $b[2]."-".$b[0]."-".$b[1],
					'total' => $_POST['totalpiutangx']-$_POST['dibayarx'],
					'tempo_normal' => $_POST['tempo_normalx'],
					'tempo_tambahan' => $_POST['tempo_tambahanx'],
					'urut' => $urut
					);
	$exec= $db->insert("tx_tagihan_kembali_tmp", $data);
	echo "<script>window.location='index.php?x=tagkem&id=$_POST[links]&jenispem=$_POST[jenis]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['dtl'] as $key => $val){
	  if($val>0){
		if($_POST['dibayar'][$key]=='' or $_POST['totalpiutang']==0){
		}else{
			$ds=$db->select("tx_piutang","*","id_piutang=".$_POST['idp'][$key]);
			foreach($ds as $sd){}
			$exp=explode("_",$_POST['id_stok']);
			$b=explode("/",$_POST['jatuh_tempo'][$key]);
			$urut=$db->idurut("tx_tagihan_kembali_tmp","urut");
			$data = array( 
					'id_user' => $_SESSION['ID_LOGIN'],
					'total_piutang' =>  $_POST['totalpiutang'][$key],
					'dibayar' =>  str_replace(",","",$_POST['dibayar'][$key]),
					'jenis_pem' =>  $_POST['jenispem'],
					'nama_bank' =>  $_POST['nama_bank'][$key],
					'no_seribg' =>  $_POST['no_seribg'][$key],
					'id_cus' => $_POST['id_cus'][$key],
					'no_spj' => $_POST['no_spj'][$key],
					'no_fj' => $_POST['no_fj'][$key],
					'no_rekening' => $_POST['no_rek'][$key],
					'jatuh_tempo' => $b[2]."-".$b[0]."-".$b[1],
					'total' => str_replace(",","",$_POST['totalpiutang'][$key])-str_replace(",","",$_POST['dibayar'][$key]),
					'tempo_normal' => $_POST['tempo_normal'][$key],
					'tempo_tambahan' => $_POST['tempo_tambahan'][$key],
					'urut' => $urut
				);
		$exec= $db->insert("tx_tagihan_kembali_tmp", $data);
	  }
	}}
	echo "<script>window.location='index.php?x=tagkem&id=$_POST[links]&jenispem=$_POST[jenis]'</script>";
}
?>