    <!-- Theme JS files -->
	<style>
			table {
				border-collapse: collapse;
			}
			table, td, th {
				border: 1px solid #C4DAE7 ;
				padding:2px;
			}
			.scrolls {
				overflow-x: scroll;
				overflow-y: hidden;
				white-space:nowrap
			}
	</style>
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
		<form action="index.php?x=pembgaji_s" id="form_index" method="post">
   		  <div class="panel panel-flat" >
		    <div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
                     </div>
            		<div class="dataTables_wrapper">
                    </div>
                   <div class="panel-body scrolls">
                   <div class="form-group">
					<?php 
                        include("v_jenis.php");	
                    ?>
				  </div><br>
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
						</div> <br>
<br>
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
                        </div><br>
<br>

				

				  <div class="form-group">
									<label class="control-label col-lg-3"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pembsupp'">
										 Batal 
                                        </button>
									</div>
						</div>     
				  
                </div>
                </div>
                </form>
                </div>

