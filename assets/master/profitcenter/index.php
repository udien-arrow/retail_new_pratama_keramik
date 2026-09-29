
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
                    $sat=$db->select("ak_profit_center","*","id='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=profitcenter_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                  <div class="col-lg-3"></div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">kode Profit</label>
									<div class="col-lg-5">
										<input type="text" name="deprof" id="deprof" class="form-control" autocomplete="off" value="<?=$val['kode_profit']?>" required>
					     	          <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required="required" />
								  </div>
								</div>
                                <div class="form-group">
                                  <div class="col-lg-7"></div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Profit</label>
									<div class="col-lg-5">
										<input type="text" name="profit" id="profit" class="form-control" autocomplete="off" value="<?=$val['nama_profit']?>" required>
					     	          <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required="required" />
								  </div>
								</div>
                                <div class="form-group">
                                  <div class="col-lg-7"></div>
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
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=profitcenter'">
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
		<form action="index.php?x=profitcenter" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master profit center</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kode</th>
                              <th width="10%">Nama Profit</th>
                                
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
	$where = array("id" => $_POST['id']);
	$db->delete("ak_profit_center",$where);
	echo "<script>window.location='index.php?x=profitcenter'</script>";
}
?>