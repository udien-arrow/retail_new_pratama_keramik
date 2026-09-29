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
    	<form class="form-horizontal" action="index.php?x=billing_ss" name="formku" id="formku" method="post" onSubmit="return(validate_frm())"  enctype="multipart/form-data">
		
        <div class="col-lg-10">
				<div class="panel panel-flat">
                <div class="panel-heading">
						<h5 class="panel-title">Input Billing Semen</h5>
                        
					</div>
                    <div class="dataTables_wrapper"></div>
					<br>
                  <div class="form-group">
							<label class="control-label col-lg-1">&nbsp;&nbsp;&nbsp;Supplier</label>
                             <div class="col-lg-2">
                                    <select name="supp2" id="supp2" class="select-search" >
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
                                 Contoh Upload :<a href="assets/inventory/up_so/so_billing.csv" ><img id="expxls" name="expxls" src="assets/inventory/up_so/excel.png" alt="" width="22" height="22" border="0"  title="Type file .csv"/></a>
                              </div>        
                    </div>
					
				</div>					
		</div>
        <div class="col-lg-1">
        </div>
</form>
        <form class="form-horizontal" action="index.php?x=billing_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
		<div class="col-lg-1">
		</div>
        <div class="col-lg-10">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Input Billing Non Semen</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li><input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Billing" onClick="window.location='index.php?x=billing_v'"></button></li>
							</ul>
                            </div>
					</div>
                    <div class="dataTables_wrapper"></div>
                     
                   <br>
                    
                  
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Supplier</label>
                              <div class="col-lg-6">
                              	  <select name="supp" id="supp" class="select-search" onChange="pindahData2()">
                              	    <option value="">---Supplier---</option>
                              	    	<?php
											$query=$db->select("m_supplier","id_supp,nama_supp,nama_usaha,id_valuta,pkp");
											foreach($query as $sel){	
												if($_GET['supp']==$sel['id_supp']){
												$st="selected";
												}else{
												$st="";
												}
			                            ?>
                              	    <option value="<?=$sel['id_supp']?>" <?=$st?>>
                              	    <?=$sel['nama_usaha']?>
                           	        </option>
                              	    <?php 
										}
									?>
                           	      </select>  
                      </div>          
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;No Referensi</label>
                              <div class="col-lg-4">
                              	    <select name="noref" id="noref" class="select-search" onChange="pindahData2()">
                              	      <option value="">---No Referensi---</option>
                              	      <?php
											$query=$db->select("tx_brg_masuk ","no_ref","id_supp='$_GET[supp]' and (no_ref not in (select no_ref from tx_billing) 
or surat_jalan not in (select no_spj from tx_billing_dtl)) and jenis!=2 group by no_ref ");
											foreach($query as $sel){
												if($_GET['noref']==$sel['no_ref']){
												$st="selected";
												}else{
												$st="";
												}	
			                            ?>
                              	      <option value="<?=$sel['no_ref']?>" <?=$st?>>
                              	        <?=$sel['no_ref']?>
                           	          </option>
                              	      <?php 	
										}
									?>
                           	      </select>	  
                      </div>          
                    </div>
                   	<div class="form-group">
                    <label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Detil Referensi</label>
                              <div class="col-lg-9">
                    				 <?php
                                    	include("keranjang.php");
									 ?>
                   	 </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;No Billing</label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	 
                                  <input type="text" class="form-control"  name="billing" id="billing" value="">
                                  <input type="hidden" class="form-control" name="jum" id="jum" value="0">
                              	  <input type="hidden" class="form-control" name="total_bil" id="total_bil" value="0">
                              	  <input type="hidden" class="form-control" name="total_bil2" id="total_bil2" value="<?=$totjum?>">
                              	  </div>
                               </div>          
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;No Faktur</label>
                              <div class="col-lg-3">
                              	  <div class="input-group">
                              	 
                                  <input type="text" class="form-control"  name="nofak" id="nofak" value="">
                                  
                              	  </div>
                               </div>          
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;Tgl</label>
                             <div class="col-lg-3">
                              	  <div class="input-group">
                              	  <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                  <input type="text" class="form-control datepicker" name="tgl" id="tgl" value="<?php echo date("d-m-Y")?>">
                                  </div>
                               </div>        
                    </div>
                     <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp; Keterangan</label>
                              <div class="col-lg-6">
                              	 
                                  <input type="text" class="form-control" name="ket" id="ket" value="">
                                 
                       </div>          
                    </div>
                    <div class="form-group">
                    <div class="col-lg-3">&nbsp;
                    </div>
                    </div>
                    <div class="form-group">
							<label class="control-label col-lg-2">&nbsp;&nbsp;&nbsp;&nbsp;</label>									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" name="simpan" value="simpan">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="batal()">
										 Batal 
                                        </button>
							</div>
                         </div>       
                         
                         
						
                    
				</div>					
		</div>
        <div class="col-lg-1">
		</div>
</form>
<?php
if($_POST['delnot']){
	$where = array("status" => 1);
	$db->delete("tx_billing_notif",$where);
}
?>

