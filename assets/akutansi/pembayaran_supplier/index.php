		<div class="col-lg-2"></div>		
    </div>
        
<div class="col-lg-2"></div> 
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List Transaksi <?=$title?>
                        <ul class="icons-list">
                               <li><input style="height:25px; line-height: 0; float:right" type="button" class="btn btn-info" value="View Permintaan" onClick="window.location='index.php?x=pembsupp_v'"></button></li>
							</ul>
                        </h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    
					<form class="form-horizontal" action="index.php?x=pembsupp_ss" name="formku2" id="formku2" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                     <?php
                     $exp=explode("_",$_GET['pt']);
					 ?>     
                   <div class="form-group">
									<label class="control-label col-lg-3">No Permintaan</label>
									<div class="col-lg-6">
									  <select class="select-search" name="no_pt" id="no_pt" onChange="panggil(no_pt.value)" required>
									    <option value="">--Nomor Permintaan Tagihan--</option>
									    <?php
										
											$query=$db->select("tx_order_tagihan a join m_supplier b on a.id_supp=b.id_supp","a.no_pt,a.tgl_pt,b.nama_usaha,a.id_supp", "a.status=3");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['no_pt'].'_'.$sel['tgl_pt'].'_'.$sel['id_supp']?>" <?php if($sel['no_pt']==$exp[0]){echo "selected";}?>>
									      <?=$sel['no_pt']?>
									      -
  <?=$sel['nama_usaha']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
							</div> 
                            <?php if($_GET['pt']!=''){?>
                      <div class="form-group">
									<label class="control-label col-lg-3">Tgl Permintaan Tagihan</label>
						<div class="col-lg-2">
                              	  	<div class="input-group">
                              	  		<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                               		  <input type="text" class="form-control" name="tgl_invo" id="tgl_invo" value="<?php echo $exp[1];?>" readonly>
                                  	</div>
                   		</div>
							</div> 
                            <?php }?>
                   <div class="form-group">                                
                   <table id="example4" class="table datatable table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="5%">No</th>
                               <th width="20%">No Billing</th>
                               <th width="20%">No SPJ</th>
                               <th width="20%">Jumlah Billing</th>
                               <th width="20%">Jumlah Dibayar</th>
                               <th width="20%">Kurang</th>
                            </tr>
                            <?php
					//if($_POST[id]!=''){
                    $sat=$db->select("tx_order_tagihan_dtl","*","no_pt='$exp[0]'");
					$no=1;
					foreach($sat as $val){
						
					//$hit=$db->select("tx_order_tagihan_dk","*","no_billing='$val[no_billing]' and no_spj='$val[no_spj]'");
					//foreach($hit as $tung){}	
					$wes=$val['total_bil']+$tung['debet']-$tung['kredit'];
					$ce=$db->select("tx_order_tagihan_bayar","sum(dibayar) as dibayar","no_billing='$val[no_billing]' and no_pt='$exp[0]' and status='0' and no_spj='$val[no_spj]' and id_bill_dtl='$val[id_bill_dtl]'");
					foreach($ce as $cek){}
					
					$ce1=$db->select("tx_order_tagihan_bayar","sum(dibayar+(0-selisih)) as dibayar","no_billing='$val[no_billing]' and no_pt='$exp[0]' and status='1' and no_spj='$val[no_spj]' and id_bill_dtl='$val[id_bill_dtl]'");
					foreach($ce1 as $cek1){}
						$debet=$val['DEBET'];
						$total_debet = $total_debet + $debet;		
						$ti=$wes-$cek1['dibayar'];		
					//}
					?>
                            <tr>
                              <th width="5%"><?php echo $no; ?></th>
                              <th width="15%"><?php  echo $val['no_billing']; ?>
                              <input type="hidden" name="no_billing[]" value="<?=$val['no_billing']?>"></th>
                              <th width="15%"><?php  echo $val['no_spj']; ?>
                              <input type="hidden" name="no_spj[]" value="<?=$val['no_spj']?>">
                              <input type="hidden" name="bill_dtl[]" value="<?=$val['id_bill_dtl']?>"></th>
                              <th style="text-align:right"><?php  echo number_format($ti,2); ?></th>
                              <th style="text-align:right"><?php echo number_format($cek['dibayar'],2);?></th>
                              <th style="text-align:right"><?php echo number_format($kur=$ti-$cek['dibayar'],2);?></th>
                            </tr>
                      <?php
					  $tot=$tot+$ti;
					  $bay=$bay+$cek['dibayar'];
					  
					  $no++;
					   }?>    
                        </thead>
                        <tr>
						    <td class="td" colspan="4" align="right"><b>Total</b></td>
                            <th  style="text-align:right"><?php echo number_format($tot); ?><input type="hidden" name="total" id="total"  value="<?=$tot?>">
