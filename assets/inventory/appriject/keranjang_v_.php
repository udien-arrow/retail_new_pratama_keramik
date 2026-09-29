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
          <td width="7%" align="center"><strong>Jumlah</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_bm_order_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_order='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right"><input type="text" name="harga" id="harga" size="5" value="0">&nbsp;</td>
          <td align="right">
		  <?php
		  $habel=$d['harga']*$d['disc_persen']/100;
		  $habel=$d['harga']-$habel;
		  echo number_format($sub=$habel*$d['qty']*$kursval['kurs'],2);
		  
		  ?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
      <tr>
          <td colspan="5" align="right"><b> Total</b>&nbsp;</td>
          <td align="right"><b><?php echo number_format($tot,2)?>&nbsp;</b></td>
     </tr>
      <tr>
          <td colspan="5" align="right"><b>Ppn</b>&nbsp;</td>
          <td align="right"><b>
		  <?php 
		  
		  if($konval['pkp']==2){
		       $ppn=0;
		  }else{
			   $ppn=$tot/10;
	      }
		  echo number_format($ppn,2)
		  
		  
		  ?></b>&nbsp;</td>
     </tr>
      <tr>
          <td colspan="5" align="right"><b>Grant Total</b>&nbsp;</td>
          <td align="right"><b><?php echo number_format($grant=$tot+$ppn-$disc,2);?></b>&nbsp;</td>
     </tr>
</table>	
<br>

      
