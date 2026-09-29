
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
          <td width="10%" align="center"><strong>Total</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_brg_masuk_tmp a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.id_user='$_SESSION[ID_LOGIN]' and a.id_gudang='$_SESSION[ID_GUDANG]'");
		
		
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="center">&nbsp;<?=number_format($d['harga_beli'])?>&nbsp;</td>
          <td align="right"><?=$d['qty']?>                                              &nbsp;</td>
          <td align="right"><?=$tot=$d['qty']*$d['harga_beli']?>                                              &nbsp;</td>
     </tr>
        <?php 
		$toti+=$tot;
		$no++;} ?>
        
</table>
<input type="hidden" name="jenis_in" id="jenis_in" value="8">	
<input type="hidden" name="total" id="total" value="<?=$toti?>">	
