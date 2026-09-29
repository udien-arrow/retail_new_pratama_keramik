
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("preferences","*","id_pref='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=pref_s" name="formku" id="formku" method="post" enctype='multipart/form-data' onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nomer Preferensi</label>
									<div class="col-lg-5">
										<input type="text" name="nopref" id="nopref" class="form-control" autocomplete="off" value="<?=$val['nopref']?>" required>
								      <input type="hidden" name="id_pref" id="id_pref" class="form-control" value="<?=$val['id_pref']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama </label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_perusahaan']?>" required>
								     	</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Alamat</label>
									<div class="col-lg-5">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Npwp</label>
									<div class="col-lg-5">
										<input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" value="<?=$val['npwp']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Telp</label>
									<div class="col-lg-5">
										<input type="text" name="telp" id="telp" class="form-control" autocomplete="off" value="<?=$val['no_telp']?>" required>								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Logo</label>
									<div class="col-lg-5">
										<input type="file" name="logo" id="logo"  value="">
                                        <input type="hidden" name="logo1" id="logo1"  value="<?=$val['logo']?>">

<?php
if ($val['logo'] == ""){
		echo 'Belum Ada Logo';
}else{
	?>
    <img src="logo/<?=$val['logo'] ?>" width='100' height='100' />
    <?php
}
?>
				  
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=pref'">
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
		<form action="index.php?x=pref" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master preferences</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Nomer Preferensi </th>
                              <th width="15%">Nama Perusahaan</th>
                               <th width="20%">Alamat</th>
                                <th width="20%">Npwp</th>
                                 <th width="20%">No Telp</th>
                                 <th width="20%">Logo</th>
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
	$where = array("id_pref" => $_POST['id']);
	$db->delete("preferences",$where);
	echo "<script>window.location='index.php?x=pref'</script>";
}
?>