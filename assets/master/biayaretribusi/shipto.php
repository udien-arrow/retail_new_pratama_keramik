	<?php
	require( '../../../webclass.php' );
	$db=new kelas;
		$query=$db->select("m_customer_shipto","*","id_cus='$_GET[id]'");
		foreach($query as $sel){	
	?>
	<option value="<?=$sel['shipto_code']?>"><?=$sel['shipto_code'].'-'.$sel['shipto_name']?>
	</option>
	<?php } ?>
