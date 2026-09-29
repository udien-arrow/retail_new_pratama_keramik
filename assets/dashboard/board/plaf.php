<?php
	error_reporting(0);
	require( '../../../webclass.php' );
	$db=new kelas;
	
?>
<div class="table-responsive">
<div class="table-responsive pre-scrollable">
  <table  class="table datatable table-bordered table-striped table-hover dataTable no-footer" border="0">
    <thead>
         
          <tr bgcolor="#28343a">
            <th width="5%" align="center"><font style="color:#FFF"><b>No</b></font></th>
            <th width="10%" align="center"><font style="color:#FFF"><b>Tgl Update</b></font></th>
            <th width="20%" align="center"><font style="color:#FFF"><b>Nama Menu</b></font></th>
            <th width="60%" align="center"><font style="color:#FFF"><b>Keterangan</b></font></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		  $info=$db->select("r_update","*","status=1");
		  $no=1;
		  foreach($info as $infoval){
		  ?>
          <tr>
            <td align="left"><?php echo $no;?></td>
            <td align="left" ><?php echo date("d-m-Y",strtotime($infoval['tgl']));?></td>
            <td align="left" ><?php echo $infoval['nama_menu'];?></td>
            <td align="left" ><?php echo $infoval['keterangan'];?></td>
          </tr>
          <?php
		  $no++; 
		  }?>
          
         
        </tbody>
      </table>
</div>
<p>&nbsp;</p>
</div>
