<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td align="left" colspan="6"><strong>&nbsp;Valuta 
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
          <td width="6%"align="center"><strong>Tgl Kirim</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_prp_tmp a join m_barang b on a.id_barang=b.id_barang join m_satuan c on a.sat=c.id_satuan left join m_daerah d on a.id_daerah=d.id_daerah","a.*,b.kode_barang,b.nama_barang,c.nama_satuan,d.nama_daerah,d.kode_daerah","a.id_user='$_SESSION[ID_LOGIN]' and a.id_supp='$valtmp[id_supp]'");
        $no=1;
		$tot=0;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left"><?=$d['tgl_kirim']?></td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty']?>&nbsp;</td>
          <td align="center">
          <ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $d['id_tmp'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul>
          </td>
     </tr>
        <?php $no++;
			$tot=$tot+$sub;
			$kode_daerah=$d['kode_daerah'];
			$id_daerah=$d['id_daerah'];
			$nama_daerah=$d['nama_daerah'];
			$shipto_code=$d['shipto_code'];
			$nospb=$d['no_order'];
			$jenkir=$d['jenis_kirim'];
		} ?>
</table>	
<br>

<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Pembayaran</label>
	 <div class="col-lg-4">
           <select name="jenis_pemb" id="jenis_pemb<?=$valtmp['id_supp']?>" class="select">
              			 <option value="1" <?php if($valtmp['jenis_pemb']==1){?> selected<?php }?>>Tunai</option>
                        
                        <option value="2" <?php if($valtmp['jenis_pemb']==2){?>selected<?php }?>>Kredit</option>
                       
			</select>
       <span class="col-lg-2">
           <input type="hidden" name="id_supp" id="id_supp" class="form-control" autocomplete="off"  required value="<?=$valtmp['id_supp']?>">
           <input type="hidden" name="ppn" id="ppn<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"  required value="<?=$ppn?>">
           <input type="hidden" name="id_valuta" id="id_valuta<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"  required value="<?=$kursval['id_valuta']?>">
           <input type="hidden" name="kurs" id="kurs<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off"   value="<?=$kursval['kurs']?>">
           <input type="hidden" name="spb22" id="spb22" class="form-control" autocomplete="off"  required value="<?=$_GET['spb']?>">
    </span><span class="input-group">
    <input type="hidden" name="grant2" id="grant2<?=$valtmp['id_supp']?>" class="form-control" autocomplete="off" value="<?=$grant
		  ?>"   placeholder="Rupiah">
    </span></div>
    <label class="control-label col-lg-2 form-group ">Duedate PO</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="duedate" id="duedate<?=$valtmp['id_supp']?>" value="<?php echo date('d-m-Y', strtotime('+30 days'));?>">
           </div>
     </div>
</div>

<?php 
$exp=explode("/",$nospb);
if($exp[3]!=''){?>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">District</label>
 	<div class="col-lg-4">
   		<input type="hidden" class="form-control" name="id_daerah" id="id_daerah<?=$valtmp['id_supp']?>" value="<?php echo $id_daerah?>">
        <input type="text" class="form-control" name="nama_daerah" id="nama_daerah<?=$valtmp['id_supp']?>" value="<?php echo $kode_daerah.' - '.$nama_daerah?>" readonly>
    </div>
    <label class="control-label col-lg-2 form-group ">Shipto</label>
	<div class="col-lg-4">
         <div class="input-group">
          
          <input type="text" class="form-control" name="shipto_code" id="shipto_code<?=$valtmp['id_supp']?>" value="<?php echo $shipto_code?>" readonly>
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
	<label class="control-label col-lg-2 form-group ">Jenis Kirim</label>
	 <div class="col-lg-4">
	   <select name="jenkir" id="jenkir<?=$valtmp['id_supp']?>" class="select">
	     <option value="">---Jenis Kirim---</option>
	     <option value="FRC" <?php if($jenkir=='FRC'){echo "selected";}?>>Franco</option>
	     <option value="LCO" <?php if($jenkir=='LCO'){echo "selected";}?>>Locco</option>
       </select>
	 </div>
</div>     
<?php }else{?>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">District</label>
  <div class="col-lg-4">
   		<select name="daerah" id="daerah<?=$valtmp['id_supp']?>" class="select-search" onChange="caridata(daerah.value,'<?=$valtmp['id_supp']?>')">
   		  <option value="">-pilih district-</option>
   		  <?php
										$query=$db->select("m_daerah","id_daerah,nama_daerah,id_gudang","id_cabang='$_SESSION[ID_CABANG]'");
										foreach($query as $sel){	
			                            ?>
   		  <option value="<?=$sel['id_daerah'].'_'.$sel['id_gudang']?>">
   		    <?=$sel['nama_daerah']?>
	      </option>
   		  <?php }?>
    </select>
 	</div>
    <label class="control-label col-lg-2 form-group ">Shipto</label>
	<div class="col-lg-4">
          
          <select name="shipto_code" id="shipto_code<?=$valtmp['id_supp']?>" class="select">
                                    <option value="">-pilih shipto-</option>
                                      
                                    </select>
          
     </div>
     <input type="hidden" class="form-control" name="id_daerah" id="id_daerah<?=$valtmp['id_supp']?>" value="">
     <input type="hidden" class="form-control" name="gudang" id="gudang<?=$valtmp['id_supp']?>" value="">
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
	<label class="control-label col-lg-2 form-group ">Jenis Kirim</label>
	 <div class="col-lg-4">
	   <select name="jenkir" id="jenkir" class="select">
	     <option value="">---Jenis Kirim---</option>
	     <option value="FRC">Franco</option>
	     <option value="LCO">Locco</option>
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

<?php }?>
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
