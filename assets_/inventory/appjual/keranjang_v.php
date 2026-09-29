<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="9%" align="center"><strong>Harga</strong></td>
          <td width="7%" align="center"><strong>Tgl Kirim</strong></td>
          <td width="7%" align="center"><strong>Jumlah</strong></td>
    </tr>
    <?php
		$kon=$db->select("tx_sales_order_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_sales='$konval[no_sales]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right"><?=number_format($d['harga'],2)?>&nbsp;</td>
          <td align="right"><?php
           if($d['tgl_kirim']!=''){
											echo date("d-m-Y",strtotime($d['tgl_kirim']));
											}else{
											
											}
		  ?></td>
          <td align="right">
		  <?php
		  echo number_format($sub=$d['harga']*$d['qty'],2);
		  ?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
      <tr>
          <td colspan="5" align="right"><b> Total</b>&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td align="right"><b><?php echo number_format($tot,2)?>&nbsp;<input type="hidden" value="<?=$tot?>" name="jumlah" id="jumlah"></b></td>
     </tr>
</table>	
<br>
<?php 
if($konval['jenis']=='SWC' && $konval['jenis_jual']=='1'){?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td colspan="5"align="center"><b>SPJ Rilis <?=$konval[no_spj_rilis]?></b></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Harga Beli</strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
    </tr>
        <?php
		$kon=$db->select("v_spj_rilis","*","no_spj='$konval[no_spj_rilis]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="center">&nbsp;<?=number_format($d['price'])?>&nbsp;</td>
          <td align="right"><?=$d['qty_do']?>                                              &nbsp;</td>
     </tr>
        <?php $no++;} ?>
</table>	
<?php 
} 
if($konval['jenis']=='SWC' && $konval['jenis_jual']=='2'){?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td colspan="5"align="center"><b>SPJ Rilis <?=$konval[no_spj_rilis]?></b></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="10%"align="center"><strong># </strong></td>
          <td width="10%" align="center"><strong>Harga Beli</strong></td>
          <td width="10%" align="center"><strong>Qty </strong></td>
    </tr>
        <?php
		$exp=explode("_",$_GET['id']);
		$kon=$db->select("tx_prp_dtl a 
		left join tx_po b on a.no_prp=b.no_prp
		left join m_barang c on a.id_barang=c.id_barang 
		left join m_satuan d on c.id_satuan=d.id_satuan 
		","*","b.no_jwa='$konval[no_spj_rilis]'");
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
     </tr>
        <?php $no++;} ?>
</table>	
<?php }?>
      
