
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
                    $sat=$db->select("m_cabang","*","id_cabang='$_POST[id]'");
					foreach($sat as $val){}
					}
					?>
					<form class="form-horizontal" action="index.php?x=cabang_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kode</label>
									<div class="col-lg-3">
                                    <?php
									$ids=$db->select("m_cabang","max(kode_cabang)+1 as idm");
									foreach($ids as $val4){}
									if($val['id_cabang']=='')
									{  $aa=$val4['idm'];}else{ $aa=$val['kode_cabang'];}
									?>
										<input type="text" name="kode1" id="kode1" class="form-control" autocomplete="off" value="<?=sprintf("%02s",$aa)?>" required readonly>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_cabang']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kota Cabang</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_cabang']?>" required>
								     	</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Alamat</label>
									<div class="col-lg-7">
										<input type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" value="<?=$val['alamat']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Wilayah Pem</label>
									<div class="col-lg-7">
									  <select class="select-search" name="wilayah_pem" id="wilayah_pem">
									    <option value="">--Wilayah--</option>
									    <?php
											$query=$db->select("m_wilayah","*");
											foreach($query as $sel){	
			                            ?>
									    <option value="<?=$sel['id_wilayah']?>"  <?php if($sel['id_wilayah']==$val['id_wilayah_pem']){echo "selected";}?>>
									      <?=$sel['nama_wilayah']?>
								        </option>
									    <?php } ?>
								      </select>
									</div>
                                    </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">No Telp</label>
									<div class="col-lg-5">
										<input type="text" name="no_telp" id="no_telp" class="form-control" autocomplete="off" value="<?=$val['no_telp']?>" required>
								      
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">No Fax</label>
									<div class="col-lg-5">
										<input type="text" name="no_fax" id="no_fax" class="form-control" autocomplete="off" value="<?=$val['no_fax']?>" required>
								     
									</div>
								</div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Email</label>
									<div class="col-lg-5">
										<input type="text" name="email" id="email" class="form-control" autocomplete="off" value="<?=$val['email']?>" required>
								     
									</div>
								</div>
                                 
                                 <div class="form-group">
									<label class="control-label col-lg-4">Npwp</label>
									<div class="col-lg-5">
										<input type="text" name="npwp" id="npwp" class="form-control" autocomplete="off" value="<?=$val['npwp']?>" required>
								     
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Kordinat</label>
									<div class="col-lg-5">
										<input type="text" name="kordinat" id="kordinat" class="form-control" autocomplete="off" value="<?=$val['kordinat']?>" required>
								     
									</div>
								</div>
                                
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-6">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=cabang'">
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
		<form action="index.php?x=cabang" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Cabang</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="5%">Kode </th>
                              <th width="20%">Kota Cabang</th>
                               <th width="20%">No Telp</th>
                                <th width="20%">No Fax</th>
                                 <th width="20%">Kordinat</th>
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
	$data = array("status" => 0);
	$db->update("m_cabang",$data,"id_cabang='$_POST[id]'");
	echo "<script>window.location='index.php?x=cabang'</script>";
}
?>