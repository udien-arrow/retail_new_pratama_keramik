<?php
	require( '../../../webclass.php' );
	$db=new kelas;
	  $query=$db->select("m_kat","*","id_sub='$_GET[idsub]'");
	?>
	<option value="">Pilih Katagori</option>
	<?php
	  foreach($query as $sel){	

  ?>
	  <option value="<?=$sel['id_kat']?>"><?=$sel['nama_kat']?></option>
  <?php }?> 
