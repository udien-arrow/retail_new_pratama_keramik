
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
	 <form class="form-horizontal" action="index.php?x=up_so_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		<div class="col-lg-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Data SO</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                   <br>
                  <div class="form-group">
							<label class="control-label col-lg-1">&nbsp;&nbsp;&nbsp;</label>
                             <div class="col-lg-2">
                                    <select name="supp" id="supp" class="select-search" onChange="pindahData3(jenis.value,spb.value,supp.value)">
										<option value="">---Supplier---</option>
										<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,nama_usaha,id_valuta");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_supp']?>" <?php if($sel['id_supp']==$_GET['supp']){echo "selected";}?>><?=$sel['nama_usaha']?></option>
                                        
                                        <?php 
											if($_GET['supp']==$sel['id_supp']){
												$valu=$sel['id_valuta'];
											}
										}
										
										
										?>    
									</select>
                                    
                                    </div> 
                             <div class="col-lg-4">
                                 <input type="file" name="file" id="file" size="150"  class="file-input" data-show-preview="false">
                               </div>
                               
                               <div class="col-lg-3">
                                 Contoh Upload :<a href="assets/inventory/up_so/so_upload.csv" ><img id="expxls" name="expxls" src="assets/inventory/up_so/excel.png" alt="" width="22" height="22" border="0"  title="Type file .csv"/></a>
                              </div>  
                               <!--<div class="col-lg-5">
                               			
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Hapus 
                                        </button>
                                        <input type="hidden" name="aksi" id="aksi"    required>
								      
								</div>-->
                    </div>
					<div class="panel-body">
                    			
                    
                                <div class="form-group">
                                <div class="table-responsive">
                                    	<table width="100%" border="1" cellpadding="0" cellspacing="0" class="table">
                                          <thead>
                                          <tr>
                                            <th width="2%"align="left"><strong>No</strong></th>
                                            <th width="5%"align="left"><strong>Sales Order</strong></th>
                                            <th width="5%" align="left"><strong>SO Date</strong></th>
                                            <th width="5%" align="left"><strong>Delivery Date</strong></th>
                                            <th width="5%" align="left"><strong>Inco term</strong></th>
                                            <th width="5%" align="left"><strong>District Code</strong></th>
                                            <th width="10%" align="left"><strong>District Name</strong></th>
                                            <th width="5%" align="left"><strong>Ship to Code</strong></th>
                                            <th width="5%" align="left"><strong>Material Code</strong></th>
                                            <th width="20%" align="left"><strong>Materi</strong></th>
                                            <th width="5%" align="left"><strong>SO Qty</strong></th>
                                            <th width="5%" align="left"><strong>UOM</strong></th>
                                            <th width="5%" align="left"><strong>Real Qty</strong></th>
                                            <th width="5%" align="left"><strong>SO Open</strong></th>
                                            <th width="5%" align="left"><strong>Price</strong></th>
                                            <th width="5%" align="left"><strong>Line</strong></th>
                                          </tr>
                                          </thead>
                                          <?php
                                          $kon=$db->select("tx_upload_so","*","status_tx='1'");
                                          $no=1;
                                          foreach($kon as $d){ 
										  ?>
                                          <tr>
                                            <td align="left"><?php echo $no?>&nbsp;</td>
                                            <td align="left"><?=$d['sales_order']?></td>
                                            <td align="left"><?=$d['so_date']?></td>
                                            <td align="left"><?=$d['delvery_date']?></td>
                                            <td align="left"><?=$d['incoterm']?></td>
                                            <td align="left"><?=$d['district_code']?></td>
                                            <td align="left"><?=$d['disctrict_name']?></td>
                                            <td align="left"><?=$d['shipto_code']?></td>
                                            <td align="left"><?=$d['material_code']?></td>
                                            <td align="left"><?=$d['material']?></td>
                                            <td align="left"><?=$d['so_qty']?></td>
                                            <td align="left"><?=$d['uom']?></td>
                                            <td align="left"><?=$d['real_qty']?></td>
                                            <td align="left"><?=$d['so_open']?></td>
                                            <td align="left"><?=number_format($d['price'])?></td>
                                            <td align="left"><?=$d['line']?></td>
                                          </tr>
                                          <?php $no++;}?>
                                        </table>
                                        </div>
                                 </div>
					</div>	
                    
				</div>					
		</div>
</form>
