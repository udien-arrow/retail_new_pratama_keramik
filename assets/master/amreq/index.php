    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_asset","*","ID_AMASSET='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=reqdeploy_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group"><label class="control-label col-lg-4">Lokasi</label>
                                  <div class="col-lg-6">
										<select class="select" name="mod" id="mod">
                                      		 <option value="">-- Nama Lokasi --</option>
											<?php
											$query=$db->select("am_lokasi","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_ALOKASI']?>"  <?php if($sel['ID_ALOKASI']==$val['ID_ALOKASI']){echo "selected";}?>><?=$sel['NAMA_ALOKASI']?></option> <?php } ?>
									</select>
                                    
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_REQDEPLOY']?>"  required>
								   </div>
								</div>
                             
                              
                      <div class="form-group"><label class="control-label col-lg-4">Nama Asset</label>
                                  <div class="col-lg-6">
										<select class="select" name="na" id="na">
                                      		 <option value="">-- Nama Asset --</option>
											<?php
											$query=$db->select("am_asset","*","ASSET_STATUS='1'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_AMASSET']?>"  <?php if($sel['ID_AMASSET']==$val['ID_AMASSET']){echo "selected";}?>><?=$sel['ASSET_NAME']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Tanggal Request</label>
									<div class="col-lg-5">
									  <input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off" value="<?=$val['REQDEPLOY_DATE']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-5">
									  <input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['REQDEPLOY_KETERANGAN']?>" required>
								      
									</div>
								</div>
                               
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=asset'">
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
		<form action="index.php?x=reqdeploy" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="10%">Nama Lokasi</th>
                                <th width="10%">Nama Asset</th>
                                <th width="10%">Tanggal Request</th>
                                <th width="10%">Keterangan Request</th>
                                <th width="10%">Request Pegawai</th>
                                <th width="10%">Status</th>
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
	$where = array("ID_REQDEPLOY" => $_POST['id']);
	$db->delete("am_reqdeploy",$where);
	echo "<script>window.location='index.php?x=asset'</script>";
}
?>