<div class="form-group">
<label class="control-label col-lg-2 form-group ">Customer</label>
<div class="col-lg-4">
                              	 
   	 <select name="cus" id="cus" class="select-search" onChange="pindahdatapel(cus.value,jen.value)">
    					<option value="">--pilih--</option>
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

<div class="col-lg-4">
	<select name="jen" id="jen" class="select" onChange="pindahdatapel(cus.value,jen.value)">
    		<option value="1" <?php if($_GET['jen']==1){echo "selected";}?>>Tunai</option>
            <option value="2" <?php if($_GET['jen']==2){echo "selected";}?>>Transfer</option>
            <option value="3" <?php if($_GET['jen']==3){echo "selected";}?>>Bilyet Giro (BG)</option>
    </select>
</div>
</div>


<?php if($_GET['jen']==1){?>  
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="30%"><strong>No PJ</strong></td>
          <td width="20%"align="center"><strong>Tgl PJ</strong></td>
          <td width="20%"align="center"><strong>Total Piutang</strong></td>
          <td width="20%"align="center"><strong>Total Dibayar</strong></td>
          <td width="4%" align="center"><strong>Sisa</strong></td>
    </tr>
 
 

  <?php		
		$exp=explode("_",$_GET['cus']);						  
$kon=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.id_cus,no_faktur_jual,(total_piutang-ifnull((select sum(ifnull(total_dibayar,0)) from tx_pembayaran_sales where no_faktur=a.no_faktur_jual 
group by no_faktur
),0) )as total_piutang,tgl,b.nama_usaha","a.id_cus='$exp[0]' and a.status_bayar=0");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['no_faktur_jual']?>&nbsp;</td>
          <td align="center"><?=date("d-m-Y",strtotime($d['tgl']))?>&nbsp;</td>
          <td align="center"><input type="text" size="20" name="total_piutang[<?=$no?>]" id="total_piutang<?=$no?>" value="<?=$d['total_piutang']?>" class="hargab" readonly="readonly">
          <input type="hidden" size="20" name="no_faktur[<?=$no?>]" id="no_faktur<?=$no?>" value="<?=$d['no_faktur_jual']?>">
          </td>
          <td align="center"><input type="text" size="20" name="dibayar[<?=$no?>]" id="dibayar<?=$no?>" value="0"  class="hargab"/ onkeyup="hitung(<?=$no?>)">            &nbsp;</td>
          <td align="center"><input type="text" size="20" name="sisa[<?=$no?>]" id="sisa<?=$no?>" value="0"  class="hargab" readonly="readonly"/>
          
          </td>
     </tr>
        <?php $no++;
		} 
		?>
      
</table>	


<br><br>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Kas/bank</label>
	 <div class="col-lg-6">
           <select name="kasbank" class="select">
           			<?php
                	$query=$db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]'");
					foreach($query as $sel){	
						  ?>
					  <option value="<?=$sel['account']?>">
					  <?=$sel['account'].' - '.$sel['description']?>
					  </option>
					  <?php 
						}
						?>
           </select>
    </div>
</div>
        
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Bayar</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
          <input type="hidden" class="form-control" name="jumrow" id="jumrow" value="<?=$no?>" />
          
         </div>
  </div>
</div>
<?php
}//end if =1

?>
<?php if($_GET['jen']==2){?>  
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="30%"><strong>No PJ</strong></td>
          <td width="20%"align="center"><strong>Tgl PJ</strong></td>
          <td width="25%"align="center"><strong>Bank</strong></td>
          <td width="20%"align="center"><strong>Total Piutang</strong></td>
          <td width="20%"align="center"><strong>Total Dibayar</strong></td>
          <td width="4%" align="center"><strong>Sisa</strong></td>
    </tr>
 
 

        <?php		
		$exp=explode("_",$_GET['cus']);						  
$kon=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.id_cus,no_faktur_jual,(total_piutang-ifnull((select sum(ifnull(total_dibayar,0)) from tx_pembayaran_sales where no_faktur=a.no_faktur_jual 
group by no_faktur
),0) )as total_piutang,tgl,b.nama_usaha","a.id_cus='$exp[0]' and a.status_bayar=0");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['no_faktur_jual']?>&nbsp;</td>
          <td align="center"><?=date("d-m-Y",strtotime($d['tgl']))?>&nbsp;</td>
          <td align="center">
          <select name="kasbank[<?=$no?>]" id="kasbank[<?=$no?>]" class="select">
           			<?php
                	$query=$db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb=2");
					foreach($query as $sel){	
						  ?>
					  <option value="<?=$sel['account']?>">
					  <?=$sel['account'].' - '.$sel['description']?>
					  </option>
					  <?php 
						}
						?>
           </select>
          </td>
          <td align="center"><input type="text" size="15" name="total_piutang[<?=$no?>]" id="total_piutang<?=$no?>" value="<?=$d['total_piutang']?>" class="hargab" readonly="readonly">
          <input type="hidden" size="20" name="no_faktur[<?=$no?>]" id="no_faktur<?=$no?>" value="<?=$d['no_faktur_jual']?>"></td>
          <td align="center"><input type="text" size="15" name="dibayar[<?=$no?>]" id="dibayar<?=$no?>" value="0"  class="hargab"/ onkeyup="hitung(<?=$no?>)"></td>
          <td align="center"><input type="text" size="15" name="sisa[<?=$no?>]" id="sisa<?=$no?>" value="0"  class="hargab" readonly="readonly"/></td>
     </tr>
        <?php $no++;
		} 
		?>
