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
					<form class="form-horizontal" action="index.php?x=asset_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Asset</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['ASSET_NAME']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['ID_AMASSET']?>"  required>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Model</label>
								   <div class="col-lg-6">
										<select class="select-search" name="mod" id="mod">
                                      		 <option value="">-- Model --</option>
											<?php
											$query=$db->select("am_model","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['ID_AMODEL']?>"  <?php if($sel['ID_AMODEL']==$val['ID_AMODEL']){echo "selected";}?>><?=$sel['NAMA_AMODEL']?></option> <?php } ?>
									</select>
								   </div>
								</div>                
                      <div class="form-group">
									<label class="control-label col-lg-4">Asset Tag</label>
									<div class="col-lg-5">
										<input type="text" name="tag" id="tag" class="form-control" autocomplete="off" value="<?=$val['ASSET_TAG']?>" required>
								      
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4">Asset SN</label>
									<div class="col-lg-5">
									  <input type="text" name="sn" id="sn" class="form-control" autocomplete="off" value="<?=$val['ASSET_SN']?>" required>
									</div>
								</div>
                      		<div class="form-group">
									<label class="control-label col-lg-4">Tgl Beli</label>
									<div class="col-lg-5">
										<input type="text" name="date" id="date" class="form-control datepicker" autocomplete="off" value="<?=$val['ASSET_PURCHASE']?>" required></div>
								</div>
                                <div class="form-group"><label class="control-label col-lg-4">Harga Beli</label>
                                  <div class="col-lg-5">
                                    <input type="text" name="pri" id="pri" class="form-control" autocomplete="off" value="<?=$val['ASSET_HARGABELI']?>" required />
                                  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Lama Garansi</label>
									<div class="col-lg-2">
										<input type="text" name="wa" id="wa" class="form-control" autocomplete="off" value="<?=$val['ASSET_WARRANTY']?>" required></div>
                                    <div class="col-lg-2">
									Bulan
                                    </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Keterangan</label>
									<div class="col-lg-5">
										<input type="text" name="ket" id="ket" class="form-control" autocomplete="off" value="<?=$val['ASSET_KETERANGAN']?>" required></div>
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
		<form action="index.php?x=asset" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
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
                                <th width="10%">Asset Harga Beli</th>
                                <th width="5%">Asset Garansi</th>
                                <th width="5%">Asset Keterangan</th>
                                <th width="5%">NIA</th>
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
	$where = array("ID_AMASSET" => $_POST['id']);
	$db->delete("am_asset",$where);
	echo "<script>window.location='index.php?x=asset'</script>";
}
?>