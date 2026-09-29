<?php
	require( '../../../webclass.php' );
	$db=new kelas;
	
	$sat=$db->select("m_kendaraan","*","id_cabang='$_SESSION[ID_CABANG]'");
?>
	<option value='' selected>-pilih-</option> 
	<?php foreach($sat as $val){
	?>
	<option value="<?php echo $val['id']?>"><?php echo $val['nopol']?></option>
	<?php
	}
?>
