<script>
$(".datepicker").datepicker();
	 // Month and year menu
     $(".datepicker-menus").datepicker({
        changeMonth: true,
        changeYear: true
     });
     </script>
<?php
	require( '../../../webclass.php' );
	$dep='';
	$db=new kelas;
	
	$sat=$db->select("m_barang a join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan as sat,b.nama_satuan,'1' as konv,a.id_dep","a.id_barang='$_GET[id]' union select a.sat2,b.nama_satuan,a.konv,'' from m_konversi a left join m_satuan b on a.sat2=b.id_satuan where a.id_barang='$_GET[id]'");		
	
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['sat'].'_'.$val['konv']?>"><?php echo $val['nama_satuan']?></option>
	<?php
		if($val['konv']=='1'){
			$k=$val['sat'];
			$konvv=1;
			$dep=$val['id_dep'];
		}
			//$konvv=$val['konv'];	
	}
	
	if($dep==1){
		$dep=3;
	}elseif($dep==2){
		$dep=1;
	}
///========================================pricelist===========================================
	if($_GET['supp']){
		$skr=date("Y-m-d");
		$sql=$db->select("m_pricelist a 
		left join m_pricelist_dtl b on a.id_price=b.id_price
		","b.harga,b.sat","a.tgl_berlaku<='$skr' and a.status='1' and b.id_barang='$_GET[id]' and a.id_supp='$_GET[supp]' order by a.tgl_berlaku desc limit 0,1");
 		foreach($sql as $rsc2){
			$harga=$rsc2['harga'];
			$sat=$rsc2['sat'];
		}
		if($k==$sat){
			$harga2=$harga;	
			$harga1=$harga/$konvv;
		}else{
			$konv2=$db->select("m_konversi","*","id_barang='$_GET[id]' and sat2='$sat'");
			foreach($konv2 as $konv){}
			if($konv['konv']!=''){ //kalo yg diambil dari konversi
				$harga1=$harga/$konv['konv'];
				$harga2=$harga1*$konvv;
			}else{//klo g da di konversi, 
				$harga1=$harga;
				$harga2=$harga1*$konvv;
			}
			
		}
			echo "<script>$('#harga$_GET[id]').val('$harga2');
		$('#harga_asli$_GET[id]').val('$harga1')
		$('#jen_bar$_GET[id]').val('$dep')
		</script>";
	}
?>
