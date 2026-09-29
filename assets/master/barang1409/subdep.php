<?php
	require( '../../../webclass.php' );
	$db=new kelas;

	$query=$db->select("m_subdep","*","id_dep='$_GET[id]'");
	?>
	<option value="">Pilih Sub Departemen</option>
	<?php
	foreach($query as $sel){	
	?>
    <option value="<?=$sel['id_sub']?>" <?php if($sel['id_sub']==$_GET['id']){echo "selected";}?>><?=$sel['nama_sub']?></option>
	<?php 
    }
    ?> 
