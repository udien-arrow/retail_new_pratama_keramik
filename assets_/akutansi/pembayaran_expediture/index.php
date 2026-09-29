		<div class="col-lg-2"></div>
		
    </div>
        
<div class="col-lg-2"></div> 
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List Transaksi <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    
					<form class="form-horizontal" action="index.php?x=pembex_ss" name="formku2" id="formku2" method="post" onSubmit="return(validate_frm())">
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
										
											$query=$db->select("ex_order_tagihan a join m_supplier b on a.id_supp=b.id_supp","*", "a.status=1");
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
                               <th width="10%">No Expediture</th>
                               <th width="10%">Jumlah</th>
                               <th width="10%">Jumlah Retur</th>
                               <th width="10%">Jumlah</th>
                               <th width="10%">Sudah Dibayar</th>
                               <th width="10%">Kurang</th>
                               <th width="10%">Dibayar</th>
                            </tr>
                            <?php
							$ex=explode("_",$_GET['pt']);
							$cek=$db->select("ex_order_tagihan_dtl","*","no_pt='$ex[0]'");
							$no=1;
							$hut['bayarn']=0;
							foreach($cek as $val){
							$tot+=$val['total_ao'];
							$ret+=$val['retur'];
							$all+=$val['total'];
							$hit=$db->select("ex_pembayaran_ex","*,sum(dibayar) as bayarn","no_expediture='$val[no_expediture]' and no_tagihan='$ex[0]'");
							foreach($hit as $hut){}
						 ?>
                            <tr>
                              <th width="5%"><?php echo $no; ?></th>
                              <th width="15%"><?php  echo $val['no_expediture']; ?>
                              <input type="hidden" style="text-align:right;" class="form-control" name="no_ex[]" id="no_ex" value="<?=$val['no_expediture']?>" />
                              </th>
                              <input type="hidden" name="no_spj[]" value="<?=$val['no_spj']?>"></th>
                              <th style="text-align:right"><?php  echo number_format($val['total_ao']); ?></th>
                              <th style="text-align:right"><?php  echo number_format($val['retur']); ?></th>
                              <th style="text-align:right"><?php echo number_format($val['total']);?>
                              <th style="text-align:right"><?php echo number_format(round($hut['bayarn']));?>
                              <th style="text-align:right"><?php echo number_format(round($val['total'])-$hut['bayarn']);?>
                              <input type="hidden" style="text-align:right;" class="form-control" name="totalk[]" id="totalk" value="<?=round($val['total'])?>" />
                              <input type="hidden" style="text-align:right;" class="form-control" name="kurang[]" id="kurang" value="<?=round($val['total'])-$hut['bayarn']?>" />
                              </th>
                              <th style="text-align:right">
                             <?php if($val['total']-$hut['bayarn']=="0"){
								$s="readonly"; 
							 }else{$s="";}?>
                              <input type="text" style="text-align:right;" class="form-control" name="dibayar[]" id="dibayar"value="<?php echo number_format(round($val['total'])-$hut['bayarn']);?>" <?=$s?>/>
                             
                              </th>
                            </tr>
                      <?php
						$no++;	}
					?>    
                        </thead>
                        <tr>
						    <td class="td" colspan="2" align="center"><b>TOTAL</b></td>
                            <th  style="text-align:right"><?php echo number_format($tot); ?>
                            <input type="hidden" name="total" id="total"  value="<?=$tot?>"></th>
                            <th  style="text-align:right">
							<?php echo number_format($ret); ?><input type="hidden" name="total_ret" id="total_ret"  value="<?=$ret?>"></th>
                            <th  style="text-align:right"><?php echo number_format($all); ?>
                            <input type="hidden" name="total_all" id="total_all"  value="<?=$all?>">
                            </th>                            
                        </tr>
                    </table>
                         <input type="hidden" name="nopt" id="nopt"  value="<?=$_GET['pt']?>"  required>
                    <br />
                        <?php 
						$bay=$db->select("ex_pembayaran_ex","sum(dibayar) as dibayar","no_tagihan='$ex[0]'");
						foreach($bay as $ar){}
						$jadi=$all-$ar['dibayar'];
						?>
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
                                  		<input type="text" class="form-control datepicker" name="tgl_invo" id="tgl_invo" value="<?php if($val['tgl_berlaku']==''){
								  			echo date("d-m-Y");
								 			}else{
											echo $val['tgl_berlaku'];  
								  			}?>">
                                  	</div>
                        		</div>
						</div>
                        <?php
						$k=explode("_",$_GET['pt']);
						 ?>
                        <input type="hidden" value="<?=$k[0]?>" name="links">
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
									<label class="control-label col-lg-3">Jenis Transaksi</label>
						<div class="col-lg-5">
                                    <select name="aruskas" class="select-search" required>
                                    <option value="">Pilih Jenis transaksi</option>
                                    <?php
										foreach($db->select("ak_paruskas","*") as $k){
											echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
										}
									?>
                                    </select>
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
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pembex'">
										 Batal 
                                        </button>
									</div>
						</div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>

 

