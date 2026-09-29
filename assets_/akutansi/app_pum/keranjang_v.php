<?php
		$kon=$db->select("ak_pum","*","NO_PUM='$_GET[id]'");
        foreach($kon as $d){  }
		?>
&nbsp;&nbsp;&nbsp;<b>Keterangan : <?=$d['CATATAN']?></b>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%" align="center"><strong>Keperluan</strong></td>
          <td width="10%"align="center"><strong>Jumlah</strong></td>
    </tr>
   <?php
		$kon=$db->select("ak_pum_dtl","*","NO_PUM='$_GET[id]'");
		$no=1;
        foreach($kon as $d){ 
		$tot+=$d['JUMLAH'];
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?=$d['KEPERLUAN'];?>&nbsp;</td>
          <td align="right">&nbsp;<?=number_format($d['JUMLAH'])?></td>
     </tr>
        <?php $no++; 
		} ?>
    <tr>
    	<td align="right" colspan="2"><b>Total</b></td>
        <td align="right"><b><?=number_format($tot)?></b></td>
    </tr>
</table>

      
