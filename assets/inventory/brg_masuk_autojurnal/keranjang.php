<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="37%"><strong>Nama Barang</strong></td>
          <td width="6%"align="center"><strong>#</strong></td>
          <td width="4%" align="center"><strong>Qty</strong></td>
          <td width="4%" align="center"><strong>Claim Utuh</strong></td>
          <td width="4%" align="center"><strong>Claim Ktg</strong> </td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$kon=$db->select("tx_brg_masuk_tmp a 
		join m_barang b on a.id_barang=b.id_barang 
		join m_satuan c on b.id_satuan=c.id_satuan","a.*,b.kode_barang,b.nama_barang,c.nama_satuan","a.id_user='$_SESSION[ID_LOGIN]' and a.id_gudang='$_SESSION[ID_GUDANG]' and jenis='$_GET[jenis]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="left">&nbsp;
          <?=$d['nama_satuan']?></td>
          <td align="right"><?=$d['qty_terima']?>&nbsp;</td>
          <td align="right"><?=$d['claim_utuh']?>&nbsp;</td>
          <td align="right"><?=$d['claim_ktg']?>&nbsp;</td>
          <td align="center">
          <ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $d['id_tmp'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul>
          </td>
     </tr>
        <?php $no++;
		$tot=$tot+($d['qty_terima']*$d['harga_beli']);
		$discg=$d['disc_global'];
		$ppn=$d['ppn'];
		} 
		
		
		if($ppn=='y'){
			$nppn=$tot/10;
			$tot=$tot+$nppn;
		}else{
			$tot=$tot;
		}
		?>
      
</table>	
<br>

<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Masuk</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
          
         </div>
     </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-2 form-group ">Surat Jalan</label>
  <div class="col-lg-4">
    <input type="text" class="form-control" name="surat_jalan" id="surat_jalan" value="<?php if($d[jenis]==2 || $d[jenis]==3 || $d[jenis]==5){echo $d[no_prp];}?>"> 
    <input type="hidden" class="form-control" name="aksi" id="aksi" value="">
    <input type="hidden" class="form-control" name="jenis_in" id="jenis_in" value="<?=$_GET[jenis]?>">
    <input type="hidden" class="form-control" name="id_in" id="id_in" value="<?php if($_GET[spb]!=''){echo $_GET[spb];}elseif($_GET[spj]!=''){echo $_GET[spj];}elseif($_GET[spm]!=''){echo $_GET[spm];}?>">
    <input type="hidden" class="form-control" name="id2" id="id2" value="">
    <input type="hidden" class="form-control" name="total" id="total" value="<?=$tot?>">
    <input type="hidden" class="form-control" name="discg" id="discg" value="<?=$discg?>">
  </div>
  <div class="col-lg-4">
       
  </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Keterangan</label>
	 <div class="col-lg-6">
           <textarea rows="2" class="form-control" name="ket" id="ket"></textarea>
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

        
