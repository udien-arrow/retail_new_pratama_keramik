
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_perusahaan","*","id_perusahaan='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=perusahaan_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode</label>
									<div class="col-lg-5">
										<input type="text" name="kode1" id="kode1" class="form-control" autocomplete="off" value="<?=$val['kode_perusahaan']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_perusahaan']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama </label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_perusahaan']?>" required>
								     	</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kota</label>
									<div class="col-lg-5">
										<input type="text" name="kota" id="kota" class="form-control" autocomplete="off" value="<?=$val['kota']?>" required>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Alamat</label>
									<div class="col-lg-5">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Email</label>
									<div class="col-lg-5">
										<input type="text" name="email" id="email" class="form-control" autocomplete="off" value="<?=$val['email']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Telp 1</label>
									<div class="col-lg-5">
										<input type="text" name="telp1" id="telp1" class="form-control" autocomplete="off" value="<?=$val['telp1']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Telp 2</label>
									<div class="col-lg-5">
										<input type="text" name="telp2" id="telp2" class="form-control" autocomplete="off" value="<?=$val['telp2']?>" required>
								     
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">No Fax</label>
									<div class="col-lg-5">
										<input type="text" name="no_fax" id="no_fax" class="form-control" autocomplete="off" value="<?=$val['fax']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">NPWP</label>
									<div class="col-lg-5">
										<input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" value="<?=$val['npwp']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Siup</label>
									<div class="col-lg-5">
										<input type="text" name="siup" id="siup" class="form-control" autocomplete="off" value="<?=$val['siup']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=perusahaan'">
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
		<form action="index.php?x=perusahaan" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master perusahaan</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kode </th>
                              <th width="15%">Nama Perusahaan</th>
                               <th width="20%">Alamat</th>
                                <th width="20%">No Fax</th>
                                 <th width="20%">Email</th>
                                 <th width="33%">Status</th>
                                <th width="33%">Aksi</th>
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
	$data = array( 
				 'status' => 0,
				 
		 );
	$exec= $db->update("m_perusahaan", $data, "id_perusahaan='$_POST[id]'");
	echo "<script>window.location='index.php?x=perusahaan'</script>";
}
?>