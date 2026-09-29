<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <?php if($konval['no_so']==''){ ?>
    <tr>
      <td colspan="3" align="left">
      <label class="control-label col-lg-3 form-group ">Sales Order </label>
       <div class="col-lg-4">
       
        <select name="so" id="so" class="select-search" onChange="pindahData3('<?php echo $_GET['id']?>',so.value)">
          <option value="">---No SO---</option>
          <?php
				  $query=$db->select("tx_so","sales_order","sales_order not in (select no_so from tx_po where no_so is not null) group by sales_order");
				  foreach($query as $sel){	
			  ?>
<option value="<?=$sel['sales_order']?>" <?php if($sel['sales_order']==$_GET['so']){echo "selected";}?>><?=$sel['sales_order']?></option>
<?php 
				  
			  }
			  
			  
			  ?>
        </select>
        <input type="hidden" name="po" id="po" value="<?=$_GET[id]?>">
        </div>
         <div class="col-lg-3">
        <input type="submit" class="btn btn-info" name="simpana" id="simpana" value="Simpan" onclick="pindahData3('<?=$_GET['jenis']?>',gud.value,bulan.value,tahun.value,tahap.value)">
        
        </div>
      
      </td>
      <td width="6%" colspan="2" rowspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  
    <tr>
      <td align="left" colspan="5">&nbsp;</td>
    </tr> <?php }?>
 </table>
  <table width="100%" cellpadding="0" cellspacing="0" class="ck" border="1" bordercolor="#DDD">
    
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%" align="center"><strong>Tgl Kirim</strong></td>
          <td width="10%"align="center"><strong>Item Code</strong></td>
          <td width="30%" align="center"><strong>Item</strong></td>
          <td width="7%" align="center"><strong> Order</strong></td>
          <td width="7%" align="center"><strong> Real</strong></td>
          <td width="7%" align="center"><strong> Open</strong></td>
    </tr>
    <?php
		if($konval['no_so']==''){ 
			$kon=$db->select("tx_so_dtl a left join m_barang b on a.id_barang=b.id_barang","a.*,b.nama_barang,b.kode_barang","sales_order='$_GET[so]'");
		}else{
			$kon=$db->select("tx_so_dtl a left join m_barang b on a.id_barang=b.id_barang","a.*,b.nama_barang,b.kode_barang","sales_order='$konval[no_so]'");
		}
		$no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['delivery_date'];?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['kode_barang']?>&nbsp;</td>
          <td align="center"><?=$d['nama_barang']?></td>
          <td align="right"><?=$d['so_qty']?></td>
          <td align="right"><?=$d['real_qty']?>&nbsp;</td>
          <td align="right"><?=$d['so_open']?>&nbsp;</td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
</table>	

<?php 


?>
<br>

      
