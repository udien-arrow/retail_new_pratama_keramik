<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_param_ikbat","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=parban_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Masa Kerja</label>
									<div class="col-lg-5">
										<input type="text" name="masa" id="masa" class="form-control" autocomplete="off" value="<?=$val['masa_kerja']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Masa Kerja Akhir</label>
									<div class="col-lg-5">
										<input type="text" name="akhir" id="akhir" class="form-control" autocomplete="off" value="<?=$val['masa_kerja_akhir']?>" required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nominal</label>
									<div class="col-lg-5">
										<input type="text" name="nominal" id="nominal" class="form-control" autocomplete="off" value="<?=$val['nominal']?>" required>
									</div>
								</div>
                                <?php 
								if($_POST['id']==""){}else{
								?>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=parban'">
										 Batal 
                                        </button>
									</div>
								</div>  
                                <?php } ?>   
					</form>
					</div>	
				</div>	
                </div>				
		</div>
        <div class="col-lg-7">
		<form action="index.php?x=parban" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">View <?=$title?></h5>
					</div>
                    <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer">
                        <thead>
                            <tr>
                                <th width="13%">No</th>
                                <th width="15%">Masa Kerja</th>
                                <th width="15%">Masa Kerja Akhir</th>
                                <th width="15%">Nominal</th>
                                <th width="3%">Aksi</th>
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
	$where = array("id_satuan" => $_POST['id']);
	$db->delete("m_satuan",$where);
	echo "<script>window.location='index.php?x=parjam'</script>";
}
?>