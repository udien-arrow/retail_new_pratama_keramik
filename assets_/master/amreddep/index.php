    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_reqdeploy","*","ID_REQDEPLOY='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=reddep_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group"><label class="control-label col-lg-4">Lokasi</label>
                                  <div class="col-lg-6">
										<select class="select" name="mod" id="mod" readonly="readonly">
											<?php
											$query=$db->select("am_lokasi","*","ID_ALOKASI='$val[ID_ALOKASI]'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_ALOKASI']?>"  <?php if($sel['ID_ALOKASI']==$val['ID_ALOKASI']){echo "selected";}?>><?=$sel['NAMA_ALOKASI']?></option> <?php } ?>
									</select>
                                    
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_REQDEPLOY']?>"  required>
								   </div>
								</div>
                             
                              
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
								  <label class="control-label col-lg-4">Tanggal Request</label>
									<div class="col-lg-5">
									  <input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off" value="<?=$val['REQDEPLOY_DATE']?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Keterangan Permintaan</label>
									<div class="col-lg-5">
									  <input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['REQDEPLOY_KETERANGAN']?>" required readonly>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Tgl Checkout</label>
									<div class="col-lg-5">
									  <input type="text" name="tgldep" id="tgldep" class="form-control datepicker" autocomplete="off" value="" required>
								      
									</div>
								</div>
                                <div class="form-group">
								  <label class="control-label col-lg-4">Catatan</label>
									<div class="col-lg-5">
									  <input type="text" name="catdep" id="catdep" class="form-control" autocomplete="off" value="" required>
								      
									</div>
								</div>
                               
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')" <?php if(empty($_POST[id])){echo"disabled";}?>>
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
		<form action="index.php?x=reddep" id="form_index" method="post">
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
if($_POST[aksi]=='hapus'){
	$where = array("ID_REQDEPLOY" => $_POST['id']);
	$db->delete("am_reqdeploy",$where);
	echo "<script>window.location='index.php?x=asset'</script>";
}
?>