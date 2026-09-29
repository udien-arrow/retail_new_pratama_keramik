<div class="form-group">
  <label class="control-label col-lg-2">Pengirimann</label>
				<div class="col-lg-5">
                <select class="select-search" name="nopol" id="nopol" required >
                  <option value="">--nopol--</option>
                  <?php
                      $query=$db->select("m_kendaraan a join m_jenis_kendaraan b on a.id_jenis=b.id_jenis","a.nopol,b.nama","a.id_cabang='$_SESSION[ID_CABANG]'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['nopol']?>" <?php if($sel['nopol']==$_GET['nopol']){echo "selected";}?>><?=$sel['nopol'].' - '.$sel['nama']?></option>
                  <?php } ?>
              </select>
              </div>
    <div class="col-lg-3">
                <select class="select-search" name="supirr" id="supirr"   required>
                  <option value="">--Supir--</option>
                  <?php
                      $query=$db->select("m_pegawai","*","id_jabatan='8' and id_cabang='$_SESSION[ID_CABANG]'");
                      foreach($query as $sel){	
                  ?>
                  <option value="<?=$sel['id_pegawai']?>" <?php if($sel['id_pegawai']==$_GET['supi']){echo "selected";}?>>
                    <?=$sel['nama_pegawai']?>
                  </option>
                  <?php } ?>
              </select>
              </div>
              <div class="col-lg-2">
    <button class="btn btn-success" type="button" onClick="ref('<?=$_SERVER['REQUEST_URI']?>',nopol.value,supirr.value)">
		 go 
         </button>
         </div>
</div>             				

<div class="form-group">
</div>     								
                                 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#E1E1E1">
                                      <tr>
                                        <td colspan="4" align="left"><b>&nbsp;Biaya Retribusi</b></td>
                                      </tr>
                                     
                                      <tr>
                                       <td width="60%" align="center"><strong>Nama Retribusi</strong></td>
                                       <td width="10%" align="center"><strong>Nilai</strong></td>
                                      </tr>
                                     	<tbody >
                                        <?php  
	    $kon=$db->select("m_retribusi","*");
  		$expl=explode("_",$_GET['id']);
		$no=1;
		$skr=date("Y-m-d");
		foreach($kon as $d){  
		foreach($db->select("m_kendaraan","id_jenis","nopol='$_GET[nopol]'") as $kol2);
		
		foreach($db->select("m_biaya_retribusi_supp a left join m_biaya_retribusi_supp_dtl b on a.id_biaya=b.id_biaya","b.nilai","b.tgl_berlaku<='$skr' and b.id_retribusi='$d[id_retribusi]' and a.id_cus='$sup' and a.id_jenis='$kol2[id_jenis]' and a.id_gudang='$_SESSION[ID_GUDANG]' order by b.tgl_berlaku desc limit 0,1") as $kol);
		?>
		<tr>
		<td width="60%" align="left">&nbsp;<?php
			echo $d['nama_retribusi'];
		?></td>
        <td width="10%" align="right">&nbsp;<?php 
		if($no>1){
			
			?>
        <input type="text" name="nilai[<?=$no?>]" readonly size="10" value="<?php echo number_format($kolni=$kol[nilai]);?>" style="text-align:right"><input type="hidden" name="idret[<?=$no?>]" size="10" value="<?=$d['id_retribusi']?>">
        <?php 
			$tota=$tota+$kol[nilai];
		}else{
			echo $kolawal=$kol[nilai];
				if($kolawal>=120){
					$nilaiin=20000;
				}else{
					$nilaiin=0;
				}
			}?></td>
		</tr>
		<?php
		$no++;
		} 
		?>
		<tr>
		  <td align="right" colspan="1">Total Biaya Retribusi&nbsp;</td>
		  <td align="right"><b><?=number_format($tota)?></b>&nbsp;<input type="hidden" value="<?=$tota?>" name="jumlah_retri" id="jumlah_retri"></td>
		</tr>
        <tr>
		  <td align="right" colspan="1">Total BBM&nbsp;</td>
		  <td align="right">
          <?php 
		    foreach($db->select("m_bbm a left join m_bbm_dtl b on a.id_bbm=b.id_bbm","b.harga","b.tgl_berlaku<='$skr' and a.id_cabang='$_SESSION[ID_CABANG]' order by b.tgl_berlaku desc limit 0,1") as $bbm);
			
			foreach($db->select("m_kendaraan","id_jenis,km","nopol='$_GET[nopol]'") as $kend2);
			
			
			echo '<b>'.number_format($ujs=(($kolawal*1/$kend2['km'])*$bbm['harga']));
		  ?><input type="hidden" value="<?=$ujs?>" name="ujs" id="ujs" class="hargab"></td>
		</tr>
        <tr>
		  <td align="right" colspan="1">Biaya Lain&nbsp;</td>
		  <td align="right">
          <input type="text" value="0" name="bl" id="bl" style="text-align:right" onKeyUp="nil(bl.value)"  size="10" autocomplete="off"></td>
		</tr>
        <!-- <tr>
		  <td align="right" colspan="1">Keterangan&nbsp;</td>
		  <td align="right">
          <input type="text" value="" name="keterangan" id="keterangan"></td>
		</tr>-->
        <tr>
		  <td align="right" colspan="1"><b>Total Uang Jalan Supir</b>&nbsp;</td>
		  <td align="right"><input type="text" value="<?=number_format($totujs=$tota+$ujs)?>" size="10" style="text-align:right" class="hargab" name="totujs" id="totujs"></td>
		</tr>
        
        <tr>
		  <td align="right" colspan="1"><b>Total Gaji Supir</b>&nbsp;</td>
		  <td align="right"><input type="text" class="hargab" value="<?=$totsupir?>"  size="10" style="text-align:right" name="gajisup" id="gajisup" readonly></td>
		</tr>
        
		 <tr>
		  <td align="right" ><b>Insentif Jarak</b>&nbsp;</td>
		  <td align="right">&nbsp;<input type="text" name="insentifjarak" class="hargab" size="10" value="<?=$nilaiin?>" style="text-align:right" readonly></td>
		</tr>
        <tr>
		  <td align="right" ><b>Total </b>&nbsp;</td>
		  <td align="right">&nbsp;<input type="text" name="totalbiayakir" id="totalbiayakir" class="hargab" size="10" value="<?=number_format($totujs+$totsupir+$nilaiin)?>" style="text-align:right" readonly>
	      <input type="hidden" value="<?=$totujs+$totsupir+$nilaiin?>" id="totalbiayakir2" size="10"></td>
		</tr>

                                        </tbody>
                                    </table>
<div class="form-group">
</div>      
