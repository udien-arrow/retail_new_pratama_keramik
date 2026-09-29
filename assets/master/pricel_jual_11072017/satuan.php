<?php
	require( '../../../webclass.php' );
	$db=new kelas;
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
 

?>
