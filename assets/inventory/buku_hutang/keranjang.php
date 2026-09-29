<div class="form-group">
<label class="control-label col-lg-2 form-group ">Suplier</label>
<div class="col-lg-4">
                              	 
   	 <select name="cus" id="cus" class="select-search" onChange="pindahdatapel(cus.value)">
    					<option value="">--pilih--</option>
	   <?php
							  $query=$db->select("m_supplier","id_supp,kode_supp,nama_usaha,alamat_usaha"," status='1'");
							  foreach($query as $sel){	
						  ?>
					  <option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['cus']){echo "selected";}?>>
					  <?=$sel['kode_supp'].' - '.$sel['nama_usaha']?>
					  </option>
					  <?php }?>
         </select>
         <input type="hidden" value="<?=$_GET['cus']?>" name="cusa" id="cusa">
 </div>                                    

</div>



<?php //if($_GET['jen']==3){?>  
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center">&nbsp;</td>
          <td width="30%"><strong>No PJ</strong></td>
          <td width="20%"align="center"><strong>Tgl PJ</strong></td>
          <td width="20%"align="center"><strong>Total Hutang</strong></td>
          <td width="20%"align="center"><strong>Total Dibayar</strong></td>
          <td width="4%" align="center"><strong>Sisa</strong></td>
    </tr>
  <?php		
  if($_GET['cus']<>''){
	$exp=explode("_",$_GET['cus']);	
						  
	$kon=$db->select("tx_brg_masuk a left join m_supplier b on a.id_supp=b.id_supp",
	"a.id_supp,a.no_masuk,(a.total-ifnull((select sum(ifnull(total_dibayar,0)) 
	from tx_pembayaran_hutang where no_faktur=a.no_masuk group by no_faktur),0) )as total_hutang,
	a.tgl,b.nama_usaha","a.id_supp='$exp[0]' and a.status=0 and a.no_masuk not in (select no_faktur from tx_hutang_tmp)");
  }
	//echo "select a.id_supp,a.no_masuk,(a.total-ifnull((select sum(ifnull(total_dibayar,0)) 
	//from tx_pembayaran_hutang where no_faktur=a.no_masuk_jual group by no_faktur),0) )as total_hutang from tx_brg_masuk a left join m_supplier b on a.id_supp=b.id_supp where a.id_supp='$exp[0]' and a.status=0 and a.no_masuk not in (select no_faktur from tx_hutang_tmp)";
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center">
          <input type="checkbox" name="no_faktur[<?=$no?>]" id="no_faktur<?=$no?>" value="<?=$d['no_masuk']?>" onclick="hitungan(<?=$no?>)">
          </td>
          <td>&nbsp;<?php echo $d['no_masuk']?>&nbsp;</td>
          <td align="center"><?=date("d-m-Y",strtotime($d['tgl']))?>&nbsp;</td>
          <td align="center"><input type="text" size="15" name="total_hutang[<?=$no?>]" id="total_hutang<?=$no?>" value="<?=$d['total_hutang']?>" class="hargab" readonly="readonly"></td>
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