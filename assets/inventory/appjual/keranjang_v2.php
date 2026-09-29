<?php
$kon=$db->select("tx_sales_biaya_tmp aa 
left join tx_sales_order a on aa.no_so=a.no_sales
left join m_customer b on a.id_cus=b.id_cus","a.no_sales,b.kode_cus,b.nama_usaha,aa.id_tmp,aa.id_cus,a.status_so,a.id_gudang,a.id_cabang,a.id_cabang_direct,aa.jenis_kirim","aa.id_cabang='$_SESSION[ID_CABANG]' order by aa.id_tmp asc");	

 $noo=1;
foreach($kon as $konval){
$tot=0;
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="8"align="left"><b>&nbsp;<?php echo ucfirst(strtoupper($konval['no_sales'].' - '.$konval['kode_cus'].' - '.$konval['nama_usaha']));?></b></td>
      <td align="center"><!--<button type="button" style="height:25px; line-height: 0;" class="btn btn-info btn-sm" data-toggle="modal" id="mod" onClick="pel('<?=$par?>')" data-target="#datapelanggan">Limit Plafon</button>--></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="37%" align="center"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="9%" align="center"><strong>Harga</strong></td>
          <td width="10%" align="center"><strong>Jumlah</strong></td>
          <td width="10%" align="center"><strong>Biaya Bongkar Toko</strong></td>
          <td width="10%" align="center"><strong>Gaji Supir</strong></td>
           <td width="7%" align="center"><a href="javascript:void(0)" onclick="hapus(<?php echo $konval['id_tmp'];?>)">hapus</a></td>
    </tr>
    <?php
		$no=1;
		$kon=$db->select("tx_sales_order_dtl a 
		join m_barang b on a.id_barang=b.id_barang 
		join m_satuan c on a.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.no_sales='$konval[no_sales]'");
       
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;
          <input type="hidden" value="<?=$d['id_barang']?>" id="bar_<?=$konval['id_cus'].'_'.$no.'_'.$noo?>" name="bar[]">
          <input type="hidden" value="<?=$d['qty']?>" id="qty_<?=$konval['id_cus'].'_'.$no.'_'.$noo?>" name="qty[]">
         <input type="hidden" value="<?=$konval['no_sales']?>" name="nos[]">
         <input type="hidden" value="<?=$konval['id_cus']?>"  name="idc[]">
         </td>
          <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right"><?=number_format($d['harga'],2)?>&nbsp;</td>
          
          <td align="right">
		  <?php
		  echo number_format($sub=$d['harga']*$d['qty'],2);
		  ?>&nbsp;</td>
          <td align="right" >
          <input type="text" size="4" style="border-color:#E2E2E2" value="" class="hargab" name="bmu[]" id="bmu_<?=$konval['id_cus'].'_'.$no.'_'.$noo?>" onKeyUp="haha()" ></td>
          <td align="right" >
          <input type="text" size="4" style="border-color:#E2E2E2" class="hargab" value="" name="bsin[]" id="bsin_<?=$konval['id_cus'].'_'.$no.'_'.$noo?>" onKeyUp="haha()" readonly></td>
      <td align="center"></td>
  </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
      
      <tr>
          <td colspan="5" align="right"><b> Total</b>&nbsp;</td>
         
          <td align="right"><b><?php echo number_format($tot,2)?>&nbsp;<input type="hidden" value="<?=$tot?>" name="jumlah" id="jumlah">
            <input type="hidden" value="<?=$no?>" name="nom" id="nom_<?=$konval['id_cus']?>">
            <input type="hidden" value="<?=$konval['id_cus']?>" name="cu[]" id="cu_<?=$noo?>">
          </b></td>
          <td align="right">&nbsp;</td>
          <td align="right">&nbsp;</td>
           <td align="right">&nbsp;</td>
     	</tr>
</table>	
<?php
$noo++;
 }
 ?>
<input type="hidden" name="nome" id="nome"  value="<?=$no?>"> 
<input type="hidden" name="id" id="id"  value="<?=$konval['id_sales']?>"  required>
            		<input type="hidden" name="stain" id="stain"  value="<?=$konval['status_so']?>"  required>
                    <input type="hidden" name="no_orderin" id="no_orderin"  value="<?=$konval['no_sales']?>"  required>
                    <input type="hidden" name="id_cus" id="id_cus"  value="<?=$konval['id_cus']?>"  required>
                    <input type="hidden" name="jenis_jual" id="jenis_jual"  value="<?=$konval['jenis_kirim']?>"  required>
                    <input type="hidden" name="id_gudang" id="id_gudang"  value="<?=$konval['id_gudang']?>"  required>
                    <input type="hidden" name="id_cabang" id="id_cabang"  value="<?=$konval['id_cabang']?>"  required>
                    <input type="hidden" name="id_cabang_direct" id="id_cabang_direct"  value="<?=$konval['id_cabang_direct']?>"  required>



      
