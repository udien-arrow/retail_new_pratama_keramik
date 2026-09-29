<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Harga Awal</strong></td>
          <td width="4%" align="center"><strong>Harga Koreksi</strong></td>
          <td width="9%" align="center"><strong>Harga</strong></td>
          <td width="9%" align="center"><strong>Jumlah</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_koreksi_piutang_dtl a 
		join m_barang b on a.id_barang=b.id_barang 
		join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_piutang='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right">&nbsp;<?=number_format($d['harga_awal'])?>&nbsp;</td>
          <td align="right"><?=number_format($d['harga_ganti'])?>&nbsp;</td>
          <td align="right"><?=$d['qty']?></td>
          <td align="right"><?=number_format($sub=$d['harga_ganti']*$d['qty'],2)?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
         <tr>
      <td colspan="6" align="center">Total</td>
      <td align="right"><?=number_format($tot,2)?>&nbsp;</td>
    </tr>
</table>	
<br>

      
