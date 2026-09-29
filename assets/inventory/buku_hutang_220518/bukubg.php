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
            <th width="8%" align="center"><font style="color:#FFF"><b>No Faktur</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Tgl BG</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>No Spj</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>No Seri</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Nama Bank BG</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Jatuh Tempo</b></font></th>
            <th width="8%" align="center"><font style="color:#FFF"><b>Nilai BG</b></font></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		 $sql=$db->select("tx_piutang a left join tx_buku_bg b on a.no_ref=b.no_spj","b.no_spj,b.no_fj,b.tgl_bg,b.no_seribg,b.jatuh_tempo,b.nilai_bg","a.id_piutang='$_GET[id]' and b.status='0'");
		  foreach($sql as $arr){  
		  
		  ?>
          <tr>
            <td align="left"><?php echo $arr['no_fj'];?></td>
            <td align="left" ><?php echo $arr['tgl_bg'];?></td>
            <td align="left" ><?php echo $arr['no_spj'];?></td>
            <td align="left" ><?php echo $arr['no_seribg'];?></td>
            <td align="left" ><?php echo $arr['id_bank'];?></td>
            <td align="left" ><?php echo date("d-m-Y",strtotime($arr['tgl_bg']));?></td>
            <td align="right" ><?php echo number_format($arr['nilai_bg']);?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
</div>
<p>&nbsp;</p>
</div>
