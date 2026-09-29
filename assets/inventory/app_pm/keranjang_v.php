<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td align="left" colspan="6"><strong>&nbsp;Valuta 
		  <?php 
		  $kon=$db->select("tx_bm_order","*","no_order='$_GET[id]'");	
		  foreach($kon as $konval){}	
		  
		 $kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$konval[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 foreach($kurs as $kursval){}
		 echo " : ".$kursval['nama_valuta'].' - '.$kursval['kurs'];
		  ?> </strong></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="2%" align="center"><strong>Harga</strong></td>
          <!--<td width="7%" align="center"><strong>Jumlah</strong></td>-->
    </tr>
    <?php
		$kon=$db->select("tx_bm_order_dtl a 
		left join m_barang b on a.id_barang=b.id_barang 
		left join m_satuan c on a.sat=c.id_satuan
		","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_order='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		$kon=$db->select("tx_so_dtl","ifnull(price,0)as price","id_barang='$d[id_barang]' order by id_dtl desc limit 0,1");
		foreach($kon as $kv){}
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right">
          <input type="text" name="harga2[]" id="harga2" size="5" value="<?=$kv['price']?>"><input type="hidden" name="id_bar2[]"  size="5" value="<?=$d['id_barang']?>">
          <input type="hidden" name="qty[]" id="qty2" size="5" value="<?=$d['qty']?>">           
          </td>
          <!--<td align="right"><input type="text" name="total[]" id="total" size="5" value="<?=$kv['price']*$d['qty']?>">            &nbsp;</td>-->
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
</table>	
<br>

      
