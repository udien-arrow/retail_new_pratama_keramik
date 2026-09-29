<?php
require( '../../../webclass.php' );
$db=new kelas;
?>
	<option value="0">Pilih Jenis Akun</option>
	<?php
		$query1=$db->select("ak_acc_type","*","id_group='$_GET[kel]'");
		//echo"SELECT * FROM acc_group";
		foreach($query1 as $shel1){
	?>
			<option value="<?=$shel1['id_param']?>"><?=$shel1['nama']?></option>
   <?php									
		}
	?>
