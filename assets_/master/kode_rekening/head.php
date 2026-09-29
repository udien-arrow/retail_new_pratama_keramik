<?php
require( '../../../webclass.php' );
$db=new kelas;
		?>
        <option value="0">Pilih Header</option>
        <?php
		if($_GET[jen]=="0"){
		$query1=$db->select("ak_acc","*","type='$_GET[kel]' AND LR='0'");
		}
		else {
			$query1=$db->select("ak_acc","*","type='$_GET[kel]' OR LR='$_GET[jen]'");
			}
		//echo"SELECT * FROM acc_group";
		foreach($query1 as $shel1){
	?>
			<option value="<?=$shel1['account']?>"><?=$shel1['account']?> - <?=$shel1['description']?></option>
   <?php							
		}
		?>
