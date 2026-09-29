<div class="form-group">a
    <label class="control-label col-lg-2 form-group ">Tgl Koreksi</label>
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
	<label class="control-label col-lg-2 form-group ">No FJ</label>
	 <div class="col-lg-6">
           <input type="text" class="form-control" name="fj" id="fj" value="<?=$as[0]?>" readonly>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group ">No SPJ</label>
	 <div class="col-lg-6">
           <input type="text" class="form-control" name="spj" id="spj" value="<?=$as[1]?>" readonly>
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
          <td width="20%"align="center"><strong>Harga Sebelumnya</strong></td>
          <td width="20%"align="center"><strong>Diganti Harga</strong></td>
          <td width="30%"align="center"><strong>Keterangan</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
$idgud=explode("_",$_GET['id']);
$gud=$db->select("pj_penjualan","*","no_penjualan='$idgud[1]'");	
foreach($gud as $gd){}								  
$kon=$db->select("tx_koreksi_piutang_tmp a
JOIN m_barang_gudang b ON a.id_barang = b.id_barang
AND b.id_gudang = $gd[id_gudang]","a.id_tmp,
a.id_barang,
a.qty,
a.id_user,
a.harga_awal,
a.ket,
a.harga_ganti,
b.nama_barang,
b.kode_barang","id_user='$_SESSION[ID_LOGIN]'");

/*
echo "select a.id_tmp,
a.id_barang,
a.qty,
a.id_user,
a.harga_awal,
a.ket,
a.harga_ganti,
b.nama_barang,
b.kode_barang","id_user='$_SESSION[ID_LOGIN]' from tx_koreksi_piutang_tmp a
JOIN m_barang_gudang b ON a.id_barang = b.id_barang
AND b.id_gudang = $gd[id_gudang] where id_user='$_SESSION[ID_LOGIN]'";
*/
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="center"><?=$d['harga_awal']?>&nbsp;</td>
          <td align="center"><?=$d['harga_ganti']?>&nbsp;</td>
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



        
