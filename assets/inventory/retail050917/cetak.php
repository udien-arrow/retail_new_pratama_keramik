<?php
$user_ip = getenv('REMOTE_ADDR');
//echo $user_ip;

$data=$db->select("pj_penjualan","jenis_jual","id_pj='$_POST[id]'");
foreach ($data as $data2){}
$idur = $_POST['id'];	
	
//--------------- cek retail atau grosir

if ( $data2['jenis_jual']=='1'){		
		
		if ($user_ip == '192.168.1.26'){
		?>
		 <script>
			//$('#ok').click();
			//function print(){document.getElementById("ok").click();}
			//print();
			//alert ('print kecil');
			window.location='jav:<?=$_POST['id']?>:penjualan'; 
			window.location='index.php?x=retail'; 
		</script>;  
		<?php
		}else{
		?>	
		  <script>
			//$('#ok').click();
			//function print(){document.getElementById("ok").click();}
			//print();
			//alert ('print besar');
			window.location='jav:<?=$_POST['id']?>:penjualan2'; 
			window.location='index.php?x=retail'; 
		
			</script>;  
		 <?php 
		}
}else{
$koneksi=$db->select("pj_penjualan_dtl a inner join m_barang b on a.id_barang = b.id_barang","b.nama_barang,a.id_pj,count(a.id_pj) as qty","id_pj = '$idur'  group by id_pj");
//echo "select  b.nama_barang,a.id_pj,count(a.id_pj) as qty from pj_penjualan_dtl a inner join m_barang b on a.id_barang = b.id_barang where id_pj = '$idur'  group by id_pj";
//exit;
if ( strpos($koneksi[0]['nama_barang'],'BIMA') !== false AND $koneksi[0]['qty'] == '1')
{
 ?> 
  <script>
	//$('#ok').click();
	//function print(){document.getElementById("ok").click();}
	//print();
	//window.location='jav:<?=$idur?>:grosir'; 
	//alert ('bima');
	window.location='jav:<?=$idur?>:bima'; 
	window.location='index.php?x=retail'; 

	</script>; 
<?php
}else{
	
	$koneksi2=$db->select("m_customer a inner join m_customer_shipto b on a.id_cus = b.id_cus", "*", "a.id_cus = '$_POST[cust2]'"); 
	if ($koneksi2[0]['shipto_code'] != '' ){
	?>	
	  <script>
		//$('#ok').click();
		//function print(){document.getElementById("ok").click();}
		//print();
		//window.location='jav:<?=$idur?>:grosir'; 
		//alert ('jalan');		
		window.location='jav:<?=$idur?>:jalan'; 
		window.location='index.php?x=retail'; 

		</script>; 
	<?php 
	 
	}else{
	
	?>	
	 
	  <script>
		//$('#ok').click();
		//function print(){document.getElementById("ok").click();}
		//print();
		//window.location='jav:<?=$idbarang?>:barang';		
		//window.location='jav:<?=$idur?>:grosir2';
		//alert('retail');		
		window.location='jav:<?=$idur?>:jalan2';	 
		window.location='index.php?x=retail'; 

		</script>; 
	 <?php	
	}//END NON BIMA
	}// END BIMA	
}
//--------------- endcek retail atau grosir

?>
