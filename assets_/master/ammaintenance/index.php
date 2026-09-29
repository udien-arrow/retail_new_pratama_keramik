	   	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_asset a JOIN am_maintenance b ON a.ID_AMASSET=b.ID_AMASSET","*","b.ID_MAINT='$_POST[id]'");

					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=mainasset_s1" name="formku" id="formku" method="post">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group"></div>
                      <div class="form-group"><label class="control-label col-lg-4">Nama Asset</label>
                                  <div class="col-lg-6">
										<select class="select" name="na" id="na" readonly="readonly">
                                      		 
											<?php
											$query=$db->select("am_asset","*","ID_AMASSET='$val[ID_AMASSET]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_AMASSET']?>"  <?php if($sel['ID_AMASSET']==$val['ID_AMASSET']){echo "selected";}?>><?=$sel['ASSET_NAME']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Asset Tag</label>
									<div class="col-lg-5">
									  <input type="text" name="atag" id="atag" class="form-control datepicker" autocomplete="off" value="<?=$val['ASSET_TAG']?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Asset Serial Number</label>
									<div class="col-lg-5">
									  <input type="text" name="sn" id="sn" class="form-control" autocomplete="off" value="<?=$val['ASSET_SN']?>" required readonly>
								      
									</div>
								</div>
                      			<div class="form-group">
								  <label class="control-label col-lg-4">Tgl Maintenance</label>
									<div class="col-lg-5">
									  <input name="pdate" type="text" required class="form-control" id="pdate" autocomplete="off" value="<?=$val['TGL_MAINT']?>" readonly>
                                    </div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Tgl Selesai</label>
									<div class="col-lg-5">
									  <input name="pselesai" type="text" required class="form-control datepicker" id="pselesai" autocomplete="off" value="">
                                    </div>
								</div>
                                <?php 
								$ks=$db->select("am_maintenance_dtl","sum(harga) as harga","id_am_main='$_POST[id]' and status='1'");
								foreach($ks as $ka){}
								 ?>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Biaya</label>
									<div class="col-lg-5">
									  <input name="cost" type="text" required class="form-control" id="cost" autocomplete="off" value="<?=$ka['harga']?>" readonly>
                                    </div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Catatan Maintenance</label>
									<div class="col-lg-5">
									  <input type="text" name="kethapus" id="kethapus" class="form-control" autocomplete="off" value="" required>
								      
									  <span class="col-lg-6">
									  <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$_POST[id]?>"  required="required" />
									  <input type="hidden" name="kode2" id="kode2" class="form-control" value="<?=$val['ST_ASSET']?>"  required="required" />
                                      <input type="hidden" name="kode3" id="kode2" class="form-control" value="<?=$val['ID_AMASSET']?>"  required="required" />
							        </span></div>
								</div>
                               
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" <?php if(empty($_POST[id])){echo"disabled";}?>>
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=mainasset'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
				</div>	
                </div>				
		</div>

        <div class="col-lg-7">
		<form action="index.php?x=mainasset" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Data Maintenance Asset
                        <input style="height:25px; line-height: 0; float:right" type="button" class="btn btn-info" value="Maintenance Asset" onClick="window.location='index.php?x=mainasset_v'">
                        </h5>
					</div>
                     <br />
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                            	<th width="10%">No Maintenance</th>
                             	<th width="10%">Nama Asset</th>
                                <th width="10%">Tgl Maintenance</th>
                                <th width="10%">Tgl Selesai</th>
                                <th width="10%">Keterangan</th>
                                <th width="10%">Cost</th>
                                <th width="10%">Status</th>
                                <th width="10%">Lokasi</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
      