  <style>
  .scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space:nowrap
}
  </style> 
		<div class="col-lg-4">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_pegawai_habor","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=peghabor_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Pegawai</label>
								  <div class="col-lg-8">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_pegawai']?>" required>
								      
								    <span class="col-lg-7">
									    <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
								    </span></div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Jabatan</label>
									<div class="col-lg-7">
									  <select class="select-search" name="jabatan" id="jabatan" required>
									    <option value="">--Jenis--</option>
									    <?php
											$query=$db->select("m_jabatan","*","id_divisi='2'");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_jabatan']?>"  <?php if($sel['id_jabatan']==$val['id_jabatan']){echo "selected";}?>>
									      <?=$sel['nama_jabatan']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Status Pegawai</label>
									<div class="col-lg-7">
									  <select class="select" name="statuspeg" id="statuspeg" required>
									    <option value="">--Status--</option>
									    <?php
											$query=$db->select("hr_m_kontrakpeg","*","gaji_pokok=0");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_status']?>"  <?php if($sel['id_status']==$val['id_status']){echo "selected";}?>>
									      <?=$sel['nama_kontrak']?>
								        </option>
									    <?php } ?>
								    </select>
									</div>
								</div>
                                
                                 <div class="form-group">
									<label class="control-label col-lg-4">Alamat</label>
									<div class="col-lg-8">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>" >
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">No KTP</label>
									<div class="col-lg-5">
										<input type="text" name="no_ktp" id="no_ktp" class="form-control" autocomplete="off" value="<?=$val['no_ktp']?>" required>
								      
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Tgl Mulai</label>
									<div class="col-lg-5">
										<input type="text" name="tgl_mulai" id="tgl_mulai" class="form-control datepicker" autocomplete="off" value="<?=$val['tgl_mulai']?>" required>
								      
									</div>
								</div>
                                
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=peghabor'">
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
		<form action="index.php?x=peghabor" id="form_index" method="post">
   		  <div class="panel panel-flat scrolls">
					<div class="panel-heading">
						<h5 class="panel-title">Temporaly Table
						Pegawai Harian & Borongan</h5>
                        <div class="heading-elements">
							<ul class="icons-list">
		                		<!--<li><a data-action="reload"></a></li>-->
                                <li>
                              <input style="height:25px; line-height: 0;" type="button" class="btn btn-info" value="View Pegawai Harian & Borongan" onClick="window.location='index.php?x=peghabor_v'"></button></li>
							</ul>
                            </div>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="1%">Nama</th>
                              	<th width="10%">Jabatan</th>
                                <th width="10%">Status</th>
                                <th width="10%">Tgl Mulai</th>
                                <th width="10%">No KTP</th>
                                
                                <th width="10%">Alamat</th>
                                <th width="4%">Jenis</th>
                                <th width="7%">Aksi</th>
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
	$db->delete("m_pegawai_habor",$where);
	echo "<script>window.location='index.php?x=peghabor'</script>";
}
?>