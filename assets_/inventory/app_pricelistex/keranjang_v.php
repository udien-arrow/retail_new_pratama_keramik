<table width="100%" bpengbum="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%" align="center"><strong>OA</strong></td>
          <td width="10%"align="center"><strong>Gaji Supir</strong></td>
          <td width="10%"align="center"><strong>Gaji Kernet</strong></td>
          <td width="10%"align="center"><strong>UJS</strong></td>
          <td width="10%" align="center"><strong>KM</strong></td>
          <td width="10%" align="center"><strong>Kosongan</strong></td>
          <td width="10%" align="center"><strong>Premi</strong></td>
    </tr>
    <?php
		$kon=$db->select("v_app_price_ex","*","id='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="right"><?php echo $no?>&nbsp;</td>
          <td align="right">&nbsp;<?php echo number_format($d['tarif_oa']);?>&nbsp;</td>
          <td align="right">&nbsp;<?php echo number_format($d['gaji_sopir']);?></td>
          <td align="right">&nbsp;<?php echo number_format($d['gaji_kernet']);?></td>
          <td align="right">&nbsp;<?php echo number_format($d['ujs']);?></td>
          <td align="right"><?php echo $d['km'];?></td>
          <td align="right"><?php echo number_format($d['kosongan']);?></td>
          <td align="right"><?php echo number_format($d['premi']);?></td>
  
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
</table>	
<br>

      
