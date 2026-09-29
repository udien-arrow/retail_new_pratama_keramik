<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Tgl Kir</strong></td>
          <td width="9%" align="center"><strong>Qty</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_order_dtl a left join m_barang b on a.id_barang=b.id_barang left join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_order='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right">&nbsp;<?=$d['tgl_kirim']?>&nbsp;</td>
          <td align="right">
          <input type="hidden" name="idnya[]" value="<?=$d['id_barang']?>">
          <input type="text" name="editnya[]" style="width:80px;" value="<?=$d['qty']?>">
          <input type="hidden" name="tglkim[]" style="width:80px;" value="<?=$d['tgl_kirim']?>">&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
</table>	
<br>

      
