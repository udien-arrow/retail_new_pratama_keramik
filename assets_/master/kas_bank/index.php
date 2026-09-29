
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
                    $sat=$db->select("ak_kasbank","*","id_kb='$_POST[id]'");
					foreach($sat as $val){}
					}
					//echo $val['cabang'].'a';
					?>
                    
					<form class="form-horizontal" action="index.php?x=kasbank_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-3"></div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Account</label>
                                    <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_kb']?>"  required="required" />
                                    
									<div class="col-lg-5">
					     	        <input type="text" name="account" id="account" class="form-control" autocomplete="off" value="" required>
								  </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Deskripsi</label>
									<div class="col-lg-5">
										<input type="text" name="desc" id="desc" class="form-control" autocomplete="off" value="<?=$val['description']?>" required>
								  </div>
								</div>    
                      			<div class="form-group">
									<label class="control-label col-lg-4">Cabang</label>
									<div class="col-lg-7">
									  <select class="select-search" name="kode_cabang" id="kode_cabang">
									    <option value="">-- Kode Cabang --</option>
									    <?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['kode_cabang']?>"  <?php if($sel['kode_cabang']==$val['cabang']){echo "selected";}?>>
									      <?=$sel['kode_cabang']?> - <?=$sel['nama_cabang']?>
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Type</label>
									<div class="col-lg-7">
									  <select class="select-search" name="type" id="type">
									    <option value="">-- Type  --</option>
                                            <option value="1">Kas</option>
                                            <option value="2">Bank</option>
                                            <option value="3">Giro</option
								        </option>
								      </select>
									</div>
                                </div>
                    
                                <div class="form-group"></div>
                                <div class="form-group">
                                  <div class="col-lg-5"></div>
					  </div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kasbank'">
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
		<form action="index.php?x=kasbank" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master kas bank</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">account</th>
                              <th width="10%">deskripsi</th>
                                <th width="5%">alamat cabang</th>
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
	$where = array("id_kb" => $_POST['id']);
	$db->delete("ak_kasbank",$where);
	echo "<script>window.location='index.php?x=kasbank'</script>";
}
?>