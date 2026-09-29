<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
          <td width="1%"align="center"><strong>No</strong></td>
          <td width="10%"align="center"><strong>Pelanggan</strong></td>
          <td width="10%" align="center"><strong>NO SPJ</strong></td>
          <td width="10%"align="center"><strong>NO FJ</strong></td>
          <td width="10%"align="center"><strong>Piutang</strong></td>
          <td width="4%" align="center"><strong>Umur</strong></td>
          <td width="4%" align="center"><strong>Nilai</strong></td>
          <td width="4%" align="center"><strong> <!--<input type="checkbox" name="select-all" id="select-all" />-->
		</strong></td>
    </tr>
        <?php								  
$kon=$db->select("tx_buku_tagihan_dtl b left join m_customer c on b.id_cus=c.id_cus ","b.*,
c.nama_usaha","b.no='$_GET[id]' and b.status='1' order by id_cus,tempo_tambahan asc");
        $no=1;
        foreach($kon as $d){
		$a=0;
		$s=$db->select("tx_tagihan_kembali_tmp","sum(dibayar) as dibayar","no_fj='$d[no_fj]'");
		foreach($s as $v){
		$a=$v['dibayar'];
		}
		$dtl=$db->select("tx_tagihan_kembali_dtl a join tx_tagihan_kembali b on a.no_ta=b.no_ta","dibayar","a.no_fj='$d[no_fj]' and b.no_ref='$d[no]'");
		foreach($dtl as $s){
		$g=$s['dibayar'];
		}
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td align="center"><?=$d['nama_usaha']?>&nbsp;</td>
          <td align="center">&nbsp;<?php echo $d['no_spj']?>&nbsp;<input type="hidden" name="no_spj[]" id="no_spj<?=$d['id_dtl']?>"  value="<?=$d['no_spj']?>" required></td>
          <td align="center"><?=$d['no_fj']?>&nbsp;<input type="hidden" name="no_fj[]" id="no_fj<?=$d['id_dtl']?>"  value="<?=$d['no_fj']?>" required></td>
          <td align="center"><?=number_format($sis=$d['total_piutang']-$a-$g)?>&nbsp;<input type="hidden" name="totalpiutang[]" id="totalpiutang<?=$d['id_dtl']?>"  value="<?=$d['total_piutang']-$a-$g?>"  placeholder='piutang' required><br></td>
          <td align="right">
           <?php 
		   $selisih = ((abs(strtotime ($d['tempo_tambahan']) - strtotime ($d['tgl_spj'])))/(60*60*24));
			 echo $selisih.' H';?>
          </td>
          <td align="right"><input type="" name="nilaipiutang<?=$d['id_dtl']?>" id="nilaipiutang<?=$d['id_dtl']?>"  value="<?=$sis?>" class="dibayar" placeholder='' size="10" required></td>
          <input type="hidden" name="tempo_normal[]" id="tempo_normal<?=$d['id_dtl']?>"  value="<?=$d['tempo_normal']?>" required>
          <input type="hidden" name="tempo_tambahan[]" id="tempo_tambahan<?=$d['id_dtl']?>"  value="<?=$d['tempo_tambahan']?>" required>
          <input type="hidden" name="id_cus[]" id="id_cus<?=$d['id_dtl']?>"  value="<?=$d['id_cus']?>" required>
          <input type="hidden" name="dtl[]" id="dtl<?=$d['id_dtl']?>"  value="<?=$d['id_dtl']?>" required>
        <?php $dd=$d['total_piutang']-$a ?>
          <td align="center">
			<?php if($d['total_piutang']-$a-$g<>0){ ?><input type="checkbox" class="control-primary" name="app[]" id="app[]" value="<?=$d['id_dtl'].'_'.$dd?>"> 
            <?php }else { } ?>
            </td>
     </tr>
        <?php $no++;
		} 
		?>
      
</table><br>

<?php if($_GET['jenisb']==2){?>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;No Seri BG</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                 <input typpe="text" class="form-control" name="no_seribg">
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Jatuh Tempo</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                 <input typpe="text" class="form-control datepicker" name="jatuh_tempo">
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Nama Bank</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                 <select name="nama_bank" id="nama_bank<?=$d['id_dtl']?>" class="select-search">
                                      <option value="">--- Nama Bank ---</option>
                                      <option value="1">Mandiri</option>
                                      <option value="2">BRI</option> 
                                    </select>
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Dibayar</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                 <input typpe="text" class="form-control dibayar" name="dibayar">
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;</label>
                              <div>
                              	  <div class="input-group col-lg-4">
                                <button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
		 Simpan 
        </button>
                                  </div>
                               </div>
                    </div>
                    <?php } ?>
