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
          <td width="5%"align="center"><strong>No</strong></td>
          <td align="center" width="21%"><strong>Nama Pegawai</strong></td>
          <td width="18%"align="center"><strong>Tgl</strong></td>
          <td width="20%"align="center"><strong>Jenis</strong></td>
          <td width="26%" align="center"><strong>Keterangan</strong></td>
          <td width="10%" align="center"><strong>#</strong></td>
    </tr>
        <?php
		$idgud=explode("_",$_GET['id']);
										  
$kon=$db->select("hr_ijin_tmp a 
join m_pegawai b on a.id_pegawai=b.id_pegawai
join hr_jenis_absen c on a.jenis=c.kode
","a.*,b.nama_pegawai,c.nama_jenis","id_user='$_SESSION[ID_LOGIN]'");
        $no=1;
        foreach($kon as $d){  
		?>
    <tr>
          <td align="left"><?php echo $no?>&nbsp;</td>
          <td>&nbsp;<?php echo $d['nama_pegawai'];?>&nbsp;</td>
          <td align="left"><?=$d['date']?>&nbsp;</td>
          <td align="left"><?=$d['nama_jenis']?>&nbsp;</td>
          <td align="left"><?=$d['ket']?></td>
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
<input type="hidden" name="id2" id="id2" value="">
      <input type="hidden" name="aksi" id="aksi" value="">	



        
<input type="hidden" name="idp" id="idp" value="<?=$_GET[id]?>">
