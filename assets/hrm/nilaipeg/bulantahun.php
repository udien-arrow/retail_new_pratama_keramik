<?php

$bulan_data=array("Januari","Februari","Maret","April","Mei","Juni","Juli",
			"Agustus","September","Oktober","Nopember","Desember");
$blnsaiki=date("m");
$thnsaiki=date("Y");
//$as=$_GET['per'];

//$a=sy
//die($as);
?>
<!-- Display Bulan -->

<div class="form-group">
      <label class="control-label col-lg-4">Periode </label>
      <div class="col-lg-2">
		<input type="text" name="tgl" id="tgl" maxlength="2" class="form-control" autocomplete="off" value="" placeholder="tgl" required>
		</div>
      <div class="col-lg-4">
  <select name="bulan" id="bulan" class="select green-gradient">	
<?php
	for($i=0;$i<count($bulan_data);$i++)
	{
		if  ((int)($_GET['bulan'])==$i+1)
		{
			?>
			<option value=<?php printf("%02d",$i+1)?> selected><?php echo $bulan_data[$i];?></option>		
			<?php
		}
		else
		{
			//default jika pertama kali loading, maka buat now
			if  ($_GET['bulan']=="")
			{ 
				if ((int)$blnsaiki==$i+1) 
				{
				?>
				<option value=<?php printf("%02d",$i+1)?> selected><?php echo $bulan_data[$i];?></option>		
				<?php
				}
				else
				{
				?>
				<option value=<?php printf("%02d",$i+1)?>><?php echo $bulan_data[$i];?></option>		
				<?php
				}
			}
			else
			{
				?>
				<option value=<?php printf("%02d",$i+1)?>><?php echo $bulan_data[$i];?></option>		
				<?php
			}
		}
	}
	?>
  </select>
  </div>
 
</div>

