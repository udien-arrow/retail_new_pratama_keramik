<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl Retur</label>
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
  </div>
  <div class="col-lg-4">
       
  </div>
</div>
<?php
$as=explode("_",$_GET['id']);
?>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">No SPJ</label>
	 <div class="col-lg-6">
           <input type="text" class="form-control" name="spj" id="spj" value="<?=$as[0]?>" readonly>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">No SO</label>
	 <div class="col-lg-6">
           <input type="text" class="form-control" name="so" id="so" value="<?=$as[1]?>" readonly>
    </div>
</div>
<?php 
$asd=$db->select("tx_do a left join m_customer b on a.id_cus_shipto=b.id_cus","*","a.no_spj='$as[0]'");
foreach($asd as $dsa){}
?>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Customer</label>
	 <div class="col-lg-6">
           <input type="text" class="form-control" name="so" id="so" value="<?=$dsa['nama_usaha']?>" readonly>
           <input type="hidden" class="form-control" name="cusa" id="cusa" value="<?=$dsa['id_cus']?>" readonly>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">Jenis</label>
	 <div class="col-lg-6">
           <select name="jeniskem" id="jeniskem" class="select">
           	<option value="1">Baik</option>
            <option value="2">Reject</option>
           </select>
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
          <td align="center" width="50%"><strong>Nama Barang</strong></td>
          <td width="20%"align="center"><strong>Qty Kembali</strong></td>
          <td width="30%"align="center"><strong>Keterangan</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$idgud=explode("_",$_GET['id']);
										  
$kon=$db->select("tx_retur_pen_tmp a
JOIN m_barang_gudang b ON a.id_barang = b.id_barang
AND a.id_gudang = b.id_gudang","a.id_tmp,
a.id_barang,
a.sat,
a.qty_terima,
a.id_user,
a.hpp,
a.qty_kembali,
a.ket,
a.id_gudang,
a.harga_jual,
a.id_cus,
b.kode_barang,
b.nama_barang","id_user='$_SESSION[ID_LOGIN]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="center"><?=$d['qty_kembali']?>&nbsp;</td>
          <td align="center"><?=$d['ket']?>&nbsp;</td>
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



        
