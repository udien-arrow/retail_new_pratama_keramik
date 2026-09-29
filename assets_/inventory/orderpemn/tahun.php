<?php

$bulan_data=array("Januari","Februari","Maret","April","Mei","Juni","Juli",
			"Agustus","September","Oktober","Nopember","Desember");

$thnsaiki=date("Y");
//$as=$_GET['per'];

//$a=sy
//die($as);
?>
<!-- Display Bulan -->
 

  <!-- Display Tahun -->
  <select name="tahun" id="tahun" class="select green-gradient" onchange="changeData(bulan.value,tahun.value)" >
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



