<div class="panel-body">      				
  <div class="form-group">
              <?php
              $kon=$db->select("tx_sales_biaya_dtl b left join m_customer c on b.id_cus=c.id_cus","b.*,c.nama_usaha,c.kode_cus","b.no_sb='$_GET[id]' order by b.biaya_retri asc");	
			  $nom=1;
              foreach($kon as $konval){
              $tot=0;
              ?>
              <table width="100%" border="1" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="6"align="left"><b>&nbsp;<?php echo ucfirst(strtoupper($konval['no_so'].' - '.$konval['kode_cus'].' - '.$konval['nama_usaha']));?></b></td>
                  </tr>
                  <tr>
                        <td width="4%"align="center"><strong>No</strong></td>
                        <td width="37%" align="center"><strong>Nama Barang</strong></td>
                        <td width="6%"align="center"><strong>#</strong></td>
                        <td width="4%" align="center"><strong>Qty</strong></td>
                        <td width="9%" align="center"><strong>Harga</strong></td>
                        <td width="15%" align="center"><strong>Jumlah</strong></td>
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
                        <td align="right"><input type="hidden"  size="10" name="so[]" value="<?=$konval['no_so']?>">
                        <?php
                        echo number_format($sub=$d['harga']*$d['qty'],2);
                        ?>&nbsp;</td>
                 </tr>
                      <?php $no++;
                      $tot=$tot+$sub;
                      } ?>
                    
                    <tr>
                        <td colspan="5" align="right"><b> Total</b>&nbsp;</td>
                        <td align="right"><b>
                          <input type="hidden"  size="2" name="supp" id="custo_<?=$nom?>"  value="<?=$konval[id_cus]?>">
                          <input type="hidden"  size="2" name="nomer" id="nomer_<?=$konval[id_cus]?>"  value="<?=$no?>">
                        <?php echo number_format($tot,2)?></b>&nbsp;</td>
                </tr> 
              </table>	
              <?php
               $nom++;
               }
               ?>
                <input type="hidden"  size="2" name="jumlah_cus" id="jumlah_cus" value="<?=$nom?>">
  </div>
              <?php 
				 foreach($jum=$db->select("tx_sales_biaya","*","no_sb='$_GET[id]'")as $vsb);
				 if($konval['biaya_retri']!=''){
				 ?>
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
                  <?php if($vsb['jenis_jual']=='FRC'){
                 
					$ak=$db->select("tx_sales_biaya_r_dtl a join m_retribusi b on a.id_retribusi=b.id_retribusi","a.*,b.nama_retribusi","a.no_sb='$_GET[id]'");
					$no=1;
					foreach($ak as $dta){  
					
				  ?>
                  <tr>
                    <td align="center"><?=$no?></td>
                    <td colspan="2">&nbsp;<?=$dta['nama_retribusi'];?></td>
                    <td align="right"><?=number_format($dta['nilai']);?>&nbsp;</td>
                  </tr>
                  <?php 
				  $no++;
				  }?>
                  <tr>
                    <td align="center"><?=$no+1?></td>
                    <td colspan="2">&nbsp;Biaya Retribusi</td>
                    <td align="right"><?=number_format($vsb['biaya_retri'])?>&nbsp;</td>
                  </tr>
                 <tr>
                      <td align="center"><?=$no+2?></td>
                      <td colspan="2">&nbsp;Total BBM</td>
                      <td align="right"><?=number_format($vsb['biaya_ujs'])?>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><?=$no+3?></td>
                      <td colspan="2">&nbsp;Biaya Lain2</td>
                      <td align="right"><?=number_format($vsb['biaya_lain'])?>&nbsp;</td>
                    </tr>
                 
                	<tr>
                        <td colspan="3" align="right"><b> Total UJS</b>&nbsp;</td>
                       
                        <td align="right"><b><?php echo number_format($totujs=$vsb['biaya_retri']+$vsb['biaya_ujs']+$vsb['biaya_lain'])?>&nbsp;                        </b></td>
               		 </tr>
                      <tr>
                        <td colspan="3" align="right">&nbsp;<b>Total Gaji Supir</b></td>
                        <td align="right"><?php
						foreach($db->select("tx_sales_biaya_supir a join tx_sales_biaya_dtl b on a.no_so=b.no_so","sum(ifnull(a.biaya_supir,0)+ifnull(a.insentif_jarak,0))as ij","b.no_sb='$_GET[id]' group by b.no_sb")as $bsv);
						echo number_format($totgasup=$bsv['bs']+$bsv['ij'])?>&nbsp;</td>
               		</tr>
                    <tr>
                        <td colspan="3" align="right"><b>Total Bongkar Toko</b>&nbsp;</td>
                        <td align="right"><b><?php
						foreach($db->select("tx_tkbm_bongkartoko","sum(biaya_bongkar)as bt","no_sb='$_GET[id]' group by no_sb")as $bt);
						echo number_format($botok=$bt['bt'])?>&nbsp;</b></td>
                </tr>
                    <?php }?>
                   <?php if($vsb['jenis_jual']=='SWC'){?>
                      <tr>
                    <td align="center">1</td>
                    <td colspan="2">&nbsp;Biaya Switch</td>
                    <td align="right"><?=number_format($vsb['biaya_switch'])?>&nbsp;</td>
                  </tr>
                   <?php }?>
                   <?php if($vsb['jenis_jual']=='LCO'){?>
                     <tr>
                      <td align="center">1</td>
                      <td colspan="2">&nbsp;Biaya Sewa Locco</td>
                      <td align="right"><?=number_format($vsb['biaya_sewa_lco'])?>&nbsp;</td>
                    </tr>
                     <?php }?>
                </table>	
              </div>
               <div class="form-group">
              <?php }?>
   <select name="pemb" id="pemb" class="select-search col-lg-12">
				  <?php 
                  $cc=$db->select("ak_parameterjur a join ak_acc b on a.acc_code=b.account","a.acc_code,b.description","a.id_m_parameterjur='21'");
                foreach($cc as $dtt){
                  ?>
                <option value="<?=$dtt['acc_code']?>"><?=$dtt['description']?></option>
                <?php 
                  }
                  ?>
              </select>
              </div>                             
  <input type="hidden" name="stain" id="stain"  value="<?=$dtv['level']-1?>"  required>
  <input type="hidden"  size="2" name="no_sb" id="no_sb" value="<?=$_GET['id']?>">
  <input type="hidden" name="id" id="id"  value="<?=$_GET['id']?>"  required>
  <input type="hidden"  size="2" name="jenis" id="jenis" value="">
  <input type="hidden"  size="2" name="id_cabang" id="id_cabang" value="<?=$vsb['id_cabang']?>">
   <input type="hidden"  size="2" name="id_cabang_direct" id="id_cabang_direct" value="<?=$vsb['id_cabang_direct']?>">
   <input type="hidden" name="ujs" id="ujs"  value="<?=$totujs?>"  required>
  <input type="hidden" name="gasup" id="gasup"  value="<?=$totgasup?>"  required>
  <input type="hidden" name="botok" id="botok"  value="<?=$botok?>"  required>
  <input type="hidden" name="swc" id="swc"  value="<?=$vsb['biaya_switch']?>"  required>
   <input type="hidden" name="lco" id="lco"  value="<?=$vsb['biaya_sewa_lco']?>"  required>
  <input type="hidden" name="jenisju" id="jenisju"  value="<?=$vsb['jenis_jual']?>"  required>   
      

</div>
</div>