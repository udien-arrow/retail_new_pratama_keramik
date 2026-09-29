<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="6"align="left">&nbsp; <?=$_GET[id]?></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="37%"><strong>Nama Barang</strong></td>
          <td width="6%" align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty Pesan</strong></td>
          <td width="7%" align="center"><strong>Qty Terima</strong></td>
          <td width="7%" align="center"><strong>Selisih</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_brg_masuk_dtl a left join m_barang_gudang b on a.id_barang=b.id_barang 
		join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_masuk='$_GET[id]' and id_gudang='$konval[id_gudang]'");
       

	 $no=1;
        foreach($kon as $d){  
		?>
    
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right"><?=$d['qty_terima']?>&nbsp;</td>
          <td align="right"><?=$d['qty_kurang']?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
        <tr>
          <td colspan="6" align="left" valign="top"><br>
          &nbsp;Keterangan : <?=$konval['ket']?>
          <br> <br> <br>
          </td>
        </tr>
</table>	<br>


      
