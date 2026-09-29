
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
                    $sat=$db->select("ak_acc_group","*","id_group='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=kelrek_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-3"></div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama</label>
								  <div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama']?>" required>
					     	          <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_group']?>"  required="required" />
								  </div>
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Status</label>
									<div class="col-lg-7">
									  <select class="select-search" name="status" id="status">
									    <option value="">--Status--</option>
									    <option value="D" <?php if($val['status']=='D'){echo "selected";}?> >Debet</option>    
<option value="K"<?php if($val['status']=='K'){echo "selected";}?>>Kredit</option> 
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
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kelrek'">
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
		<form action="index.php?x=kelrek" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Kelompok Rekening</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Nama</th>
                                <th width="5%">Status</th>
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
	$where = array("id_group" => $_POST['id']);
	$db->delete("ak_acc_group",$where);
	echo "<script>window.location='index.php?x=kelrek'</script>";
}
?>