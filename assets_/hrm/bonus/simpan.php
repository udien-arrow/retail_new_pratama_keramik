	<?php
	
if($_POST['periode']!=''){	
foreach($_POST['id_pegawai'] as $key => $val){
	if($val!=''){
			
				$tgl=date("Y-m-d",strtotime($_POST['tgl_kontrak'][$key]));
				$tgl2=date("Y-m-d",strtotime($_POST['periode']));
				
				if($_POST['jenis']==6){
					$exp=explode("-",$_POST['tgl_kontrak'][$key]);
					$exp2=explode("/",$_POST['periode']);
					$bul=(int)$exp[1];
					if($bul>5){
						$tgl22=($exp2[2]+1).'-05-17';		
					}else{
						$tgl22=$exp2[2].'-05-17';	
					}
					
				}else{
					$tgl22=date("Y-m-d",strtotime($_POST['periodebay']));
				}
				$jb=str_replace(",","",$_POST['jumlah_bonus'][$key]);
				$ppp=str_replace(",","",$_POST['potpel'][$key]);
				$ppl=str_replace(",","",$_POST['potlain'][$key]);
				$jt=$jb-$ppp-$ppl;
				
				$tabel = "hr_bonus";
				$data = array( 
						'jenis' => $_POST['jenis'],
						'id_pegawai' => $val,
						'stampdate' => date("Y-m-d H:i:s"), 
						'periode' => $tgl2,
						'periode_dibayar' => $tgl22,
						'masa_kerja' => $_POST['masa_kerja'][$key],
						'tgl_kontrak' => $tgl,
						'gaji_pokok' => str_replace(",","",$_POST['gaji_pokok'][$key]),
						'tunjangan_tetap' => str_replace(",","",$_POST['tunj_tetap'][$key]),
						'insentif_presensi' => str_replace(",","",$_POST['presensi'][$key]),
						'total' => str_replace(",","",$_POST['total'][$key]),
						'faktor_kali' => $_POST['faktor_kali'][$key],
						'id_cabang' => $_POST['idcab'][$key],
						'id_pangkat' => $_POST['idpangkat'][$key],
						'nilai_tanda' => $_POST['nilaitanda'][$key],
						'stpeg' => $_POST['stpeg'][$key],
						'jumlah_bonus' => str_replace(",","",$_POST['jumlah_bonus'][$key]),
						'pot_pelanggaran' => str_replace(",","",$_POST['potpel'][$key]),
						'pot_lain' => str_replace(",","",$_POST['potlain'][$key]),
						'jumlah_terima' => $jt,
						);				
				$exec= $db->insert($tabel, $data);
	}
}
}else{
	echo "<script>alert('Periode belum diset');</script";
	
	}
			echo "<script>window.location='index.php?x=bonus'</script>";

?>