<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_asset a LEFT JOIN am_model b on a.ID_AMODEL=b.ID_AMODEL LEFT JOIN am_depresiasi_in c on a.ID_AMASSET=c.ID_ASSET","a.*,
Sum(c.BIAYA_PENYUSUTAN) AS BIAYA_PENYUSUTANNYA,
b.EOL_AMODEL","a.ID_AMASSET='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=remaset_s" name="formku" id="formku" method="post">
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
								  <label class="control-label col-lg-4">Purchase Date</label>
									<div class="col-lg-5">
									  <input name="pdate" type="text" required class="form-control datepicker" id="pdate" autocomplete="off" value="<?=date("d-m-Y",strtotime($val['ASSET_PURCHASE']))?>" readonly>
								      
									</div>
								</div>
                               	<div class="form-group">
								  <label class="control-label col-lg-4">Harga Beli</label>
									<div class="col-lg-5">
									  <input name="hbeli" type="text" required class="form-control datepicker" id="hbeli" autocomplete="off" value="<?=number_format($val['ASSET_HARGABELI'])?>" readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Masa Ekonomis</label>
									<div class="col-lg-5">
									  <input type="text" name="ekonom" id="ekonom" class="form-control datepicker" autocomplete="off" value="<?=number_format($val['EOL_AMODEL'])?> bulan" required readonly>
								      
									</div>
								</div>

                                <div class="form-group">
								  <label class="control-label col-lg-4">Depresiasi (Bulan)</label>
									<div class="col-lg-5">
									  <input type="text" name="ekonom" id="ekonom" class="form-control datepicker" autocomplete="off" value="<?=number_format($val['DEPRESIASI_KE'])?> bulan" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Depresiasi (Rp)</label>
									<div class="col-lg-5">
									  <input type="text" name="ekonom" id="ekonom" class="form-control datepicker" autocomplete="off" value="<?=number_format($val['BIAYA_PENYUSUTAN'])?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Akum. Depresiasi (Rp)</label>
									<div class="col-lg-5">
									  <input type="text" name="ekonom" id="ekonom" class="form-control datepicker" autocomplete="off" value="<?=number_format($val['BIAYA_PENYUSUTANNYA'])?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Jenis</label>
									<div class="col-lg-5">
									  <select class="select" name="jhapus" id="jhapus" readonly="readonly">
									    <option value="">Pilih Jenis Penghapusan</option>
									    <option value="1">Hilang</option>
									    <option value="2">Rusak</option>
									    <option value="3">Dijual</option>
								      </select>
									</div>
								</div> 
                               
                                <div class="form-group">
								  <label class="control-label col-lg-4">Catatan Penghapusan</label>
									<div class="col-lg-5">
									  <input type="text" name="kethapus" id="kethapus" class="form-control" autocomplete="off" value="" required />
									  <span class="col-lg-6">
								    <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$_POST[id]?>"  required="required" />
								    </span></div>
								</div>
                               
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" <?php if(empty($_POST[id])){echo"disabled";}?>>
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=remaset_v'">
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
		<form action="index.php?x=remaset_v" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">List Asset
                        <input style="height:25px; line-height: 0; float:right" type="button" class="btn btn-info" value="Remove Asset" onClick="window.location='index.php?x=remaset'">
                        </h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="10%">Nama Asset</th>
                                <th width="10%">Model</th>
                                <th width="10%">Asset Tag</th>
                                <th width="10%">Asset Status</th>
                                <th width="10%">Asset Sn</th>
                                <th width="10%">Tanggal Pembelian</th>
                                <th width="10%">Harga Beli</th>
                                <th width="5%">Asset Garansi</th>
                                <th width="5%">Asset Keterangan</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
<?php

?>
