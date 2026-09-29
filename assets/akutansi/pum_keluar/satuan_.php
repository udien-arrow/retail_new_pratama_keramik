<?php
	require( '../../../webclass.php' );
	$db=new kelas;


 if($_GET[jenis]==2){
	$exp=explode("/",$_GET[spb]);
	$periode="_".intval(substr($exp[2],4,2)).substr($exp[2],0,4);
	$sat=$db->select("tx_order_dtl$periode a 
	left join m_satuan b on a.sat=b.id_satuan
	","a.sat,b.nama_satuan,a.qty","a.id_barang='$_GET[id]' and a.no_order='$_GET[spb]'");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['sat']?>" ><?php echo $val['nama_satuan']?></option>
	<?php
		$k=$val['sat'];
		$qty=$val['qty'];
	}
	
	$sat=$db->select("m_barang a left join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan,b.nama_satuan","a.id_barang='$_GET[id]' and a.id_satuan<>'$k'");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['id_satuan']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	}
	$sat2=$db->select("m_konversi a left join m_satuan b on a.sat2=b.id_satuan","a.sat2,b.nama_satuan","a.id_barang='$_GET[id]' and a.sat2<>'$k'");
	foreach($sat2 as $val){
	?>
	<option value="<?php echo $val['sat2']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	}	
?>	
	<script>
    	$("#qty_minta<?php echo $_GET['id'];?>").val('<?php echo $qty;?>');
    </script>	
<?php	
}else{
	$sat=$db->select("m_barang a left join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan,b.nama_satuan","a.id_barang='$_GET[id]'");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['id_satuan']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	$k=$val['id_satuan'];
	}
	$sat2=$db->select("m_konversi a left join m_satuan b on a.sat2=b.id_satuan","a.sat2,b.nama_satuan","a.id_barang='$_GET[id]'");
	foreach($sat2 as $val){
	?>
	<option value="<?php echo $val['sat2']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	}
 }
///========================================pricelist===========================================
	if($_GET[supp]){
		$skr=date("Y-m-d");
		$sql=$db->select("m_pricelist a left join m_pricelist_dtl b on a.id_price=b.id_price","b.harga,b.sat","a.tgl_berlaku<='$skr' and a.status='1' and b.id_barang='$_GET[id]' and a.id_supp='$_GET[supp]' order by a.tgl_berlaku desc limit 0,1");
 		foreach($sql as $rsc2){
			$harga=$rsc2['harga'];
			$sat=$rsc2['sat'];
		}
				if($k==$sat){
					$harga=$harga;	
				}else{
					$konv2=$db->select("m_konversi","*","id_barang='$_GET[id]' and sat2='$k'");
					foreach($konv2 as $konv){}
					$harga=$harga*$konv['konv'];
				}
		echo "<script>$('#harga$_GET[id]').val('$harga')</script>";
	}

?>
