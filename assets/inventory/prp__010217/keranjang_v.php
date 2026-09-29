<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td align="left" colspan="10"><strong>&nbsp;Valuta 
		  <?php 
		  
		  
		  
		  
		 $kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$konval[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 foreach($kurs as $kursval){}
		 echo " : ".$kursval['nama_valuta'].' - '.$kursval['kurs'];
		  ?> </strong></td>
    </tr>
    <tr>
          <td width="4%" rowspan="2"align="center"><strong>No</strong></td>
          <td width="37%" rowspan="2" align="center"><strong>Nama Barang</strong></td>
          <td width="6%" rowspan="2"align="center"><strong>#</strong></td>
          <td width="4%" rowspan="2" align="center"><strong>Tgl Kirim</strong></td>
          <td width="4%" rowspan="2" align="center"><strong>Qty</strong></td>
          <td width="4%" rowspan="2" align="center"><strong>Bonus </strong></td>
          <td width="9%" rowspan="2" align="center"><strong>Harga</strong></td>
          <td width="7%" colspan="2" align="center"><strong>Disc</strong></td>
          <td width="7%" rowspan="2" align="center"><strong>Jumlah</strong></td>
    </tr>
    <tr>
      <td align="center"><strong>%</strong></td>
      <td align="center">$</td>
    </tr>
        <?php
		$kon=$db->select("tx_prp_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_prp='$_GET[id]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right">&nbsp;<?=$d['tgl_kirim']?>&nbsp;</td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right"><?=$d['bonus']?>                                              &nbsp;</td>
          <td align="right"><?=number_format($d['harga_beli'],2)?>&nbsp;</td>
          <td align="right"><?=$d['disc_persen']?>&nbsp;</td>
          <td align="right"><?=$d['disc_rupiah']?>&nbsp;</td>
          <td align="right">
		  <?php
		  $habel=$d['harga_beli']*$d['disc_persen']/100;
		  $habel=$d['harga_beli']-$habel;
		  echo number_format($sub=$habel*$d['qty']*$kursval['kurs'],2);
		  
		  ?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
      <tr>
          <td colspan="9" align="right"><b> Total</b>&nbsp;</td>
          <td align="right"><b><?php echo number_format($tot,2)?>&nbsp;</b></td>
     </tr>
     
      <tr>
        <td colspan="9" align="right"><b>Disc <?=$konval['disc_persen']?>%</b></td>
        <td align="right"><b><?php echo number_format($disc=$konval['disc_jumlah'],2);?></b>&nbsp;</td>
      </tr>
      <tr>
          <td colspan="9" align="right"><b>Grant Total</b>&nbsp;</td>
          <td align="right"><b><?php echo number_format($grant=$tot-$disc,2);?></b>&nbsp;</td>
     </tr>
</table>	
<br>

      
