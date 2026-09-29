    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("am_model","*","ID_AMODEL='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=asetmodel_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Model</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['NAMA_AMODEL']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_AMODEL']?>"  required>
									</div>
								</div>
                                
                                 <div class="form-group">
                                   <label class="control-label col-lg-4">Nama Kategori</label>
								   <div class="col-lg-6">
										<select class="select" name="kat" id="kat">
                                      		 <option value="">-- Nama Kategori--</option>
											<?php
											$query=$db->select("am_katagori","*","STATUS_AKATAGORI='1'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_AKATAGORI']?>"  <?php if($sel['ID_AKATAGORI']==$val['ID_AKATAGORI']){echo "selected";}?>><?=$sel['NAMA_AKATAGORI']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4">Nomor Model</label>
									<div class="col-lg-5">
										<input type="text" name="nomo" id="nomo" class="form-control" autocomplete="off" value="<?=$val['NOMOR_AMODEL']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Keterangan Model</label>
									<div class="col-lg-5">
										<input type="text" name="ketmo" id="ketmo" class="form-control" autocomplete="off" value="<?=$val['KETERANGAN_AMODEL']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Jenis</label>
								   <div class="col-lg-6">
										<select class="select" name="depresiasi" id="depresiasi">
                                      		 <option value="1">Depresiasi</option>
                                             <option value="2">Tidak Di Depresiasi</option>
									</select>
								   </div>
								</div>
                                <div id="dep">
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Depresiasi</label>
								   <div class="col-lg-6">
										<select class="select-search" name="depres" id="depres">
                                      		 
											<?php
											if(empty($_POST[id])){
											$query=$db->select("am_depresiasi","*","status_depresiasi='1'");
											echo "<option value=\"\">-- Jenis Depresiasi--</option>";
											}else {
												$query=$db->select("am_depresiasi","*","status_depresiasi='1' AND id_depresiasi='$val[ID_DEPRESIASI]'");
												}
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_depresiasi']?>"  <?php if($sel['id_depresiasi']==$val['ID_DEPRESIASI']){echo "selected";}?>><?=$sel['nama_depresiasi']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                      <div class="form-group">
                     
									<label class="control-label col-lg-4">Masa Ekonomis <?=$ck?></label>
									<div class="col-lg-2">
										<input name="eolmo" type="text" class="form-control" id="eolmo" autocomplete="off" value="<?=$val['EOL_AMODEL']?>" size="3" > </div>
                                        <div class="col-lg-3">
										Bulan</div>
								</div>
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=asetmodel'">
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
		<form action="index.php?x=asetmodel" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                             	<th width="12%">Nama Model</th>
                                <th width="12%">Kategori</th>
                                <th width="12%">Nomor Model</th>
                                <th width="12%">Keterangan Model</th>
                                <th width="12%">Masa Ekonomis</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
		   			<input type="hidden" name="aksi" id="aksi"  value=""  required>
            		<input type="hidden" name="id" id="id"  value=""  required>
   		  </div>
			</form>
		</div>
<div id="datapelanggan" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-primary">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h6 class="modal-title">Detil</h6>
							</div>
							<div class="modal-body" id="hahaha">
                            
															
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
								
							</div>
						</div>
					</div>
				</div>
       
<?php
if($_POST[aksi]=='hapus'){
	$where = array("ID_AMODEL" => $_POST['id']);
	$db->delete("am_model",$where);
	echo "<script>window.location='index.php?x=asetmodel'</script>";
}
?>