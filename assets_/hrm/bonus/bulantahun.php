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
      <!--<div class="col-lg-2">
  <select name="bulan" id="bulan" class="select green-gradient" onchange="changeData(bulan.value,tahun.value)" >
		
<?php
	/*for($i=0;$i<count($bulan_data);$i++)
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
	}*/
	?>
  </select>
  </div>-->
  <div class="col-lg-3">
  <!-- Display Tahun -->
  <select name="tahun" id="tahun" class="select-search" onchange="changeData(bulan.value,tahun.value)" >
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
<div class="col-lg-3">
										<select class="select-search" name="jenis" id="jenis" required>
									    <option value="">--Jenis--</option>
									    <option value="1" <?php if($_GET['jen']==1){echo "selected";}?>>THR</option>
                                        <option value="8" <?php if($_GET['jen']==8){echo "selected";}?>>Bonus Tahunan</option>
                                        <option value="2" <?php if($_GET['jen']==2){echo "selected";}?>>Kinerja Triwulan</option>
                                        <option value="3" <?php if($_GET['jen']==3){echo "selected";}?>>Cuti Tahunan</option>
                                        <option value="7" <?php if($_GET['jen']==7){echo "selected";}?>>Besar</option>
                                        <option value="4" <?php if($_GET['jen']==4){echo "selected";}?>>Tunjangan Keluarga</option>
                                        <option value="5" <?php if($_GET['jen']==5){echo "selected";}?>>Fasilitas Jabatan</option>
                                        <option value="6" <?php if($_GET['jen']==6){echo "selected";}?>>Ikatan Batin</option>
								    </select>
									</div>



