<div class="form-group">
	
    <label class="control-label col-lg-2 form-group ">Tanggal</label>
	<div class="col-lg-4">
         <div class="input-group">
          <span class="input-group-addon"><i class="icon-calendar22"></i></span>
          <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date('d-m-Y');?>" readonly>
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
    <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?=$_GET['jenispem']?>">
  </div>
  <div class="col-lg-4">
       
  </div>
</div>
<div class="form-group">
	<label class="control-label col-lg-2 form-group "></label>
	
</div>

<div class="form-group">
		<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>																			 
 	<div class="col-lg-5">
		
        <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpannya" value="simpannya">
		 Simpan 
        </button>
        
        
         <button class="btn btn-success" type="button" onClick="batal()">
		 Batal 
         </button>
  	</div> 
 </div>  
<table width="900px" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="4%"align="center"><strong>No</strong></td>
          <td width="10%" align="center"><strong>Pelanggan</strong></td>
          <td width="10%"align="center"><strong>NO FJ</strong></td>
          <td width="10%"align="center"><strong>NO SPJ</strong></td>
          <td width="10%"align="center"><strong>Piutang</strong></td>
          <td width="10%"align="center"><strong>Dibayar</strong></td>
          <td width="10%"align="center"><strong>Jenis BG</strong></td>
          <td width="5%" align="center"><strong>#</strong></td>
    </tr>
        <?php								  
$kon=$db->select("tx_buku_bg_tmp a left join m_customer b on a.id_cus=b.id_cus","*","id_user='$_SESSION[ID_LOGIN]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['nama_usaha']?>&nbsp;</td>
          <td align="center"><?=$d['no_fj']?>&nbsp;</td>
          <td align="center"><?=$d['no_spj']?>&nbsp;</td>
          <td align="center"><?=number_format($d['total_piutang'])?>&nbsp;</td>
          <td align="center"><?=number_format($d['dibayar'])?>&nbsp;</td>
          <td align="center"><?php 
		  if($d['jenis_bg']==1){
		  echo "Blonk";}elseif($d['jenis_bg']==2){
		  echo "Cair";}
		  ?></td>
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



        
