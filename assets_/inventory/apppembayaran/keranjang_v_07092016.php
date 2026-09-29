<table width="100%" border="1" cellpadding="0" cellspacing="0" class="tables">
                                <tr>
                                <td align="center" class="tables" width="5%"><strong>No</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Pelangan</strong></td>
                                <td align="center" class="tables" width="15%"><strong>NO FJ</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Total</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Dibayar</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Jenis </strong></td>
                                <td align="center" class="tables" width="10%"><strong>Jenis BG</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Nama Bank</strong></td>
                                <td align="center" class="tables" width="10%"><strong>Jatuh Tempo</strong></td>
                                <td align="center" class="tables" width="10%"><strong>No Seri BG</strong></td>
                                <td align="center" class="tables" width="10%"><strong>No Rekening</strong></td>
                                <td align="center" class="tables" width="5%"><strong>Kredit Note</strong></td>
                                <td align="center" class="tables" width="5%"><strong>Kompensasi</strong></td>
                                <td align="center" class="tables" width="5%"><b>Account</b></td>
                                <td align="center" class="tables" width="5%"><input type="checkbox" name="select-all" id="select-all" /></td>
                                </tr>
                                <?php 
								$supp=$db->select("tx_tagihan_kembali_dtl a left join m_customer b on a.id_cus=b.id_cus","a.*,b.nama_usaha","a.no_ta='$_GET[id]' and a.id_cus='$_GET[cus]'");
							  $no=1;
							  foreach($supp as $valsupp){
								?>
                                <?php 
								if($valsupp['status']==0){
		 						   foreach($db->select("tx_buku_bg","no_ta,no_spj","no_spj='$valsupp[no_spj]' and status='0' and no_ta!='$_GET[id]'")as $vl);
									if($vl['no_ta']!=''){
								?>
                                <tr>
                                  <td colspan="2" align="center" class="tables">BG Sebelumnya</td>
                                  <td colspan="13" align="center" class="tables">
                                  		<?php include("bukubg.php");?>
                                  </td>
                                </tr>
								<?php 
										$bg=$vl['no_ta'].'*'.$vl['no_spj'];
									}else{
										$bg='';
									}
								}
								?>
                                <tr>
                                <td align="center" class="tables"><?=$no?></td>
                                <td align="center" class="tables"><?=$valsupp['nama_usaha']?></td>
                                <td align="center" class="tables"><?=$valsupp['no_fj']?></td>
                                <td align="right" class="tables"><?=number_format($valsupp['total_piutang'])?></td>
                                <td align="right" class="tables"><?=number_format($valsupp['dibayar'])?></td>
                                <td align="center" class="tables"><?php 
								if($valsupp['jenis_pem']==1){
									$i='oke';
									echo "Tunai";
								}elseif($valsupp['jenis_pem']==2){
									$i='oke';
									echo "Transfer";
								}elseif($valsupp['jenis_pem']==3){
									if($valsupp['jenis_bg']==''){
										$i='gak';		
									}else{
										$i='oke';	
									}
									echo "BG";
								}elseif($valsupp['jenis_pem']==4){
									echo "Kembali Utuh"; 
									$i='oke';
								}elseif($valsupp['jenis_pem']==5){
									echo "Deposit"; 
									$i='oke';	
								}
									?></td>
                                <td align="center" class="tables"><?php 
								if($valsupp['jenis_pem']==3){
								if($valsupp['jenis_bg']==1){
									echo "Cair";	
								}
								if($valsupp['jenis_bg']==2){
									echo "Blonk";	
								}
							  }
									?></td>
                                <td align="center" class="tables"><?php
								$nmb['description']='';
                                foreach($db->select("ak_acc","description","account='$valsupp[nama_bank]'")as $nmb);
								echo $nmb['description'];
								?></td>
                                <td align="center" class="tables">
								<?php if($valsupp['jatuh_tempo']=="0000-00-00"){
									echo "";
								}else{ echo $valsupp['jatuh_tempo'];}?></td>
                                <td align="center" class="tables"><?=$valsupp['no_seribg']?>
                                <td align="center" class="tables"><?=$valsupp['no_rekening']?></td>
                                <td align="left" class="tables">
                                <?php
									
								
									$c=$db->select("tx_piutang","no_faktur_jual,no_koreksi,total_piutang,no_faktur_jual","type=1 and status_bayar=0 and id_cus='$valsupp[id_cus]'");
									$jum=count($c);
									foreach($c as $fr){
									}
									if($jum>0 && $valsupp['status']==0){
										?>
											<select name="kndn[<?=$no?>]" id="kndn[]">
                                            	<option value="">-Pilih-</option>
                                                <?php foreach($c as $dt){
												   	$tot=$valsupp['total_piutang']-$valsupp['dibayar'];
													
													if($tot>=abs($dt['total_piutang'])){
												?>
                                                <option value="<?=$dt['no_faktur_jual'].'_'.$dt['no_koreksi']?>"><?=$dt['no_koreksi'].'_'.$dt['total_piutang']?></option>
                                                <?php 
													}
												}?>
                                            </select><br>
										<?php 
									}
								?>
                                </td>
                                <td  align="center" class="tables" ><input type="text" name="kompensasi[<?=$no?>]" class="harga" size="7" value="0">
                                <!-- <select name="via[<?=$no?>]" style="height:26px">
                                	<option value="0">Cabang</option>
                                    <option value="1">Pusat</option>
                                </select>-->
                                </td>
                                <td  align="center" class="tables" >
                                <?php if(($valsupp['jenis_pem']<=2 && $valsupp['jenis_bg']=='' && $valsupp['status']==0) || ($valsupp['jenis_pem']==3 && $valsupp['jenis_bg']==1 && $valsupp['status']==0) || ($valsupp['jenis_pem']==5 && $valsupp['jenis_bg']=='' && $valsupp['status']==0)){?>
                              	<select name="pemb[<?=$no?>]" id="pemb" class="select-search col-lg-12">
                                  <?php 
								  if($valsupp['jenis_pem']==1){
								  	$cc=$db->select("ak_kasbank","account,description","kb=1 and cabang='$_SESSION[ID_CABANG]'");
								  }elseif($valsupp['jenis_pem']==2){
									$cc=$db->select("ak_acc","account,description","account='$valsupp[nama_bank]'");  
								  }elseif($valsupp['jenis_pem']==3){
									$cc=$db->select("ak_kasbank","account,description");  
								  }elseif($valsupp['jenis_pem']==5){
									$cc=$db->select("ak_parameterjur a join ak_acc b on a.acc_code=b.account","a.acc_code as account,b.description","id_m_parameterjur='24'");  	
								  }
								  foreach($cc as $dtt){
									?>
                                  <option value="<?=$dtt['account']?>"><?=$dtt['description']?></option>
                                  <?php 
									}
									?>
                                </select>
                                
                                <?php }?>
                                </td>
                                <td align="center" class="tables">
                                <?php 
								if($valsupp['status']==0){
									//if($valsupp['jenis_pem']<3 || ($valsupp['jenis_pem']==3 && $valsupp['jenis_bg']!='')){
									?>
                                <input type="checkbox" class="control-primary" name="app[<?=$no?>]" id="app[]" value="<?=$valsupp['no_fj']."_".$valsupp['urut']."_".$i."_".$bg?>">
                                <?php //}
								}
								?>
                                </td>
                                </tr>
                                <?php
								
								$no++; } ?>
                                
                                </table>
      
