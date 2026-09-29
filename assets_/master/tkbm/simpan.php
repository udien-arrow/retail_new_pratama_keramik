<?php
$tabel = "m_tkbm";
	foreach($_POST['barang'] as $key => $val){
	  if($val>0){
		$jum=count($db->select("m_tkbm","*","id_cabang='$_POST[cab]' and id_barang='".$_POST['barang'][$key]."'"));
		if($jum==0){
			$ids=$db->idurut("m_tkbm","id");
			$data2 = array( 
					'id' => $ids, 
					'id_cabang' => $_POST['cab'],
					'id_barang' => $_POST['barang'][$key],
					'nilai_bongkar' => $_POST['bongkar'][$key],
					'nilai_muat' => $_POST['muat'][$key],
					'nilai_pok' => $_POST['pok'][$key],
					);
			$exec= $db->insert($tabel, $data2);
		}else{
			$data2 = array( 
					'nilai_bongkar' => $_POST['bongkar'][$key],
					'nilai_muat' => $_POST['muat'][$key],
					'nilai_pok' => $_POST['pok'][$key],
					);
			$exec= $db->update($tabel, $data2,"id='".$_POST['idtkbm'][$key]."'");
		}
	  }
	}
	echo "<script>window.location='index.php?x=tkbm&cabang=$_POST[cabangs]'</script>";	
?>