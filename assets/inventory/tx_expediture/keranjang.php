<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tgl</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>">
         </div>
     </div>
</div>
<div class="form-group">
<label class="control-label col-lg-2 form-group ">Tujuan</label>
	<div class="col-lg-4">
         <div class="input-group">
         <?php 
		 $idgud=explode("_",$_GET['id']);
										  
$kon=$db->select("ex_expediture_tmp a
JOIN m_barang_gudang b ON a.id_barang = b.id_barang and a.id_gudang=b.id_gudang
JOIN ex_tarif_oa c on a.id_tarifoa=c.id
JOIN ex_lokasi_kirim d on c.id_lokasi=d.id","a.*,
b.kode_barang,
b.nama_barang,d.lokasi_kirim","a.id_user='$_SESSION[ID_LOGIN]'");
foreach($kon as $f){}
		 ?>
          <input type="text" class="form-control" name="tujuaanya" id="tujuaanya" value="<?=$f['lokasi_kirim']?>" readonly>
         </div>
     </div>
</div>
<div class="form-group">
<label class="control-label col-lg-2 form-group ">NOPOL</label>
	<div class="col-lg-4">
         <div class="input-group">
         <?php 
		 $idgud=explode("_",$_GET['id']);
										  
$c=$db->select("ex_expediture_tmp a
JOIN m_kendaraan b ON a.id_kendaraan = b.id
","a.*,b.nopol","id_user='$_SESSION[ID_LOGIN]'");
foreach($c as $f){}
		 ?>
          <input type="text" class="form-control" name="tujuaanya" id="tujuaanya" value="<?=$f['nopol']?>" readonly>
         </div>
     </div>
</div>
<div class="form-group">
  <div class="col-lg-4">
    <input type="hidden" class="form-control" name="aksi" id="aksi" value="">
    <input type="hidden" class="form-control" name="jenis_in" id="jenis_in" value="<?=$d[jenis]?>">
    <input type="hidden" class="form-control" name="id2" id="id2" value="">
    <input type="hidden" class="form-control" name="links" id="links" value="<?=$_GET['id']?>">
    <input type="hidden" class="form-control" name="nos" id="nos" value="<?=$_GET['so']?>">
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
          <td width="10%"align="center"><strong>Qty</strong>
          <td width="10%"align="center"><strong>Berat</strong></td>
          <td width="4%" align="center"><strong>#</strong></td>
    </tr>
        <?php
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['kode_barang']." - ".ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
          <td align="center"><?=$d['qty_do']?>&nbsp;</td>
          <td align="center"><?=$d['berat']?>&nbsp;</td>
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



        
