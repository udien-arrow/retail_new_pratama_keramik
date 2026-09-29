<?php
	require( '../../../webclass.php' );
	$db=new kelas;

	$jum=count($db->select("m_konversi","*","id_barang='$_GET[id]' and def=1"));
	
	if($jum==0){
	$sat=$db->select("m_barang a join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan,b.nama_satuan,'1' as def","a.id_barang='$_GET[id]'");	
	}else{
	$sat=$db->select("m_barang a join m_satuan b on a.id_satuan=b.id_satuan","a.id_satuan,b.nama_satuan,'0' as def","a.id_barang='$_GET[id]' union
select a.sat2,b.nama_satuan,a.def from m_konversi a left join m_satuan b on a.sat2=b.id_satuan where a.id_barang='$_GET[id]'");
	}
	foreach($sat as $val){
	if($val['def']!=0){
	?>
	<option value="<?php echo $val['id_satuan']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	}
	}
	/*$sat2=$db->select("m_konversi a left join m_satuan b on a.sat2=b.id_satuan","a.sat2,b.nama_satuan","a.id_barang='$_GET[id]'");
	foreach($sat2 as $val){
	?>
	<option value="<?php echo $val['sat2']?>"><?php echo $val['nama_satuan']?></option>
	<?php
	}*/
?>
