
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
                    $sat=$db->select("sales","*","ID_SALES='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=sales_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">

                                <div class="form-group">
									<label class="control-label col-lg-4">Nama</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['NAMA_SALES']?>" required>
										<input type="hidden" name="kode" id="kode" class="form-control" autocomplete="off" value="<?=$val['ID_SALES']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Alamat</label>
									<div class="col-lg-5">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['ALAMAT_SALES']?>" required>
								     
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Telp</label>
									<div class="col-lg-5">
										<input type="text" name="telp" id="telp" class="form-control" autocomplete="off" value="<?=$val['TELP_SALES']?>" required>
								     
									</div>
								</div>
                                 
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-6">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=sales'">
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
		<form action="index.php?x=sales" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Sales</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="5%">Kode </th>
                              <th width="20%">Nama Sales</th>
                               <th width="20%">Alamat Sales</th>
                                <th width="20%">Telp Sales</th>
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
	$data = array("STATUS_SALES" => 0);
	$db->update("sales",$data,"ID_SALES='$_POST[id]'");
	echo "<script>window.location='index.php?x=sales'</script>";
}
?>