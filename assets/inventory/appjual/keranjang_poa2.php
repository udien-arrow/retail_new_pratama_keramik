<?php  foreach($db->select("tx_sales_biaya","*","no_so='$_GET[id]'") as $nil);?>
<div class="form-group">
									<label class="control-label col-lg-4">Nama Kendaraan</label>
									
                                    <div class="col-lg-6">
									  <select class="select-search" name="jenisken" id="jenisken"  onChange="kenda('<?=$konval['id_cus']?>',jenisken.value)">
									   <?php
											$query=$db->select("m_jenis_kendaraan","*","id_jenis='$nil[id_jenis_kendaraan]'");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_jenis']?>"  <?php if($sel['id_jenis']==$val['id_jenis']){echo "selected";}?>>
									      <?=$sel['nama']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
<div class="form-group">


</div>      

								
                                 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#E1E1E1">
                                      <tr>
                                        <td colspan="4" align="left"><b>&nbsp;Biaya Retribusii</b></td>
                                      </tr>
                                     
                                      <tr>
                                       <td width="60%" align="center"><strong>Nama Retribusi</strong></td>
                                        <td width="10%" align="center"><strong>Nilai</strong></td>
                                      </tr>
                                     	<?php  
									 
									  
									  $kon=$db->select("m_retribusi","*");
                                      $no=1;
									 // $skr=date("Y-m-d");
									 $skr=date("Y-m-d")." ".date("H:i:s");
                                      foreach($kon as $d){  
									  foreach($db->select("m_biaya_retribusi a 
									  left join m_biaya_retribusi_dtl b on a.id_biaya=b.id_biaya","b.nilai","b.tgl_berlaku<='$nil[tgl]' and b.id_retribusi='$d[id_retribusi]' and a.id_cus='$konval[id_cus]' and a.id_jenis='$nil[id_jenis_kendaraan]' order by b.tgl_berlaku desc limit 0,1") as $kol);			  
									 
									  $kolni=$kol[nilai];	  
									  ?>
                                      <tr>
                                      <td width="60%" align="left">&nbsp;<?=$d['nama_retribusi']?></td>
                                      <td width="10%" align="right">&nbsp;<?=number_format($kolni)?>&nbsp;</td>
                                      </tr>
                                      <?php
									  $no++;
									  $tot=$tot+$kolni;
									   } 
									   ?>
                                        <tr>
                                        <td align="right">Total</td>
                                        <td align="right"><b><?=number_format($nil['jumlah_retribusi'])?></b>&nbsp;<input type="hidden" value="<?=$tot?>" name="jumlah_retri" id="jumlah_retri"></td>
                                      </tr>
                                    </table>
<div class="form-group">
</div>      
