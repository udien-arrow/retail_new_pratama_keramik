<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Masuk</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
         </div>
         <input type="hidden" class="form-control" name="kepala" id="kepala" value="<?=$_GET['id']?>">
     </div>
</div>
<div class="form-group">
  <div class="col-lg-4">
    <input type="hidden" class="form-control" name="aksi" id="aksi" value="">
    <input type="hidden" class="form-control" name="jenis_in" id="jenis_in" value="<?=$d[jenis]?>">
    <input type="hidden" class="form-control" name="id2" id="id2" value="">
    <input type="hidden" class="form-control" name="links" id="links" value="<?=$_GET['id']?>">
    <input type="hidden" class="form-control" name="discg" id="discg" value="<?=$discg?>">
    <input type="hidden" class="form-control" name="param" id="param" value="transit">
  </div>
  <div class="col-lg-4">
       
  </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Keterangan</label>
	 <div class="col-lg-6">
           <textarea rows="2" class="form-control" name="kets" id="kets"></textarea>
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
        
        
         <button class="btn btn-success" type="button" onClick="batal()">
		 Batal 
         </button>
  	</div> 
 </div>  
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td align="center" width="37%"><strong>Nama Barang</strong></td>
          <td width="30%"align="center"><strong>Qty Retur</strong></td>
          <td width="30%"align="center"><strong>Qty Claim</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$idgud=explode("_",$_GET['id']);
										  
$kon=$db->select("ex_claim_pab_tmp a
JOIN m_barang_gudang b ON a.id_barang = b.id_barang
AND a.id_gudang = b.id_gudang","a.id_tmp,
a.id_barang,
a.sat,
a.qty_retur,
a.id_user,
a.hpp,
a.qty_claim,
a.id_gudang,
a.total,
a.id_sup,
b.kode_barang,
b.nama_barang","id_user='$_SESSION[ID_LOGIN]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="center"><?=$d['qty_retur']?>&nbsp;</td>
          <td align="center"><?=$d['qty_claim']?>&nbsp;</td>
          <td align="center">
          <ul class='icons-list'>
			<li class='text-primary-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $d['id_tmp'];?>)' class='icon-subtract' style='cursor:pointer'></a></li>
			</ul>
          </td>
     </tr>
        <?php $no++;
		} 
		?>
      
</table>	



        
