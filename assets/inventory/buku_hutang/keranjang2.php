<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="30%"><strong>No PJ</strong></td>
          <td width="20%"align="center"><strong>Total Piutang</strong></td>
          <td width="20%"align="center"><strong>Total Dibayar</strong></td>
          <td width="4%" align="center"><strong>Sisa</strong></td>
    </tr>
  <?php		
		$exp=explode("_",$_GET['cus']);						  
		$kon=$db->select("tx_hutang_tmp","*","id_user='$_SESSION[ID_LOGIN]'");
        $no=1;
        foreach($kon as $d){  
		?>
    
    <tr>
          <td>&nbsp;<?php echo $d['no_faktur']?>&nbsp;</td>
          <td align="right"><?php echo number_format($d['total_hutang'])?></td>
          <td align="right"><?php echo number_format($d['total_dibayar'])?>&nbsp;</td>
          <td align="right"><?php echo number_format($d['total_hutang']-$d['total_dibayar'])?>
          <input type="hidden" name="no_faktur[]" value="<?=$d['no_faktur']?>">
          <input type="hidden" name="total_hutang[]" value="<?=$d['total_hutang']?>">
          <input type="hidden" name="dibayar[]" value="<?=$d['total_dibayar']?>">
          <input type="hidden" name="sisa2[]" value="<?=$d['total_hutang']-$d['total_dibayar']?>">
          </td>
  </tr>
        <?php $no++;
		$t1+=$d['total_hutang'];
		$t2+=$d['total_dibayar'];
		$t3+=($d['total_hutang']-$d['total_dibayar']);
		
		} 
		?>
    <tr>
      <td>&nbsp;</td>
      <td align="right"><b><?php echo number_format($t1)?></b></td>
      <td align="right"><b><?php echo number_format($t2)?></b></td>
      <td align="right"><b><?php echo number_format($t3)?></b></td>
    </tr>  
</table>	


<br><br>
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Total Dibayar</label>
	<div class="col-lg-4">
      <div class="input-group">
          <input type="text" class="form-control" name="tot" id="tot" value="<?php echo $t2;?>" autocomplete="off" readonly="readonly" >
      </div>
  </div>
</div>
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tunai</label>
	<div class="col-lg-3">
      <div class="input-group">
          <input type="text" class="form-control" name="tunai" id="tunai" value="0" autocomplete="off" onkeyup="hit1()" >
      </div>
  </div>
  <div class="col-lg-6" id="tun" style="display:none"> 
           <select name="kasbank_tun" id="kasbank_tun" class="select" >
           			<?php
                	$query=$db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb = '1'");
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
	
    <label class="control-label col-lg-2 form-group ">Transfer</label>
	<div class="col-lg-3">
      <div class="input-group">
          <input type="text" class="form-control" name="transfer" id="transfer" value="0" autocomplete="off" onkeyup="hit2()">
      </div>
  </div>
   <div class="col-lg-6" id="tra" style="display:none">
           <select name="kasbank_tra" id="kasbank_tra" class="select">
           			<?php
                	$query=$db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]'  and kb = '2'");
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
	
    <label class="control-label col-lg-2 form-group ">List BG</label>
	<div class="col-lg-3">
      <div class="input-group">
           <select name="list" id="list" class="select-search" onchange="ubah(this.value,<?=$_GET['cus']?>)">
					  <option value="">-------- NO BG -------</option>
           			<?php
                	$query=$db->select("tx_buku_bg a inner join m_customer b on a.id_cus = b.id_cus","a.*,b.nama_usaha","a.status != 2");
					foreach($query as $sel){	
					?>
					  <option value="<?=$sel['id_buku']?>" <?php if($_GET['id_buku'] == $sel['id_buku']) { echo "selected";} ?>>
					  <?=$sel['nilai_bg'].' - '.$sel['id_bank'].' - ' .$sel['tgl_bg'].' - ' .$sel['nama_usaha']?>
					  </option>
					  <?php 
						}
						?>
           </select>       
      </div>
  </div>
   <div class="col-lg-6" ></div>
</div>

<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">BG</label>
	<div class="col-lg-3">
      <div class="input-group">
      				<?php
                 	$dat=$db->select("tx_buku_bg","*","id_buku = $_GET[id_buku]");
					foreach($dat as $data){}

					?>
		 <input type="hidden"  name="id_buku" id="id_buku" value="<?=$_GET['id_buku']?>" autocomplete="off" />
          <input type="text" class="form-control" name="pbg" id="pbg" value="<?=$data['nilai_bg'] ? $data['nilai_bg'] : 0?>" autocomplete="off"  onkeyup="hit3()">
       
      </div>
  </div>
   <div class="col-lg-6" id="bg" style="display:none">
           <select name="kasbank_bg" id="kasbank_bg" class="select">
           			<?php
                	$query=$db->select("ak_kasbank","*","cabang='$_SESSION[ID_CABANG]' and kb = '3'");
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



 <input type="hidden"  name="sisa" id="sisa" value="<?=$t2?>" autocomplete="off" />

 <div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Seri BG</label>
	<div class="col-lg-3">
      <div class="input-group">
	        <input type="text" class="form-control" name="no_bg" id="no_bg"  autocomplete="off" value = "<?=$data['no_seribg']?>" >      
      </div>
  </div> 
 
	
    <label class="control-label col-lg-2 form-group ">Tanggal BG</label>
	<div class="col-lg-3">
      <div class="input-group">
        <input type="text" class="form-control datepicker" name="tempo_bg" id="tempo_bg"  autocomplete="off" value = "<?=$data['jatuh_tempo']?>" />
      </div>
  </div> 
 </div>  
  
<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Bayar</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
          <input type="hidden" class="form-control" name="jumrow" id="jumrow" value="<?=$no?>" />
          <input type="hidden" class="form-control" name="cus" id="cus" value="<?=$_GET['cus']?>" />
          <input type="hidden" name="supp2" id="supp2" value="4"    required>
     
         </div>
  </div>
</div>


<div class="form-group">
	<label class="control-label col-lg-2 form-group "></label>
	
</div>

<div class="form-group">
		<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>																			 
 	<div class="col-lg-5">
		<button class="btn btn-primary" type="button" onClick="save()" name="simpan" value="simpan">
		 Simpan 
        </button>
        <!--<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan 
        </button>-->
        
        
         <button class="btn btn-success" type="button" onClick="batal()">
		 Batal 
         </button>
         <span class="col-lg-4">
         
    </span>  	</div> 
</div>