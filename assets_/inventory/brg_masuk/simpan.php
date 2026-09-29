<?php
$tabel = "tx_brg_masuk_tmp";
		if($_POST['tambah_in']=='rame'){	
		foreach($_POST['qty_terima'] as $key => $val){
		if($val!='' && $val!=0){
				$expl=explode("#",$_POST['gabung'][$key]);
				$id_barang=$expl[0];
				$sat=$expl[1];
				$harga_beli=$expl[2];
				$ppn=$expl[3];
				$kurs=$expl[4];
				
				if($_POST['disc_persen']=='' || $_POST['disc_persen']==0){
					$harga_beli=$harga_beli;
				}else{
					$disc=($harga_beli*$_POST['disc_persen'])/100;
					$harga_beli=$harga_beli-$disc;
				}
				
				foreach($db->select("m_barang","berat","id_barang='$id_barang'")as $ber);
				
				if($val>$_POST['qty_pesan'][$key]){
					echo "<script>alert('Qty Melebihi')</script>";
				}else{
				$explpo=explode("_",$_POST['id']);
				$data = array( 		
						'id_supp' => $_POST['id_supp'], 
						'id_barang' => $id_barang, 
						'qty' => $_POST['qty_pesan'][$key], 
						'qty_terima' => $val, 
						'qty_bonus' => $_POST['qty_bonus'][$key], 
						#'claim_utuh' => $_POST['claim_utuh'][$key], 
						#'claim_ktg' => $_POST['claim_ktg'][$key], 
						'harga_beli' => $harga_beli,
						'ppn' => $ppn, 
						'id_valuta' => $_POST['id_valuta'], 
						'kurs' => $_POST['kurs'], 
						'id_user' => $_SESSION['ID_LOGIN'], 
						'sat' => $sat, 
						'no_po' => $explpo[0], 
						'no_prp' => $explpo[1], 
						'line' => $explpo[2], 
						'id_po' => $_POST['id_po'],
						'id_prp' => $_POST['id_prp'],
						'jenis' => $_POST['jenis_in'],
						'id_gudang' => $_SESSION['ID_GUDANG'],  
						'disc_global' => $_POST['disc_persen'],  
						'berat' => $ber['berat'],  
						);
				$exec= $db->insert($tabel, $data);
				}
			}
		}
		if($_POST[spb]!=''){
			$sp='spb';	
			$ps=$_POST[spb];	
		}elseif($_POST[spj]!=''){
			$sp='spj';	
			$ps=$_POST[spj];	
		}elseif($_POST[spm]!=''){
			$sp='spm';	
			$ps=$_POST[spm];	
		}
	}
		echo "<script>window.location='index.php?x=brg_masuk&jenis=$_POST[jenis_in]&$sp=$ps'</script>";			


?>