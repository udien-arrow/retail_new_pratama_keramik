<div class="form-group">
<label class="control-label col-lg-2 form-group ">Customer</label>
<div class="col-lg-4">
                              	 
   	 <select name="cus" id="cus" class="select-search" onChange="pindahdatapel(cus.value)">
    					<option value="">--pilih--</option>
    					<option value="0">--Tanpa Nama--</option>

	   <?php
							  $query=$db->select("m_customer","id_cus,kode_cus,nama_usaha,ship_to"," status='1'");
							  foreach($query as $sel){	
						  ?>
					  <option value="<?=$sel['id_cus']?>" <?php if($sel['id_cus']==$_GET['cus']){echo "selected";}?>>
					  <?=$sel['kode_cus'].' - '.$sel['nama_usaha']?>
					  </option>
					  <?php }?>
         </select>
         <input type="hidden" value="<?=$_GET['cus']?>" name="cusa" id="cusa">
 </div>                                    

<!--<div class="col-lg-4">
	<select name="jen" id="jen" class="select" onChange="pindahdatapel(cus.value,jen.value)">
    		<option value="1" <?php if($_GET['jen']==1){echo "selected";}?>>Tunai</option>
            <option value="2" <?php if($_GET['jen']==2){echo "selected";}?>>Transfer</option>
            <option value="3" <?php if($_GET['jen']==3){echo "selected";}?>>Bilyet Giro (BG)</option>
    </select>
</div>-->
</div>



<?php //if($_GET['jen']==3){?>  
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center">&nbsp;</td>
          <td width="30%"><strong>No PJ</strong></td>
          <td width="20%"align="center"><strong>Tgl PJ</strong></td>
          <td width="20%"align="center"><strong>Total Piutang</strong></td>
          <td width="20%"align="center"><strong>Total Dibayar</strong></td>
          <td width="4%" align="center"><strong>Sisa</strong></td>
    </tr>
  <?php		
  if($_GET['cus']<>''){
		$exp=explode("_",$_GET['cus']);						  
$kon=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.id_cus,no_faktur_jual,(total_piutang-ifnull((select sum(ifnull(total_dibayar,0)) from tx_pembayaran_sales where no_faktur=a.no_faktur_jual 
group by no_faktur
),0) )as total_piutang,tgl,b.nama_usaha","a.id_cus='$exp[0]' and a.status_bayar=0 and a.no_faktur_jual not in (select no_faktur from tx_piutang_tmp)");
//echo "select a.id_cus,no_faktur_jual,(total_piutang-ifnull((select sum(ifnull(total_dibayar,0)) from tx_pembayaran_sales where no_faktur=a.no_faktur_jual 
//group by no_faktur),0) )as total_piutang,tgl,b.nama_usaha from tx_piutang a left join m_customer b on a.id_cus=b.id_cus where a.id_cus='$exp[0]' and a.status_bayar=0 and a.no_faktur_jual not in (select no_faktur from tx_piutang_tmp)";

  }

        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center">
          <input type="checkbox" name="no_faktur[<?=$no?>]" id="no_faktur<?=$no?>" value="<?=$d['no_faktur_jual']?>" onclick="hitungan(<?=$no?>)">
          </td>
          <td>&nbsp;<?php echo $d['no_faktur_jual']?>&nbsp;</td>
          <td align="center"><?=date("d-m-Y",strtotime($d['tgl']))?>&nbsp;</td>
          <td align="center"><input type="text" size="15" name="total_piutang[<?=$no?>]" id="total_piutang<?=$no?>" value="<?=$d['total_piutang']?>" class="hargab" readonly="readonly"></td>
          <td align="center"><input type="text" size="15" name="dibayar[<?=$no?>]" id="dibayar<?=$no?>" value="0"  class="hargab"/ onkeyup="hitung(<?=$no?>)"></td>
          <td align="center"><input type="text" size="15" name="sisa[<?=$no?>]" id="sisa<?=$no?>" value="0"  class="hargab" readonly="readonly" /></td>
  </tr>
        <?php $no++;
		} 
		?>
      
</table>	
<div class="form-group">
	<label class="control-label col-lg-2 form-group "></label>
	
</div>

<div class="form-group">
		<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>																			 
 	<div class="col-lg-5">
		
        <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan 
        </button>
        
        
        
         <span class="col-lg-4">
         
    </span>  	</div> 
</div>