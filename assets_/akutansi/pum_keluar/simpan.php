<?php
$tabel = "tx_prp_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		
		$spb=explode("_",$_POST['spb']);	
			
		foreach($_POST['qty'] as $key => $val){
			if($_POST['jenis_barang']==1){
				$t="$_POST[harga][$key]>0";
			}else{
				$t="$_POST[harga][$key]>=0";	
			}
			
			if($_POST['jenis_barang']==''){
				$jn=$_POST['jen_bar'][$key];	
			}else{
				$jn=$_POST['jenis_barang'];	
			}
			
		if($val!='' && $t){	
			$hargadisc=0;
				$explo=explode("_",$_POST['sat'][$key]); 
				if($_POST['disc'][$key]>0 || $_POST['disc'][$key]!=''){
					$hargadisc=($_POST['harga'][$key]*$_POST['disc'][$key])/100;
				}else{
					$hargadisc='';
				}
				if($_POST['tgl_kirim2'][$key]==''){
					//$tgl="";	
				}else{
					$tgl=date("Y-m-d",strtotime($_POST['tgl_kirim2'][$key]));	
				}
				
				$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'sat' => $explo[0],
						'qty' => $val,
						'id_user' => $_SESSION['ID_LOGIN'],
						'harga_beli' => str_replace(",","",$_POST['harga'][$key]),
						'disc' => $_POST['disc'][$key],
						'disc_rupiah' => $hargadisc,
						'id_supp' => $_POST['supp'],
						'bonus' => $_POST['bonus'][$key],
						'no_order' => $spb[0],
						'jenis' => $_POST['jenis'],
						'jenis_barang' => $jn,
						'tgl_kirim' => $tgl,
						'shipto_code' => $spb[2],
						'id_daerah' => $spb[1],
						'jenis_kirim' => $spb[3],
						);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
	
	if($_POST['supp']=='0'){$supp='';}else{$supp=$_POST['supp'];}
		echo "<script>window.location='index.php?x=prp&jenis=$_POST[jenis]&spb=$_POST[spb]&supp=$supp'</script>";			
}else{
	if($_POST['tambah_in']=='ijen'){
		$spb=explode("_",$_POST['spb']);		
		$explo=explode("_",$_POST['sat_in']); 	
		if($_POST['disc_in']>0 || $_POST['disc_in']!=''){
			$hargadisc=($_POST['harga_in']*$_POST['disc_in'])/100;		
		}else{
			$hargadisc=0;
			}
		if($_POST['tgl_kirim']==''){
						
				}else{
					$tgl=date("Y-m-d",strtotime($_POST['tgl_kirim']));	
				}
			
		$data = array( 
				'id_barang' => $_POST['id'], 
				'sat' => $explo[0],
				'qty' => $_POST['qty_in'],
				'id_user' => $_SESSION['ID_LOGIN'],
				'harga_beli' => str_replace(",","",$_POST['harga_in']),
				'id_supp' => $_POST['supp'],
				'disc' => $_POST['disc_in'],
				'disc_rupiah' => $hargadisc,
				'bonus' => $_POST['bonus_in'],
				'no_order' => $spb[0],
				'jenis' => $_POST['jenis'],
				'jenis_barang' => $_POST['jenis_barang'],
				'tgl_kirim' => $tgl,
				'shipto_code' => $spb[2],
				'id_daerah' => $spb[1],
				'jenis_kirim' => $spb[3],
				);
		$exec= $db->insert($tabel, $data);
	}	
	echo "<script>window.location='index.php?x=prp&jenis=$_POST[jenis]&spb=$_POST[spb]&supp=$_POST[supp]&jenisnya=$_POST[jenisnya]'</script>";	
}


?>