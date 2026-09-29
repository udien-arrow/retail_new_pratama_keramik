
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
					if($_POST[id]!=''){
                    $sat=$db->select("m_grup","*","id_grup='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=parju_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">ID</label>
									<div class="col-lg-3">
                                    <?php
									$ids=$db->select("m_grup","*","id_grup='$_POST[id]'");
									foreach($ids as $val){}
									
									?>
										<input type="text" name="kode" id="kode" class="form-control" autocomplete="off" value="<?=$val['id_grup']?>" required readonly>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Jenis</label>
									<div class="col-lg-7">
										<input type="text" name="jenis" id="jenis" class="form-control" autocomplete="off" value="<?=$val['jenis']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Inventory</label>
									<div class="col-lg-7">
									  <select class="select-search" name="inven1" id="inven1">
									    <option value="">--Inventory--</option>
									    <?php
											$query=$db->select("ak_acc","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"  <?php if($sel['account']==$val['description']){echo "selected";}?>>
                                        <?=$sel ['account']?> - <?=$sel['description']?> 
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                    </div>
                               <div class="form-group">
									<label class="control-label col-lg-4">Cogs</label>
									<div class="col-lg-7">
									  <select class="select-search" name="cogs" id="cogs">
									    <option value="">--Cogs--</option>
									    <?php
											$query=$db->select("ak_acc","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"  <?php if($sel['account']==$val['account']){echo "selected";}?>>
									      <?=$sel ['account']?> - <?=$sel['description']?> 
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                    </div>
                                     <div class="form-group">
									<label class="control-label col-lg-4">Inventory Afk</label>
									<div class="col-lg-7">
									  <select class="select-search" name="invent" id="invent">
									    <option value="">--Inventory Afk--</option>
									    <?php
											$query=$db->select("ak_acc","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"  <?php if($sel['account']==$val['account']){echo "selected";}?>>
									      <?=$sel ['account']?> - <?=$sel['description']?> 
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                    </div>
                                     <div class="form-group">
									<label class="control-label col-lg-4">Intransit</label>
									<div class="col-lg-7">
									  <select class="select-search" name="intransit" id="intransit">
									    <option value="">--Intransit--</option>
									    <?php
											$query=$db->select("ak_acc","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['account']?>"  <?php if($sel['account']==$val['account']){echo "selected";}?>>
									       <?=$sel ['account']?> - <?=$sel['description']?> 
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                    </div>
                                    
                                 
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=parju'">
										 Batal 
                                        </button>
									</div>
								</div>     
					</form>
					</div>	
                    </div>
				</div>					
		</div>
    <div class="col-lg-8">
		<form action="index.php?x=parju" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Parameter Jurnal</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                               
                              <th width="35%">Jenis</th>
                               <th width="20%">Inventory</th>
                                <th width="20%">Cogs</th>
                                 <th width="20%">Inventory Afk</th>
                                 <th width="5%">Intransit</th>
                                <th width="4%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
<?php
if($_POST[aksi]=='hapus'){
	$data = array("status" => 0);
	$db->update("m_grup",$data,"id_grup='$_POST[id]'");
	echo "<script>window.location='index.php?x=parju'</script>";
}
?>