</table>	
<br>
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Bayar</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
          <input type="hidden" class="form-control" name="jumrow" id="jumrow" value="<?=$no?>" />
         </div>
  </div>
</div>

<?php
}//end if =2
?>
<?php if($_GET['jen']==3){?>  
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
		$exp=explode("_",$_GET['cus']);						  
$kon=$db->select("tx_piutang a left join m_customer b on a.id_cus=b.id_cus","a.id_cus,no_faktur_jual,(total_piutang-ifnull((select sum(ifnull(total_dibayar,0)) from tx_pembayaran_sales where no_faktur=a.no_faktur_jual 
group by no_faktur
),0) )as total_piutang,tgl,b.nama_usaha","a.id_cus='$exp[0]' and a.status_bayar=0");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center">
          <input type="checkbox" name="no_faktur[<?=$no?>]" id="no_faktur<?=$no?>" value="<?=$d['no_faktur_jual']?>" onclick="hitungan(<?=$no?>)">
          </td>
          <td>&nbsp;<?php echo $d['no_faktur_jual']?>&nbsp;</td>
          <td align="center"><?=date("d-m-Y",strtotime($d['tgl']))?>&nbsp;</td>
          <td align="center"><input type="text" size="20" name="total_piutang[<?=$no?>]" id="total_piutang<?=$no?>" value="<?=$d['total_piutang']?>" class="hargab" readonly="readonly">
          
          </td>
          <td align="center"><input type="text" size="20" name="dibayar[<?=$no?>]" id="dibayar<?=$no?>" value="0"  class="hargab"/ onkeyup="hitung(<?=$no?>)" readonly="readonly">            &nbsp;</td>
          <td align="center"><input type="text" size="20" name="sisa[<?=$no?>]" id="sisa<?=$no?>" value="0"  class="hargab" readonly="readonly" />
          
          </td>
  </tr>
        <?php $no++;
		} 
		?>
      
</table>	


<br><br>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Kas/bank</label>
	 <div class="col-lg-6">
           <select name="kasbank" class="select">
           			<?php
                	$query=$db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]'");
					foreach($query as $sel){	
						  ?>
					  <option value="<?=$sel['account']?>">
					  <?=$sel['account'].' - '.$sel['description']?>
					  </option>
					  <?php 
						}
						?>
           </select>
    </div>
</div>
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Total Dibayar</label>
	<div class="col-lg-4">
      <div class="input-group">
          <input type="text" class="form-control" name="tot" id="tot" value="0" autocomplete="off" readonly="readonly" >
        <input type="hidden" class="form-control" name="tot2" id="tot2" value="0" autocomplete="off" readonly="readonly" />
         </div>
  </div>
</div>

<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">No Seri BG</label>
	<div class="col-lg-4">
         <div class="input-group">
          <input type="text" class="form-control" name="no_seri" id="no_seri" value="" required="required" autocomplete="off">
         </div>
  </div>
</div>


<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Tempo</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tglt" id="tglt" value="<?php echo date('d-m-Y');?>">
         </div>
  </div>
</div>
        
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Bayar</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
          <input type="hidden" class="form-control" name="jumrow" id="jumrow" value="1" />
         </div>
  </div>
</div>
<?php
}//end if =1

?>


<div class="form-group">
	<label class="control-label col-lg-2 form-group "></label>
	
</div>

<div class="form-group">
		<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>																			 
 	<div class="col-lg-5">
		
        <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan 
        </button>
        
        
         <button class="btn btn-success" type="button" onClick="batal()">
		 Batal 
         </button>
         <span class="col-lg-4">
         
    </span>  	</div> 
</div>