<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_depresiasi","*","id_depresiasi='$_POST[id]'");
					foreach($sat as $val){
						$ak=$db->select("ak_acc","description","account='$val[akun_aktiva]'");
						foreach($ak as $rak);
						$dep=$db->select("ak_acc","description","account='$val[akun_depresiasi]'");
						foreach($dep as $rdep);
						$bdep=$db->select("ak_acc","description","account='$val[beban_depresiasi]'");
						foreach($bdep as $rbdep);
						$pen=$db->select("ak_acc","description","account='$val[pendapatan]'");
						foreach($pen as $rpen);
						$rug=$db->select("ak_acc","description","account='$val[kerugian]'");
						foreach($rug as $rrug);
						
						}
						
					
					?>
					<form class="form-horizontal" action="index.php?x=depaset_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Jenis Depresiasi</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_depresiasi']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_depresiasi']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Aktiva</label>
									<div class="col-lg-5">
										<input type="text" name="aktiva" id="aktiva" class="form-control" autocomplete="off" value="<?=$val['akun_aktiva']." - ".$rak[description]?>" required>

									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Penyusutan</label>
									<div class="col-lg-5">
										<input type="text" name="susut" id="susut" class="form-control" autocomplete="off" value="<?=$val['akun_depresiasi']." - ".$rdep[description]?>" required>
		
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Beban Penyusutan</label>
									<div class="col-lg-5">
										<input type="text" name="beban" id="beban" class="form-control" autocomplete="off" value="<?=$val['beban_depresiasi']." - ".$rbdep[description]?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Pendapatan</label>
									<div class="col-lg-5">
										<input type="text" name="pendapatan" id="pendapatan" class="form-control" autocomplete="off" value="<?=$val['pendapatan']." - ".$rpen[description]?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kerugian</label>
									<div class="col-lg-5">
										<input type="text" name="rugi" id="rugi" class="form-control" autocomplete="off" value="<?=$val['kerugian']." - ".$rrug[description]?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=depaset'">
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
  <form action="index.php?x=depaset" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Parameter Inventory</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">No </th>
                              	<th width="75%">Jenis Depresiasi</th>
                                <th width="75%">Aktiva</th>
                                <th width="75%">Penyusutan</th>
                                <th width="75%">Beban Penyusutan</th>
                                <th width="75%">Pendapatan</th>
                                <th width="75%">Kerugian</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>

