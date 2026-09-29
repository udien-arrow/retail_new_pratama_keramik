
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td align="left" colspan="9"><strong>&nbsp;Valuta 
		  <?php 
		 $kurs=$db->select("m_valuta a 
left join m_valuta_dtl b on a.id_valuta=b.id_valuta","a.id_valuta,b.kurs,a.nama_valuta","a.id_valuta='$valtmp[id_valuta]' and b.tgl_berlaku <=CURDATE() ORDER BY b.tgl_berlaku desc limit 0,1");
		 foreach($kurs as $kursval){}
		 echo " : ".$kursval['nama_valuta'].' - '.$kursval['kurs'];
		  ?> </strong></td>
    </tr>
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="37%"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="4%" align="center"><strong>Bonus </strong></td>
          <td width="9%" align="center"><strong>Harga</strong></td>
          <td width="7%" align="center"><strong>Disc%</strong></td>
          <td width="7%" align="center"><strong>Jumlah</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_prp_tmp a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.id_user='$_SESSION[ID_LOGIN]' and a.id_supp='$valtmp[id_supp]'");
        $no=1;
		$tot=0;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="right"><?=$d['bonus']?>                                              &nbsp;</td>
          <td align="right"><?=number_format($d['harga_beli'])?>&nbsp;</td>
          <td align="right"><?=$d['disc'].'%'?>&nbsp;</td>
          <td align="right">
		  <?php
		  $habel=$d['harga_beli']*$d['disc']/100;
		  $habel=$d['harga_beli']-$habel;
		  echo number_format($sub=$habel*$d['qty']*$kursval['kurs']);
		  
		  ?>&nbsp;</td>
          <td align="center">
          <ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $d['id_tmp'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul>
          </td>
     </tr>
        <?php $no++;
		$tot=$tot+$sub;
		} ?>
      <tr>
          <td colspan="7" align="right"><b> Total</b>&nbsp;</td>
          <td align="right"><b><?php echo number_format($tot)?>&nbsp;</b></td>
          <td align="center">&nbsp;</td>
   	 </tr>
      <tr>
          <td colspan="7" align="right"><b>Ppn</b>&nbsp;</td>
          <td align="right"><b>
		  <?php 
		  
		  if($valtmp['pkp']==2){
		       $ppn=0;
		  }else{
			   $ppn=$tot/10;
	      }
		  echo number_format($ppn)
		  
		  
		  ?></b>&nbsp;</td>
          <td align="center">&nbsp;</td>
   	 </tr>
      <tr>
          <td colspan="7" align="right"><b>Grant Total</b>&nbsp;</td>
          <td align="right"><b><?php echo number_format($grant=$tot+$ppn);?></b>&nbsp;</td>
          <td align="center">&nbsp;</td>
   	 </tr>
</table>	
<br>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Disc global </label>
  <div class="col-lg-2">
		<input type="text" name="dg_persen" id="dg_persen<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"   placeholder="%" onKeyUp="hitung('<?=$valtmp['id_supp']?>')">
    <input type="hidden" name="id_supp" id="id_supp" class="form-control" autocomplete="off"  required value="<?=$valtmp['id_supp']?>">
    <input type="hidden" name="ppn" id="ppn<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"  required value="<?=$ppn?>">
    <input type="hidden" name="id_valuta" id="id_valuta<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"  required value="<?=$kursval['id_valuta']?>">
    <input type="hidden" name="kurs" id="kurs<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"   value="<?=$kursval['kurs']?>">
    <input type="hidden" name="spb22" id="spb22" class="form-control" autocomplete="off"  required value="<?=$_GET['spb']?>">
  </div>
  <div class="col-lg-2">
		<input type="text" name="dg_rupiah" id="dg_rupiah<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"    placeholder="Rupiah" onKeyUp="hitung2('<?=$valtmp['id_supp']?>')">
    </div>
    
    
    
    <label class="control-label col-lg-2 form-group ">Grant Total</label>
  <div class="col-lg-4">
         <div class="input-group">
          <input type="text" name="grant" id="grant<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off" value="<?=$grant
		  ?>"   placeholder="Rupiah">
          <input type="hidden" name="grant2" id="grant2<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off" value="<?=$grant
		  ?>"   placeholder="Rupiah">
          </div>
     </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Pembayaran</label>
	 <div class="col-lg-4">
           <select name="jenis_pemb" id="jenis_pemb<?=$valtmp['id_supp']?>" class="select">
              			<?php if($valtmp['jenis_pemb']==1){?>
                        <option value="1" selected>Tunai</option>
                        <?php }if($valtmp['jenis_pemb']==2){?>
                        <option value="2" selected>Kredit</option>
                        <?php }?>
                       
			</select>
    </div>
    <label class="control-label col-lg-2 form-group ">Duedate PO</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="duedate" id="duedate<?=$valtmp['id_supp']?>" value="<?php echo date('d-m-Y', strtotime('+30 days'));?>">
           </div>
     </div>
</div>
<?php if($valtmp['jenis_pemb']==1){?>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Rekening</label>
	 <div class="col-lg-4">
           <select name="rekening" id="rekening<?=$valtmp['id_supp']?>" class="select">
               <option value="<?=$sel['no_order']?>" <?php if($sel['no_order']==$_GET['spb']){echo "selected";}?>><?=$sel['no_order']?></option>
			</select>
     </div>
</div>
<?php }?>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Kirim Kepada</label>
	 <div class="col-lg-4">
           <select name="gudang" id="gudang<?=$valtmp['id_supp']?>" class="select" required>
			<option value="">---Gudang---</option>
			<?php
					$query=$db->select("m_gudang","id_gudang,nama_gudang");
					foreach($query as $sel){	
					$st="";
					if($_GET[jenis]==3){
						if($sel['id_gudang']==$_GET['spb']){
							$st="selected";
						}
					}else{
						if($valspb['id_gudang']==$sel['id_gudang']){
							$st="selected";
						}
					}
			?>
                    <option value="<?=$sel['id_gudang']?>" <?=$st?> ><?=$sel['nama_gudang']?></option>
                    <?php }?>    
			</select>
    </div>
    <label class="control-label col-lg-2 form-group ">Tgl PO</label>
  <div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl<?=$valtmp['id_supp']?>" value="<?php echo date("d-m-Y")?>">
           </div>
     </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Keterangan</label>
	 <div class="col-lg-6">
           <textarea rows="2" class="form-control" name="ket" id="ket<?=$valtmp['id_supp']?>"></textarea>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group "></label>
	
</div>

<div class="form-group">
		<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>																			 
 	<div class="col-lg-5">
		<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan 
        </button>
         <button class="btn btn-success" type="button" onClick="batal(<?=$valtmp['id_supp']?>)">
		 Batal 
         </button>
  	</div> 
 </div>         
