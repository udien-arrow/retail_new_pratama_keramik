<option value="">---Pelanggan---</option>
<?php
	error_reporting(0);
	session_start();
	require( '../../../webclass.php' );
	$db=new kelas;
	
	/*$query=$db->select("m_customer","id_cus,kode_cus,nama_usaha,ship_to,jenis","id_cabang='$_SESSION[ID_CABANG]' and head=''");
	foreach($query as $sel){	
	?>
	<option value="<?=$sel['id_cus'].'_'.$sel['kode_cus'].'_'.$sel['nama_usaha'].'_'.$sel['ship_to'].'_'.$sel['jenis']?>">
	<?=$sel['kode_cus'].' - '.$sel['nama_usaha']?>
	</option>
<?php 
}*/
?>
