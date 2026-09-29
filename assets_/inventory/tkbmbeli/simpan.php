<?php
$tabel = "tx_tkbm_tmp";
if($_POST['tambah_in']=='ijen'){	
	if($_POST['gabung']==''){
			echo "<script>window.location='index.php?x=tkbmbeli'</script>";		
	}else{
			$exp=explode("_",$_POST['gabung']);
			$exp2=explode("_",$_POST['id_stok']);
			if($exp[4]>0 && $_POST['qty']<=$exp[4]){
			foreach($db->select("m_tkbm","*","id_cabang='$exp2[2]' and id_barang='$exp[0]'") as $vl);
			if($_POST['jenis']==1){
				$nilai=0;
				$total=0;
			}
			if($_POST['jenis']==2){
				$nilai=$vl['nilai_bongkar'];
				$total=	$vl['nilai_bongkar']*$exp[3]*$_POST['qty'];
			}
			if($_POST['jenis']==3){
				$nilai=$vl['nilai_pok'];
				$total=	($vl['nilai_pok']*$exp[3])*$_POST['qty'];
			}
			$data = array( 
					'no_masuk' => $exp2[0], 
					'no_spj' => $exp2[1], 
					'id_cabang' => $exp2[2], 
					'id_barang' => $exp[0],
					'berat' => $exp[3],
					'jenis_jual' => $exp[5],
					'jenis_tkbm' => $_POST['jenis'],
					'id_jenis_kendaraan' => $_POST['kendara'],
					'nilai' => $nilai,
					'jenis_tx' => 1,
					'total' => $total,
					'qty' => $_POST['qty'],
					'id_user' => $_SESSION['ID_LOGIN'],
					);
			$exec= $db->insert($tabel, $data);
			}
			
			echo "<script>window.location='index.php?x=tkbmbeli&id=$_POST[id_stok]'</script>";
	}
}else if($_POST['tambah_in']=='rame'){
	foreach($_POST['qty_bongkar'] as $key => $val){
	  if($val>0){
		  	
			$exp=explode("_",$_POST['gab'][$key]);
			$exp2=explode("_",$_POST['id_stok']);
			
			if($exp[4]>0 && $_POST['qty_bongkar'][$key]<=$exp[4]){
			foreach($db->select("m_tkbm","*","id_cabang='$exp2[2]' and id_barang='$exp[0]'") as $vl);
			
			if($_POST['jenis']==1){
				$nilai=0;
				$total=0;
			}
			if($_POST['jenis']==2){
				$nilai=$vl['nilai_bongkar'];
				$total=	$vl['nilai_bongkar']*$exp[3]*$_POST['qty_bongkar'][$key];
			}
			if($_POST['jenis']==3){
				$nilai=$vl['nilai_pok'];
				$total=	($vl['nilai_pok']*$exp[3])*$_POST['qty_bongkar'][$key];
			}
			$data = array( 
					'no_masuk' => $exp2[0], 
					'no_spj' => $exp2[1], 
					'id_cabang' => $exp2[2], 
					'id_barang' => $exp[0],
					'berat' => $exp[3],
					'jenis_jual' => $exp[5],
					'jenis_tkbm' => $_POST['jenis'],
					'id_jenis_kendaraan' => $_POST['kendar'][$key],
					'nilai' => $nilai,
					'jenis_tx' => 1,
					'total' => $total,
					'qty' => $_POST['qty_bongkar'][$key],
					'id_user' => $_SESSION['ID_LOGIN'],
					);
			$exec= $db->insert($tabel, $data);
			
			}
	  
	}
  }
	echo "<script>window.location='index.php?x=tkbmbeli&id=$_POST[id_stok]'</script>";	
}

?>