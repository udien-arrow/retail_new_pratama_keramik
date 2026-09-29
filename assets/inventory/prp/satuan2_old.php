<?php
	require( '../../../webclass.php' );
	$db=new kelas;


if($_GET['jenis']==2){
	$exp=explode("/",$_GET['spb']);
	//$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
	$sat=$db->select("  tx_order_dtl a 
						left join m_satuan b on a.sat=b.id_satuan
						left join m_konversi c on a.sat=c.sat2","a.sat,b.nama_satuan,a.qty,IFNULL(c.konv,1)as konv"," 
						a.id_barang='$_GET[id]' and a.no_order='$_GET[spb]'
					    union
					    select d.sat2,b.nama_satuan,'',d.konv from m_konversi d 
						left join m_satuan b on d.sat2=b.id_satuan where 
					    d.id_barang='$_GET[id]' and d.sat2<>(select sat from tx_order_dtl
					    where no_order='$_GET[spb]' and id_barang='$_GET[id]')
					    union
					    select e.id_satuan,b.nama_satuan,'','1' from m_barang e 
						left join m_satuan b on e.id_satuan=b.id_satuan where 
					    e.id_barang='$_GET[id]' and e.id_satuan<>(select sat from tx_order_dtl
					    where no_order='$_GET[spb]' and id_barang='$_GET[id]')");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['sat'].'_'.$val['konv']?>" <?php if($val['qty']!=''){echo 'selected';}?>><?php echo $val['nama_satuan']?></option>
	<?php
		
		if($val['qty']!=''){
			$k=$val['sat'];
			$qty=$val['qty'];
			$konvv=$val['konv'];
		}
	}	
?>	
	<script>
    	//$("#qty_minta<?php echo $_GET['id'];?>").val('<?php echo $qty;?>');
		$("#qty<?php echo $_GET['id'];?>").val('<?php echo $qty;?>');
    </script>	
<?php	
}else{
	//$sat=$db->select("m_barang a left join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan,b.nama_satuan","a.id_barang='$_GET[id]'");
	$sat=$db->select("m_konversi d 
						left join m_satuan b on d.sat2=b.id_satuan","d.sat2,b.nama_satuan,'',d.konv"," 
					    d.id_barang='$_GET[id]' 
					    union
					    select e.id_satuan,b.nama_satuan,'','1' from m_barang e 
						left join m_satuan b on e.id_satuan=b.id_satuan where 
					    e.id_barang='$_GET[id]'");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['sat2'].'_'.$val['konv']?>" selected><?php echo $val['nama_satuan']?></option>
	<?php
			$k=$val['sat2'];
			$konvv=$val['konv'];
	}
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
		echo "<script>$('#harga$_GET[id]').val('$harga2');$('#harga_asli$_GET[id]').val('$harga1')</script>";
	}

?>
