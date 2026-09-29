    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #DDD ;
				padding:0px;
			}
	</style>
    <div class="col-lg-6">
		<form action="index.php?x=billing_sss" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Faktur & View Billing</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="Input Billing" onClick="window.location='index.php?x=billing'"></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="panel-body">
                    
                    <div class="form-group">
                    	<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;No Faktur</label>
                              <div class="col-lg-10">
                              	  <div class="input-group">
                              	  <div class="col-lg-6">
                                  <input type="text" class="form-control"  name="nofak" id="nofak" value="">
                                  </div>
                                   <div class="col-lg-3">
                                  <input type="submit" class="btn btn-info" value="Simpan" name="sim" id="sim" style="cursor:pointer">
                                  
                                  </div>
                                  
                              	  </div>
                               </div> 
                    </div>
                   <div class="form-group"><br><br>
					
					<table width="100%" border="1" cellpadding="0" cellspacing="0">
					  <tr>
					    <td align="center"><strong>No</strong></td>
					    <td align="center"><strong>No Billing</strong></td>
					    <td align="center"><strong>Tgl </strong></td>
					    <td align="center"><strong>Total Billing</strong></td>
				      </tr>
					  <?php
										  
					  $kon=$db->select("tx_billing","*","jenis=1 and (no_faktur='' or no_faktur is null)");	  
					  $no=1;
					  foreach($kon as $d){  
					  ?>
					  <tr>
					    <td align="center"><input type="checkbox" <?php if($valcek[id_barang]!=''){echo "checked";}?> name="no_billing[<?=$no?>]" id="nobil<?=$no?>" value="<?=$d['no_billing']?>">					      &nbsp;</td>
					    <td>&nbsp;<?php echo $d['no_billing'];?></td>
					    <td align="left">&nbsp;<?php echo $d['tgl'];?></td>
					    <td align="left">&nbsp;<?=number_format($d['total_bil'])?></td>
				      </tr>
                      
                      <tr>
					    <td align="center">&nbsp;</td>
					    <td colspan="3">
                        	<table width="100%">
                            	<tr>
                                	<td>&nbsp;No Spj</td>
                                    <td>&nbsp;Nama Barang</td>
                                    <td>&nbsp;Qty</td>
                                    <td>&nbsp;Harga</td>
                                    <td>&nbsp;Total</td>
                                </tr>
                                <?php
								$jum=0;
                      $kon2=$db->select("tx_billing_dtl a left join m_barang b on a.id_barang=b.id_barang","a.*,b.nama_barang","a.no_billing='$d[no_billing]'");	 
					  foreach($kon2 as $d2){  
					  ?>
                                <tr>
                                	<td>&nbsp;<?=$d2['no_spj']?></td>
                                    <td>&nbsp;<?=$d2['nama_barang']?></td>
                                    <td>&nbsp;<?=$d2['qty']?></td>
                                    <td align="right"><?=number_format($d2['harga'],2)?>&nbsp;</td>
                                    <td align="right"><?=number_format($d2['total'],2)?>&nbsp;</td>
                                </tr>
                                 <?php 
								 $jum=$jum+$d2['total'];
					  				} 
									?>
                                <tr>
                                  <td colspan="4">&nbsp;Total</td>
                                  <td align="right"><?php echo number_format($jum,2)?>&nbsp;</td>
                                </tr>
                        	</table>
                        </td>
				      </tr>
					  <?php 
					  
					  $no++;} ?>
                       
		    </table>
            </div>
		</div>
        </div>
			</form>
		</div>
         <form class="form-horizontal" action="index.php?x=order" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View Detil Rilis SO</h5>
					</div>
                    
                    <div class="dataTables_wrapper"></div>
                    
                  	<?php
                   
				   
						/*$kon=$db->select("tx_billing_dtl a 
										  left join m_barang b on a.id_barang=b.id_barang
										  left join m_satuan c on a.id_satuan=c.id_satuan
										  left join tx_brg_masuk d on a.no_so=d.no_ref and a.no_spj=d.surat_jalan","a.*,b.nama_barang,c.nama_satuan,d.no_masuk as nomas,d.tgl","a.no_billing='$_GET[id]'");				*/
					?>
				  <div class="panel-body">
                  <div class="form-group">
                    	<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                             
                    </div>
                   <div class="form-group">
                   				
                                <div class="form-group">
                                  <table width="100%" border="1" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td align="center"><strong>No</strong></td>
                                      <td align="center"><strong>No Billing</strong></td>
                                      <td align="center"><strong>Tgl </strong></td>
                                      <td align="center"><strong>Total Billing</strong></td>
                                    </tr>
                                    <?php
										  
					  $kon=$db->select("tx_billing","*","jenis=1  and (no_faktur='' or no_faktur is null)");	  
					  $no=1;
					  foreach($kon as $d){  
					  ?>
                                    <tr>
                                      <td align="center"><?=$no?>
                                      </td>
                                      <td>&nbsp;<?php echo $d['no_billing'];?></td>
                                      <td align="left">&nbsp;<?php echo $d['tgl'];?></td>
                                      <td align="left">&nbsp;
                                        <?=number_format($d['total_bil'])?></td>
                                    </tr>
                                    <tr>
                                      <td align="center">&nbsp;</td>
                                      <td colspan="3"><table width="100%">
                                        <tr>
                                          <td>&nbsp;No Spj</td>
                                          <td>&nbsp;Nama Barang</td>
                                          <td>&nbsp;Qty</td>
                                          <td>&nbsp;Harga</td>
                                          <td>&nbsp;Total</td>
                                        </tr>
                                        <?php
								$jum=0;
                      $kon2=$db->select("tx_billing_dtl a 
					  left join tx_rilis_dtl c on a.no_spj=c.no_spj
					  left join tx_so_dtl d on c.no_so=d.sales_order and c.line_item=d.line
					  left join m_barang b on d.id_barang=b.id_barang
					  ","b.nama_barang,d.price as harga,c.qty_do as qty","a.no_billing='$d[no_billing]'");	 
					  foreach($kon2 as $d2){  
					  ?>
                                        <tr>
                                          <td>&nbsp;
                                            <?=$d2['no_spj']?></td>
                                          <td>&nbsp;
                                            <?=$d2['nama_barang']?></td>
                                          <td>&nbsp;
                                            <?=$d2['qty']?></td>
                                          <td align="right"><?=number_format($d2['harga'],2)?>
                                            &nbsp;</td>
                                          <td align="right"><?=number_format($tot=$d2['harga']*$d2['qty'],2)?>
                                            &nbsp;</td>
                                        </tr>
                                        <?php 
								 $jum=$jum+$tot;
					  				} 
									?>
                                        <tr>
                                          <td colspan="4">&nbsp;Total</td>
                                          <td align="right"><?php echo number_format($jum,2)?>&nbsp;</td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                    <?php 
					  
					  $no++;} ?>
                                  </table>
                                </div>
                                  
					
				  </div>	
                    
				</div>					
		</div>
</form>
