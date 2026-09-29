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
      <div class="col-lg-4">
  <select name="bulansd" id="bulansd" class="select green-gradient">	
		<option value='06'>Juni</option>
        <option value='12'>Desember</option>
  </select>
  </div>
  <div class="col-lg-3">
  <!-- Display Tahun -->
  <select name="tahunsd" id="tahunsd" class="select green-gradient" onchange="changeData(bulan.value,tahun.value)" >
  <?php
  for($j=2000;$j<=2100;$j++)
  {
	if ($_GET['tahun']==$j)
	  {
	  ?>
		<option value=<?php echo $j;?> selected><?php echo $j;?></option>
	  <?php
	  }
	else
		{
			//default jika pertama kali loading, maka buat now
			if  ($_GET['tahun']=="")
			{ 
				if ((int)$thnsaiki==$j) 
				{
				?>
				<option value=<?php echo $j;?> selected><?php echo $j;?></option>
				<?php 
				}
				else
				{
				?>
				<option value=<?php echo $j;?>><?php echo $j;?></option>
				<?php
				}
			}
			else
			{
				?>
				<option value=<?php echo $j;?>><?php echo $j;?></option>
				<?php
			}
		}
  } // end for

?>
</select>
</div>

</div>

