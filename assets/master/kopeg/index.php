    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_m_kontrakpeg","*","id_status='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=kopeg_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Kontrak</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_kontrak']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_status']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Gaji Pokok</label>
									<div class="col-lg-5">
										<input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control" autocomplete="off" value="<?=$val['gaji_pokok']?>" required placeholder="%">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tunj Umum</label>
									<div class="col-lg-5">
										<input type="text" name="tunj_umum" id="tunj_umum" class="form-control" autocomplete="off" value="<?=$val['tunj_umum']?>" required placeholder="%">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tunj Representatif</label>
									<div class="col-lg-5">
										<input type="text" name="tunj_repre" id="tunj_repre" class="form-control" autocomplete="off" value="<?=$val['tunj_repre']?>" required placeholder="%">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tunj Fungsional</label>
									<div class="col-lg-5">
										<input type="text" name="tunj_fungsi" id="tunj_fungsi" class="form-control" autocomplete="off" value="<?=$val['tunj_fungsi']?>" required placeholder="%">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tunj Presensi</label>
									<div class="col-lg-5">
										<input type="text" name="tunj_presensi" id="tunj_presensi" class="form-control" autocomplete="off" value="<?=$val['tunj_presensi']?>" required placeholder="%">
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Tunj Penempatan</label>
									<div class="col-lg-5">
										<input type="text" name="tunj_penem" id="tunj_penem" class="form-control" autocomplete="off" value="<?=$val['tunj_penem']?>" required placeholder="%">
									</div>
								</div>
                               
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=kopeg'">
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
		<form action="index.php?x=kopeg" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="5%">Kode </th>
                              <th width="25%">Nama Kontrak</th>
                              <th width="10%">Gaji Pokok (%)</th>
                              <th width="10%">Tunj Umum (%)</th>
                              <th width="10%">Tunj Repr (%)</th>
                              <th width="10%">Tunj Fungsi (%)</th>
                              <th width="10%">Tunj Presensi (%)</th>
                              <th width="10%">Tunj Penempatan (%)</th>
                            
                                <th width="15%">Aksi</th>
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
	$where = array("id_status" => $_POST['id']);
	$db->delete("hr_m_kontrakpeg",$where);
	echo "<script>window.location='index.php?x=kopeg'</script>";
}
?>