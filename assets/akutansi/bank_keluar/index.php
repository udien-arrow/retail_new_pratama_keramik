		<div class="col-lg-2"></div>
		<div class="col-lg-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">From Transaksi <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
					if($_POST[id]!=''){
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","IDX='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=bankkeluar_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
							<div class="form-group">
									<label class="control-label col-lg-4">Jenis Jurnal</label>
									<div class="col-lg-3">
										<select class="select" name="jenjur" id="jenjur" required>
                                        <option value="ba">BANK KELUAR</option>
                                        <option value="pu">Pengajuan Uang Muka</option>
                                        <option value="bag">Biaya Antar Cabang</option>
                                        <option value="bma">Biaya Maintenance Asset</option>
                                        </select>
								  	</div>
							</div>       
                            <div id="km">                         
                                <div class="form-group">
									<label class="control-label col-lg-4">Nomor Rekening</label>
									<div class="col-lg-4">
									  <input type="text" name="norek" id="korek" class="form-control" />  
                                      </div>
                      			</div>
                      <div class="form-group">
									<label class="control-label col-lg-4">Jenis Arus Kas</label>
						<div class="col-lg-5">
                                    <select name="aruskas" class="select-search">
                                    <option value="">Pilih Jenis Arus Kas</option>
                                    <?php
										foreach($db->select("ak_paruskas","*") as $k){
											echo"<option value=\"$k[id_param]\">$k[nama]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div>
                      <div id="bam">
                     <div class="form-group">
									<label class="control-label col-lg-4">No Maintenance</label>
						<div class="col-lg-5">
                                    <select name="no_amm" id="no_amm" class="select-search" >
                                    <option value="">Pilih Nomer Maintenance</option>
                                    <?php
										foreach($db->select("am_maintenance a join am_asset b on a.ID_AMASSET=b.ID_AMASSET","a.NO_AMM,b.ASSET_NAME","ifnull(a.COST_MAINT,0)='0'") as $k){
											echo"<option value=\"$k[NO_AMM]\">$k[ASSET_NAME] - $k[NO_AMM]</option>";	
										}
									?>
                                    </select>
                      	</div>
                      </div>
                      </div>
                      <div id="bag">
                      <div class="form-group">
									<label class="control-label col-lg-4">Cabang</label>
								  <div class="col-lg-5">
									  <select class="select-search" name="cabangsn" id="cabangsn" >
									    <option value="">--Please Select--</option>
									    <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cabang']?>"> <?=$sel['nama_cabang']?></option> <?php } ?>
								      </select> 
                                  </div>
                      			</div>
                      </div>
                      <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-4">
                                    	<input type="text" name="ket" id="ket" class="form-control" value="" />
								  	</div>
					</div>                  
                      <div class="form-group">
									<label class="control-label col-lg-4">Jumlah (Rp.)</label>
									<div class="col-lg-2">
                                    <input type="text" name="jml" id="jml" class="form-control harga" />
                                    <input type="hidden" name="posisi" id="posisi" class="form-control" value="debet"/>                               
									</div>
									<div class="col-lg-2">
                                    	<input type="checkbox" class="control-warning" id="checkbox"> Diskon/Kredit
                                    </div> 
                                   <!-- <label class="control-label col-lg-1">Posisi</label>
                                    <div class="col-lg-2">
                                    <select class="select" name="posisi" id="posisi" required>                                    	
                                        <option value="debet">Debet</option>
                                    </select>
								     	</div>-->
                      </div>
                      
                                <div class="form-group"></div>
                                <div class="form-group">
                                  <div class="col-lg-5"></div>
					  </div>
                      </div>
					  <div id="pum">                            
                                <div class="form-group">
									<label class="control-label col-lg-4">Daftar PUM</label>
									<div class="col-lg-4">
                                      <input type="text" name="j" id="j" class="form-control" readonly />
                                 	  <input type="hidden" name="norek1" id="korekj" class="form-control" readonly/> 
                                  </div>
                                  <div class="col-lg-4">
                                  	  <a href="javascript:void(0)" class="btn btn-info" onclick="modalnya()">Tambah</a>
                                      <a href="javascript:void(0)" id="mod" data-toggle="modal" data-target="#modal_remote" style="visibility:hidden"></a>
                                      
                                  </div>
                      			</div>
                      			<div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-4">
                                    	<input type="text" name="ket1" id="ket1" class="form-control" value="" autocomplete="off" required readonly/>
								  	</div>
								</div> 
                 <div class="form-group">
                  <label class="control-label col-lg-4">Jenis Arus Kas</label>
                  <div class="col-lg-4">
                                      <select name="aruskas1" class="select-search" >
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
									<label class="control-label col-lg-4">Jumlah (Rp.)</label>
									<div class="col-lg-2">
                                    <input name="jml1" type="text" required class="form-control harga" id="jml1" size="9" readonly/>
                                    <input type="hidden" name="curr1" id="curr" class="form-control" value="debet"/>
                                    			
								</div>          
                    			</div>
					                                  
                      
                                    <!--<label class="control-label col-lg-1">Posisi</label>
                        <div class="col-lg-2">
                                    <select class="select" name="curr" id="curr" onChange="">
                                    	
                                        <option value="debet">Debet</option>
                                        
                                    </select>
				     	</div>-->
                      </div>
                      
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit">
										 Tambah transaksi 
                                        </button>                                        
									</div>
								</div>                            		
                    </form>
                    </div>	
                    </div>                    
				</div>                
		</div>
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
                    
					<form class="form-horizontal" action="index.php?x=bankkeluar_ss" name="formku2" id="formku2" method="post" onSubmit="return(checkmin())">
							<fieldset class="content-group">
                                <div class="form-group">                                
                   <table id="example4" class="table datatable table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               <th width="20%">Kode Rekening</th>
                               <th width="50%">Keterangan</th>
                              <th width="15%">Jumlah Rekening</th>
                              <th width="10%">Aksi</th>
                            </tr>
                            <?php
					//if($_POST[id]!=''){
                    $sat=$db->select("ak_jurnal_dtl_tmp","*","TIPE='BK' and IFNULL(HD,0)='0' AND ID_USER='$_SESSION[ID_LOGIN]'");
					foreach($sat as $val){
						$debet=$val['DEBET']-$val['KREDIT'];
						$total_debet = $total_debet + $debet;						
					//}
					?>
                            <tr>
                              <th><?php echo $val ['ACC_CODE']; ?></th>
                              <th><?php  echo $val ['KET_DTL']; ?></th>
                              <th style="text-align:right"><?php echo $db->minus($val ['DEBET']-$val ['KREDIT']);?></th>
                              <th><ul class='icons-list'>
			<li class='text-danger-200'><a href='javascript:void(0)' onclick='hapus(<?php echo $val['IDX']?>)' style='cursor:pointer' class='icon-trash'></a></li>
			</ul></th>
                            </tr>
                      <?php }?>    
                        </thead>
                        <tr>
						    <td class="td" colspan="2" align="center"><b>TOTAL</b></td>
                            <th  style="text-align:right"><?php echo number_format($total_debet); ?><input type="hidden" name="total" id="total"  value="<?=$total_debet?>"></th>                            
                            <td class="td" align="center">&nbsp;</td>					   
					    </tr>
                    </table>
                   		 <input type="hidden" name="aksi" id="aksi"  value=""  required>
                         <input type="hidden" name="id" id="id"  value=""  required>
                    <br />
                    	 <div class="form-group">
							<label class="control-label col-lg-4">Rekening bank</label>
								<div class="col-lg-4">
									<input type="text" name="group" id="korek1" value="" class="form-control" />                                     
								</div>
						</div>   
                        <!--
                         <div class="form-group">
							<label class="control-label col-lg-4">Nomor Invoice</label>
								<div class="col-lg-4">
									<input type="text" name="no_invo" id="no_invo" class="form-control" value="" autocomplete="off" />
								</div>
                        	<label class="control-label col-lg-2">Tanngal Invoice</label>
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
                        -->
                        
                      <?php if($_SESSION['ID_CABANG']=='0'){ ?>
                      <div class="form-group">
									<label class="control-label col-lg-4">Cabang</label>
								  <div class="col-lg-5">
									  <select class="select-search" name="cabang" id="cabang" required>
									    <option value="">--Please Select--</option>
									    <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_cabang']?>"> <?=$sel['nama_cabang']?></option> <?php } ?>
								      </select> 
                                  </div>
                      			</div>
                       <?php }else{ ?>
                       <input type="hidden" name="cabang" value="<?=$_SESSION['ID_CABANG']?>">
                       <?php } ?>
                        <div class="form-group">
                        	<label class="control-label col-lg-4">Tanggal Transaksi</label>
                            	<div class="col-lg-2">
                                	<div class="input-group">
                                    	<span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                        <input type="text" class="form-control datepicker1" name="tgl_trans" id="tgl_trans" value="<?php if($val['tanngal']==''){
											echo date("Y-m-d");
											}else{
											echo $val['tanngal'];
											}?>" />
                                            
                                    </div>                                    
                                </div>
                        </div>
                        <div class="form-group">
                        	<label class="control-label col-lg-4">Catatan</label>
                            	<div class="col-lg-4">
                                <input type="text" class="form-control" name="cacat" id="cacat" value="" required />
                                </div>
                        </div>
                        <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return checkmin()">
										 Simpan Jurnal
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=typerek'">
										 Batal 
                                        </button>
									</div>
						</div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>
        <div id="modal_remote" class="modal fade">    
                              <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h5 class="modal-title">Cari Pengajuan UM</h5>
                                        </div>
                                        <div class="modal-body" id="bud">
                                        
                                        </div>
            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

 

