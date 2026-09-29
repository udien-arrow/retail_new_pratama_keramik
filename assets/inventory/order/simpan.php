<?php
$tabel = "tx_order_tmp";
if($_POST[id]==''){
		if($_POST['tambah_in']=='rame'){
		foreach($_POST['qty1'] as $key => $val){
			if($val!='' && $_POST['jenis']!=''){
				$data = array( 
						'id_barang' => $_POST['idbar'][$key], 
						'qty' => $val,
						'tgl_kirim' => date("Y-m-d",strtotime($_POST['tglkir'][$key])),
						'id_user' => $_SESSION['ID_LOGIN'],
						'sat' => $_POST['sat'][$key],
						'ke_gudang' => 0,
						'jenis' => $_POST['jenis'],
						
						);
				$exec= $db->insert($tabel, $data);
			}
		}
	}
	if($_POST['gud']=='0'){$gud='';}else{$gud=$_POST['gud'];}
		echo "<script>window.location='index.php?x=order&jenis=$_POST[jenis]&gud=$gud'</script>";
				
}else{
	if($_POST['tambah_in']=='ijen'){		
	  if($_POST['jumlah']>1){			
		for($i=1;$i<=$_POST['jumlah'];$i++){
			if($_POST['qty_in'.$i]!=''){	
			$data = array( 
					'id_barang' => $_POST['id'], 
					'tgl_kirim' => $_POST['tgl'.$i], 
					'qty' => $_POST['qty_in'.$i],
					'id_user' => $_SESSION['ID_LOGIN'],
					'ke_gudang' => $_POST['gud_in'],
					'jenis' => $_POST['jenis'],
					'sat' => $_POST['sat_in'],
					);
			$exec= $db->insert($tabel, $data);
			}
		}
	  }else{
		  
		  $data = array( 
					'id_barang' => $_POST['id'], 
					'qty' => $_POST['qty_in1'],
					'tgl_kirim' => date("Y-m-d",strtotime($_POST['tglkirin'])),
					'id_user' => $_SESSION['ID_LOGIN'],
					'ke_gudang' => $_POST['gud_in'],
					'jenis' => $_POST['jenis'],
					'sat' => $_POST['sat_in'],
					);
			$exec= $db->insert($tabel, $data);
		  	
 	  }
	}	
	echo "<script>window.location='index.php?x=order&jenis=$_POST[jenis]&gud=$_POST[gud_in]&bulan=$_POST[bulan]&tahun=$_POST[tahun]&tahap=$_POST[tahap]'</script>";
	
}


?>