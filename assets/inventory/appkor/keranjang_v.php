<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Harga Awal</strong></td>
          <td width="4%" align="center"><strong>Harga Koreksi</strong></td>
          <td width="9%" align="center"><strong>Qty</strong></td>
          <td width="9%" align="center"><strong>Ket</strong></td>
          <td width="9%" align="center"><strong>Jumlah</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_koreksi_piutang_dtl a
		join tx_koreksi_piutang aa on a.no_piutang=aa.no_koreksi 
		join m_barang b on a.id_barang=b.id_barang 
		join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan,aa.no_ref","a.no_piutang='$_GET[id]'");
        $no=1;
        foreach($kon as $d){ 
		
		foreach($db->select("tx_retur_pen_dtl a join tx_retur_pen b  on a.no_retur=b.no_retur","a.qty_kembali","b.no_ref='$d[no_ref]' and a.id_barang='$d[id_barang]'")as $rt); 
		//echo $rt['qty_kembali'];
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right">&nbsp;<?=number_format($d['harga_awal'])?>&nbsp;</td>
          <td align="right"><?=number_format($d['harga_ganti'])?>&nbsp;</td>
          <td align="right"><?=$d['qty']-$rt['qty_kembali']?></td>
          <td align="ket"><?=$d['ket']?></td>
          <td align="right"><?=number_format($sub=$d['harga_ganti']*($d['qty']-$rt['qty_kembali']),2)?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		$tots=$tots+($d['harga_awal']*($d['qty']-$rt['qty_kembali']));
		} 
		?>
         <tr>
           <td colspan="6" align="center">Total Sebelumnya</td>
           <td align="right">&nbsp;</td>
           <td align="right"><?=number_format($tots,2)?>&nbsp;</td>
         </tr>
         <tr>
           <td colspan="6" align="center">Total</td>
           <td align="right">&nbsp;</td>
           <td align="right"><?=number_format($tot,2)?>&nbsp;</td>
         </tr>
         <tr>
      <td colspan="6" align="center">Selisih</td>
      <td align="right">&nbsp;</td>
      <td align="right"><?=number_format($tots-$tot,2)?>&nbsp;</td>
    </tr>
</table>	
<br>

      
