<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="3" align="left"><b><img src="assets/images/wa.png" width="70">&nbsp;&nbsp;<font size="+1">PURCHASE ORDER</font></b></td>
      <td width="40%" colspan="2" rowspan="3" align="center" valign="top">
      	<table border="1" bordercolor="#DDD" width="100%">
            <tr>
            	<td width="23%">&nbsp;No P.O</td>
                <td width="47%">&nbsp;<?=$_GET[id]?></td>
            </tr>
            <tr>
              <td>&nbsp;Tgl P.O</td>
              <td>&nbsp;<?=$konval[tgl_po]?></td>
            </tr>
            <tr>
              <td>&nbsp;Supplier</td>
              <td>&nbsp;<?=ucfirst(strtolower($konval[nama_usaha]))?></td>
            </tr>
            <tr>
              <td>&nbsp;Kirim Ke</td>
              <td>&nbsp;<?php
              if($konval['jenis_kirim']=='DA'){
				foreach($db->select("m_customer","nama_usaha,alamat_usaha","id_cus='$konval[id_daerah]'")as $de);
				echo $de['nama_usaha'];  
			  }else{
			  	echo $konval[nama_gudang];
			  }
			  ?></td>
            </tr>
             <tr>
              <td>&nbsp;Alamat</td>
              <td>&nbsp;<?php 
			  if($konval['jenis_kirim']=='DA'){
				echo $de['alamat_usaha'];    
			  }else{
			  	echo $konval[alamat];
			  }
			  ?></td>
            </tr>
           
        </table>
      
      </td>
    </tr>
   
    <tr>
      <td align="left" colspan="5">&nbsp;</td>
    </tr>
 </table>
  <table width="100%" cellpadding="0" cellspacing="0" class="ck" border="1" bordercolor="#DDD">
    
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Tgl Kirim</strong></td>
          <td width="4%" align="center"><strong>Qty Order</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_prp_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_prp='$konval[no_prp]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']."-".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="center"><?=$d['tgl_kirim']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
</table>	
<br>

      
