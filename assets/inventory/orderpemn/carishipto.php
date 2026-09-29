<?php
	require( '../../../webclass.php' );
	$db=new kelas;

	$sat=$db->select("m_gudang_shipto a left join m_daerah b on a.id_gudang=b.id_gudang","a.shipto_code,a.shipto_name","b.id_daerah='$_GET[id]'");
	foreach($sat as $val){
	?>
	<option value="<?php echo $val['shipto_code']?>"><?php echo $val['shipto_code'].' - '.$val['shipto_name']?></option>
	<?php
	}
	?>
