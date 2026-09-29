<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="2%" align="center"><strong>Harga</strong></td>
          <!--<td width="7%" align="center"><strong>Jumlah</strong></td>-->
    </tr>
    <?php
		$kon=$db->select("tx_jual_riject_dtl a 
		left join m_barang b on a.id_barang=b.id_barang 
		left join m_satuan c on a.id_satuan=c.id_satuan
		","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_sales='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right">
          <input type="text" name="harga2[]" id="harga2" size="5" value="<?=$d['harga']?>"><input type="hidden" name="id_bar2[]"  size="5" value="<?=$d['id_barang']?>">
          </td>
          <!--<td align="right"><input type="text" name="total[]" id="total" size="5" value="<?=$kv['price']*$d['qty']?>">&nbsp;</td>-->
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		
		} ?>
</table>	
<input type="hidden" name="nosales" id="nosales" size="5" value="<?=$_GET['id']?>">

<br>

      
