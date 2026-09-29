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
  <div class="col-lg-2">
  <select name="bulan" id="bulan" class="select green-gradient" onchange="changeData(bulan.value,tahun.value)" >
		
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
  <div class="col-lg-3">
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

</div>
<div class="col-lg-3">
      <select class="select-search" name="cabang" id="cabang">
           <option value="">--Cabang--</option>
          <?php
		  if($_SESSION['ID_CABANG']==0 || $_SESSION['ID_CABANG']==99){
			$whe="id_cabang like '%%'";		  
	      }else{
			$whe="id_cabang='$_SESSION[ID_CABANG]'";		    
		  }
		  
          $query=$db->select("m_cabang","*","$whe");
          foreach($query as $sel){	
      ?>
      <option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$_GET['cab']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
	</select>
</div>
