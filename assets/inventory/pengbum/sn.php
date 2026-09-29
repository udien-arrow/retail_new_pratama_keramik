<?php
	require( '../../../webclass.php' );
	$db=new kelas;
	$sat=$db->select("tx_brg_masuk_dtl_non a left join tx_brg_masuk b on a.no_masuk=b.no_masuk","a.*,b.id_gudang","a.id_barang='$_GET[id]' and b.id_gudang='$_GET[gud]' and a.sn NOT IN (select sn from tx_pengbum_tmp where id_barang='$_GET[id]' and id_gudang='$_GET[gud]') and a.status=1");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['id_barang'].'_'.$val['sn']?>"><?php echo $val['sn']?></option>
	<?php
	}
?>