</th>                            
                        </tr>
                        <?php 
						//$ket=$db->select("tx_order_tagihan_min","sum(dibayar)dibayar","no_pt='$exp[0]' and status='0'");
						//foreach($ket as $kat){}
						?>
                        <tr>
						    <td class="td" colspan="4" align="right"><b>Total Dibayar</b></td>
                            <th  style="text-align:right"><?php echo number_format($bay); ?><input type="hidden" name="dibayarnya" id="dibayarnya"  value="<?=$bay?>">
</th>                            
                        </tr>
                        <tr>
						    <td class="td" colspan="4" align="right"><b>Kurang</b></td>
                            <th  style="text-align:right"><?php echo number_format($tot-$bay); ?><input type="hidden" name="dikurangnya" id="dikurangnya"  value="<?=$tot-$bay?>">
</th>                            
                        </tr>
                    </table>
                         <input type="hidden" name="nopt" id="nopt"  value="<?=$_GET['pt']?>"  required>
                    <br />
                    	 <div class="form-group">
							<label class="control-label col-lg-3">Rekening kas/bank</label>
								<div class="col-lg-4">
									<select class="select-search" name="rekening" id="rekening" required>
                                 		<option value="">--Rekening kas/bank--</option>
                                         <?php
											$query=$db->select("ak_acc","*", "LR IN ('1','2')");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"><?=$sel['account']?> - <?=$sel['description']?> </option> <?php } ?>  
                                    </select>                                     
								</div>
						</div>   
                        
                         <div class="form-group">
							
                        	<label class="control-label col-lg-3">Tanggal Invoice</label>
                           		<div class="col-lg-2">
                              	  	<div class="input-group">
                              	  		<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  		<input type="text" class="form-control datepicker" name="tgl_invo1" id="tgl_invo1" value="">
                                  	</div>
                        		</div>
						</div>
                        <div class="form-group">
									<label class="control-label col-lg-3">Jenis Arus Kas</label>
						<div class="col-lg-5">
                                    <select name="aruskas" class="select-search" required>
                                    <option value="">Pilih Jenis Arus Kas</option>
                                    <?php
										foreach($db->select("ak_paruskas","*") as $k){
											echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div>
                        <div class="form-group">
                        	<label class="control-label col-lg-3">Tanggal Transaksi</label>
                            	<div class="col-lg-2">
                                	<div class="input-group">
                                    	<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" class="form-control datepicker" name="tgl_trans" id="tgl_trans" value="<?php if($val['tanngal']==''){
											echo date("d-m-Y");
											}else{
											echo $val['tanngal'];
											}?>" />
                                            
                                    </div>                                    
                                </div>
                        </div>
                        <div class="form-group">
                        	<label class="control-label col-lg-3">Catatan</label>
                            	<div class="col-lg-4">
                                <input type="text" class="form-control" name="cacat" id="cacat" value="" required />
                                </div>
                        </div>
                        <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pembsupp'">
										 Batal 
                                        </button>
									</div>
						</div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>

 

