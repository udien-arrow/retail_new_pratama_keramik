<?php
$tabel = "tx_sales_order_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		$explo=explode("_",$_POST['cus2']);	
		foreach($_POST['qty'] as $key => $val){
			if($val!=''){
			$skr=date("Y-m-d");
			if($_POST['tglkir'][$key]!=''){
				$tglk=date("Y-m-d",strtotime($_POST['tglkir'][$key]));
			}else{	
			}
			$sql=$db->select("m_pricelist_jual a 
		left join m_pricelist_jual_dtl b on a.id_price=b.id_price","b.harga,b.sat","a.tgl_berlaku<='$skr' and a.status='1' and b.id_barang='".$_POST['idbar'][$key]."'and a.id_cabang='$_SESSION[ID_CABANG]' order by a.tgl_berlaku desc limit 0,1");
		foreach($sql as $vl){}
				$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'id_satuan' => $_POST['sat'][$key],
						'qty' => $_POST['qty'][$key],
						'id_user' => $_SESSION['ID_LOGIN'],
						'id_gudang' => $_POST['gud'],
						'harga' => str_replace(",","",$_POST['harga'][$key]),
						'jenis_jual' => $_POST['jen'],
						'tgl_kirim' => $tglk,
						'id_cus' => $explo[0],
						);
				$exec= $db->insert($tabel, $data);
			}
		
		}
	}
		echo "<script>window.location='index.php?x=salesorder&gud=".$_POST[gud]."&jen=".$_POST[jen]."&cus=".$_POST[cus2]."'</script>";
				
}else{
	if($_POST['tambah_in']=='ijen'){	
			$explo=explode("_",$_POST['cus2']);
			$skr=date("Y-m-d");
			$sql=$db->select("m_pricelist_jual a 
		left join m_pricelist_jual_dtl b on a.id_price=b.id_price","b.harga,b.sat","a.tgl_berlaku<='$skr' and a.status='1' and b.id_barang='$_POST[id]' and a.id_cabang='$_SESSION[ID_CABANG]' order by a.tgl_berlaku desc limit 0,1");
		foreach($sql as $vl){}
			if($_POST['tglkir_in']!=''){
				$tglk=date("Y-m-d",strtotime($_POST['tglkir_in']));
			}else{
				
			}
			$data = array( 
					'id_barang' => $_POST['id'], 
					'id_satuan' => $_POST['sat_in'],
					'qty' => $_POST['qty_in'],
					'jenis_jual' => $_POST['jen'],
					'id_cus' => $explo[0],
					'id_user' => $_SESSION['ID_LOGIN'],
					'id_gudang' => $_POST['gud'],
					'tgl_kirim' => $tglk,
					'harga' => str_replace(",","",$_POST['harga_in']),
					);
			$exec= $db->insert($tabel, $data);
			
	echo "<script>window.location='index.php?x=salesorder&gud=".$_POST[gud]."&jen=".$_POST[jen]."&cus=".$_POST[cus2]."'</script>";
	}
}


?>