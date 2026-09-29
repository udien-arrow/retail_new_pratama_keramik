	<?php

	$tgl=date("Y-m-d",strtotime($_POST['tgl']));
	$jum=count($db->select("hr_ijin_tmp","*","id_pegawai='$_POST[pegawai]' and date='$tgl'"));	
	if($jum==0){
			$tabel = "hr_ijin_tmp";
			
			if($_POST['pegawai']=='all'){
				$peg=$db->select("m_pegawai","*","id_aktif='1' or id_aktif='2'");
				foreach($peg as $pval){
					$data = array( 
							'id_pegawai' => $pval['id_pegawai'],
							'date' => $tgl, 
							'jenis' => $_POST['jenis'],
							'ket' => $_POST['ket'],
							'id_user' => $_SESSION['ID_LOGIN'],
							);				
					$exec= $db->insert($tabel, $data);
				}
				
			}else{
				$data = array( 
						'id_pegawai' => $_POST['pegawai'],
						'date' => $tgl, 
						'jenis' => $_POST['jenis'],
						'ket' => $_POST['ket'],
						'id_user' => $_SESSION['ID_LOGIN'],
						);				
				
				$exec= $db->insert($tabel, $data);
			}
	}
			echo "<script>window.location='index.php?x=ijin&id=$_POST[pegawai]'</script>";

?>