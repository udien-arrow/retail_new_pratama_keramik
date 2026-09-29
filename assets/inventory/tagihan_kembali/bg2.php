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
c.nama_usaha,(select count(*) from tx_buku_tagihan_dtl where no=b.no and id_cus=b.id_cus)as jumcus","b.no='$_GET[id]' and b.status='1' order by id_cus,tempo_tambahan asc");
        $no=1;
		$nom=1;
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
		
		
		if($cus!=$d['id_cus']){
		$aa=$nom;	
		$nom=1;
        }
		
		?>
    <tr>
          <td align="center"><?php echo $no?>&nbsp;</td>
          <td align="center"><?=$d['nama_usaha']?>&nbsp;</td>
          <td align="center">&nbsp;<?php echo $d['no_spj']?>&nbsp;<input type="hidden" name="no_spj[]" id="no_spj<?=$d['id_dtl']?>"  value="<?=$d['no_spj']?>" required></td>
          <td align="center"><?=$d['no_fj']?>&nbsp;<input type="hidden" name="no_fj[<?=$no?>]" id="no_fj<?=$d['id_dtl']?>"  value="<?=$d['no_fj']?>" required></td>
          <td align="center"><?=number_format($sis=$d['total_piutang']-$a-$g)?>&nbsp;<input type="hidden" name="totalpiutang[<?=$no?>]" id="totalpiutang<?=$d['id_dtl']?>"  value="<?=$d['total_piutang']-$a-$g?>"  placeholder='piutang' required><br></td>
          <td align="right">
           <?php 
		   $selisih = ((abs(strtotime ($d['tempo_tambahan']) - strtotime ($d['tgl_spj'])))/(60*60*24));
			 echo $selisih.' H';?>
          </td>
          <td align="right"><input type="" name="nilaipiutang[<?=$no?>]" id="nilaipiutang_<?=$d['id_cus'].'_'.$nom?>"  value="<?=$sis?>" class="dibayar2"  placeholder='' size="10" required onKeyUp="ccc('<?=$d['id_cus']?>','<?=$d['nom']?>')">
            <input type="hidden" name="nilaipiutang2[<?=$no?>]" id="nilaipiutang2_<?=$d['id_cus'].'_'.$nom?>"  value="<?=$sis?>" class="dibayar2" placeholder='' size="10" required>
<input type="hidden" name="cek[<?=$no?>]" id="cek_<?=$d['id_cus']?>"  value="<?=$d['jumcus']?>"size="3" >
          </td>
          <input type="hidden" name="tempo_normal[<?=$no?>]" id="tempo_normal<?=$d['id_dtl']?>"  value="<?=$d['tempo_normal']?>" required>
          <input type="hidden" name="tempo_tambahan[<?=$no?>]" id="tempo_tambahan<?=$d['id_dtl']?>"  value="<?=$d['tempo_tambahan']?>" required>
          <input type="hidden" name="id_cus[]" id="id_cus<?=$d['id_dtl']?>"  value="<?=$d['id_cus']?>" required>
          <input type="hidden" name="dtl[]" id="dtl<?=$d['id_dtl']?>"  value="<?=$d['id_dtl']?>" required>
        <?php $dd=$d['total_piutang']-$a ?>
          <td align="center">
			<?php //if($d['total_piutang']-$a-$g<>0){ ?><input type="checkbox" class="control-primary" name="app[<?=$no?>]" id="app_<?=$d['id_cus'].'_'.$nom?>" value="<?=$d['id_dtl'].'_'.$dd?>" onClick="aaa('<?=$d['id_cus']?>','<?=$nom?>')"> 
            <?php //}else { } ?>
            </td>
     </tr>
        <?php 
		$no++;
		$nom++;
		$cus=$d['id_cus'];
		
		} 
		?>
      
</table><br>

<?php if($_GET['jenisb']==2){?>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;No Seri BG</label>
                              <div>
                           	    <div class="input-group col-lg-4">
                                 <input typpe="text" class="form-control" name="no_seribg">
                                  <input type="hidden" name="jumrow" id="jumrow"  value="<?=$no?>">
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
                               <input typpe="text" class="form-control"  name="nama_bank" id="nama_bank<?=$d['id_dtl']?>">
                    <!-- <select name="nama_bank" id="nama_bank<?=$d['id_dtl']?>" class="select-search">
                          <option value="">--- Nama Bank ---</option>
                         	  <?php	 
                              /**$gudang=$db->select("ak_acc","account,description","lr=2");
                              foreach($gudang as $val){
                              ?>
                              <option value="<?=$val['account']?>"> <?=$val['description']?></option> 
                             <?php } **/?>
                        </select>-->
                                  </div>
                               </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-3">&nbsp;&nbsp;&nbsp;Dibayar</label>
                      <div>
                   	    <div class="input-group col-lg-4">
                                 <input typpe="text" class="form-control dibayar2"  name="dibayar" id="dibayar" onkeyup="bbb()">
                                 <input type="hidden"  id="dibayar2">
                                  <input type="hidden" id="cusi"  value="">
                       	  <input type="hidden" id="jumsi"  value="">
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
