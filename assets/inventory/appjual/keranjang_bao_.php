<div class="panel-body">      				
  <div class="form-group">
  <label class="control-label col-lg-3">Jenis Pengambilan</label>
    <div class="col-lg-4">
    <select name="ambil" id="ambil" onChange="hit()" style="height:27px;" class="select">
        <option value="">-pilih Jenis-</option>
        <option value="1">Porklif</option>
        <option value="2">TKBM</option>
        <option value="3">POK</option>
      </select>
     </div>
  </div>
  <div class="form-group">
              <?php
              $kon=$db->select("tx_sales_biaya_dtl b left join m_customer c on b.id_cus=c.id_cus","b.*,c.nama_usaha,c.kode_cus","b.id_cabang='$_SESSION[ID_CABANG]' and b.no_sb='$_GET[id]' order by b.biaya_retri asc");	
			  $nom=1;
              foreach($kon as $konval){
              $tot=0;
              ?>
              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="7"align="left"><b>&nbsp;<?php echo ucfirst(strtoupper($konval['no_so'].' - '.$konval['kode_cus'].' - '.$konval['nama_usaha']));?></b></td>
                  </tr>
                  <tr>
                        <td width="4%"align="center"><strong>No</strong></td>
                        <td width="37%" align="center"><strong>Nama Barang</strong></td>
                        <td width="6%"align="center"><strong>#</strong></td>
                        <td width="4%" align="center"><strong>Qty</strong></td>
                        <td width="9%" align="center"><strong>Harga</strong></td>
                        <td width="15%" align="center"><strong>Jumlah</strong></td>
                        <td width="15%" align="center">&nbsp;</td>
                  </tr>
                  <?php
                      $kon=$db->select("tx_sales_order_dtl a 
					  join m_barang b on a.id_barang=b.id_barang
					  join m_satuan c on c.id_satuan=a.id_satuan
					  ","c.nama_satuan,a.id_barang,b.kode_barang,b.nama_barang,a.qty,a.harga","a.no_sales='$konval[no_so]'");
                      $no=1;
                      foreach($kon as $d){  
                      ?>
                  <tr>
                        <td align="center"><?php echo $no?>&nbsp;</td>
                        <td>&nbsp;<?php echo ucfirst(strtolower($d['nama_barang']));?>&nbsp;</td>
                        <td align="left">&nbsp;<?=$d['nama_satuan']?></td>
                        <td align="right"><?=$d['qty']?>&nbsp;</td>
                        <td align="right"><?=number_format($d['harga'],2)?>&nbsp;</td>
                        <td align="right"><?php
                        echo number_format($sub=$d['harga']*$d['qty'],2);
                        ?>&nbsp;</td>
                        <td align="right"><input type="text"  size="10" name="biam[]" id="biam_<?=$konval[id_cus].'_'.$no?>" value="0"><input type="hidden"  size="10" name="bar[]" id="bar_<?=$konval[id_cus].'_'.$no?>" value="<?=$d['id_barang']?>"><input type="hidden"  size="10" name="qty[]" id="qty_<?=$konval[id_cus].'_'.$no?>" value="<?=$d['qty']?>">
                        <input type="hidden"  size="10" name="berat[]" id="berat_<?=$konval[id_cus].'_'.$no?>" value=""><input type="hidden"  size="10" name="so[]" value="<?=$konval['no_so']?>"></td>
                 </tr>
                      <?php $no++;
                      $tot=$tot+$sub;
                      } ?>
                    
                    <tr>
                        <td colspan="5" align="right"><b> Total</b>&nbsp;</td>
                        <td align="right"><b><?php echo number_format($tot,2)?></b>&nbsp;</td>
                       
                        <td align="right"><b>
                          <input type="hidden"  size="2" name="nomer" id="nomer_<?=$konval[id_cus]?>"  value="<?=$no?>">
                        <input type="hidden"  size="2" name="supp" id="custo_<?=$nom?>"  value="<?=$konval[id_cus]?>">
                        &nbsp;</b></td>
                </tr>
                      
              </table>	
              <?php
               $nom++;
               }
               ?>
                <input type="hidden"  size="2" name="jumlah_cus" id="jumlah_cus" value="<?=$nom?>">
  </div>
              <?php if($konval['biaya_retri']!=''){?>
              <hr>
              <div class="form-group">
                <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="4"align="left"><b>&nbsp;Detil Biaya</b></td>
                  </tr>
                  <tr>
                        <td width="9%"align="center"><strong>No</strong></td>
                        <td width="80%" colspan="2" align="center"><strong>Nama Biaya</strong></td>
                        <td width="15%" align="center"><strong>Jumlah</strong></td>
                  </tr>
                  <tr>
                    <td align="center">1</td>
                    <td colspan="2">&nbsp;Biaya Retribusi</td>
                    <td align="right"><?=number_format($konval['biaya_retri'])?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td colspan="2">&nbsp;Biaya Switch</td>
                    <td align="right"><?=number_format($konval['biaya_switch'])?>&nbsp;</td>
                  </tr>
                  <tr>
                        <td align="center">3</td>
                        <td colspan="2">&nbsp;Gaji Supir</td>
                        <td align="right"><?=number_format($konval['gaji_supir'])?>&nbsp;</td>
                </tr>
                    <tr>
                      <td align="center">4</td>
                      <td colspan="2">&nbsp;UJS</td>
                      <td align="right"><?=number_format($konval['ujs'])?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right"><b> Total</b>&nbsp;</td>
                       
                        <td align="right"><b><?php echo number_format($konval['biaya_retri']+$konval['gaji_supir']+$konval['biaya_switch']+$konval['ujs'])?>&nbsp;                        </b></td>
                </tr>
                </table>	
              </div>
              <?php }?>
                                
  <input type="hidden" name="stain" id="stain"  value="<?=$dtv['level']-1?>"  required>
  <input type="hidden"  size="2" name="no_sb" id="no_sb" value="<?=$_GET['id']?>">
  <input type="hidden"  size="2" name="jenis" id="jenis" value="">

</div>
</div>