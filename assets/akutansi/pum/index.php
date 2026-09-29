<div class="col-lg-2"></div>
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Form  
					    <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    
					<div class="panel-body">
                   <?php
					if($_POST[id]!=''){
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","IDX='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=pum_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
							<div class="form-group">
							  <label class="control-label col-lg-4">Keperluan UM</label>
									<div class="col-lg-4">
                                    <input type="text" name="keperluan" id="korek" class="form-control" /> 
                                  </div>
                      			</div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Jumlah (Rp.)</label>
									<div class="col-lg-4">
                                    <input type="text" name="jml" id="jml" class="form-control harga"required/>
                                    <input type="hidden" name="curr" id="curr" class="form-control" value="kredit"/>
						</div>
                       <!--             <label class="control-label col-lg-1">Posisi</label>
                        <div class="col-lg-2">
                                    <select class="select" name="curr" id="curr" onChange="">
                                    	
                                        <option value="kredit">Kredit</option>
                                        
                                    </select>
				     	</div>-->
                      </div>
                               
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
								  <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" >
										 Tambah transaksi 
                                        </button>
                                   
                                      
 
                                    <p>&nbsp;</p>
								  </div>
								</div>     
					</form>
                    </div>
                    </div>
  </div>
</div>
                   <div class="col-lg-2"></div>
<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List  
					    <?=$title?></h5>
					</div>
<div class="dataTables_wrapper"></div>
                    
					<div class="panel-body">
					<form class="form-horizontal" action="index.php?x=pum_ss" name="form2" id="form2" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                     
                    
               <table id="example4" class="table datatable table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                     
                            <tr>
                               <th width="20%">No</th>
                               <th width="50%">Keterangan</th>
                              <th width="15%">Jumlah</th>
                              <th width="10%">Aksi</th>
                            </tr>
                               <?php
					//if($_POST[id]!=''){
                    $sat=$db->select("ak_pum_tmp","*","USER='$_SESSION[ID_LOGIN]'");
					$no=0;
					foreach($sat as $val){
						$no++;
						
					//}
					?>
                            <tr>
                              <th><?php echo $no; ?></th>
                              <th><?php  echo $val ['KEPERLUAN']; ?></th>
                              <th style="text-align:right"><?php echo number_format($val ['JUMLAH']);?></th>
                              <th><ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $val['ID']?>)' style='cursor:pointer' class='icon-trash'></a></li>
			</ul></th>
                            </tr>
                      <?php 
					  	$tot+=$val['JUMLAH'];
					  }?>      
                        </thead>
                        
						  <tr>
						    <td class="td" colspan="2" align="center"><b>TOTAL</b></td>
                            <th style="text-align:right"><?php echo number_format($tot); ?><input name="tot" type="hidden" id="tot" value="<?php echo $tot;?>">
                            </th>
                            <td class="td" align="center">&nbsp;</td>
						   
						   
					      </tr>
                    </table>
                    </fieldset>
                     <input type="hidden" name="aksi" id="aksi"  value=""  required>
                     <input type="hidden" name="id" id="id"  value=""  required>                     
                     <p>&nbsp;</p>
                     <p>&nbsp;</p>
                     <div class="form-group">
                            <label class="control-label col-lg-4">Jenis Uang Muka</label>
                            <div class="col-lg-7">
                              <select name="jum" class="select-search" required>
	                              <option value="">Pilih Jenis Uang Muka</option>
                                  <?php
								
									 $ak=$db->select("ak_jenisum a JOIN ak_acc b ON a.account = b.account","a.id_jenisum, a.account, a.jenis_um","a.st='1'");
								  	foreach($ak as $jum){
									  echo"<option value=\"$jum[id_jenisum]\">$jum[account] - $jum[jenis_um]</option>";
									  }
									  echo"</optgroup>";
									
									
								/*for($i=1;$i<=2;$i++){
									  if($i==1){
										echo"<optgroup label=\"Dinas Operasional\">";	  
									  } else {
										  echo"<optgroup label=\"SPPD\">";		  
										  }
								  $ak=$db->select("ak_jenisum","*","st='1' AND jum='$i'");
								  	foreach($ak as $jum){
									  echo"<option value=\"$jum[id_jenisum]\">$jum[jenis_um]</option>";
									  }
									  echo"</optgroup>";
									}	
									*/
								  ?>
                              </select>
                            </div>
           			  </div>
                     <div class="form-group">
									<label class="control-label col-lg-4">Catatan</label>
									<div class="col-lg-4">
                                    	<input type="text" name="cat" id="cat" class="form-control" value="" autocomplete="off" required/>
								  	</div>
					</div>                
                    
                     <div class="form-group">
									<label class="control-label col-lg-4"></label>
								  <div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                   <button class="btn btn-success" type="button" onClick="window.location='index.php?x=jurum'">
										 Batal 
                                    </button>
                                      
 
                                    <p>&nbsp;</p>
					   </div>
					  </div>
				  </form>
		</div>