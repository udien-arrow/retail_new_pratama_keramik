    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Regional</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_regional","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=regavp_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                 <div class="form-group">
									<label class="control-label col-lg-4">Pegawai</label>
                                    <input type="hidden" name="kode" id="kode" value="<?=$_POST['id']?>">
								 	<div class="col-lg-5">
                                    	<select name="pegawai" id="pegawai" class="select-search">
										<option value="">---Pegawai---</option>
										<?php
											$query=$db->select("m_pegawai","*","id_st_jabatan='2'");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_pegawai']?>" <?php if($val['id_pegawai']==$sel['id_pegawai']){echo "selected";} ?>><?=$sel['nama_pegawai']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                            </div>
                             <div class="form-group">
									<label class="control-label col-lg-4">Wilayah</label>
								 	<div class="col-lg-5">
                                    	<select name="wilayah" id="wilayah" class="select-search">
										<option value="">---Wilayah---</option>
										<?php
											$query=$db->select("m_wilayah","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_wilayah']?>" <?php if($val['id_wilayah']==$sel['id_wilayah']){echo "selected";} ?>><?=$sel['nama_wilayah']?></option>
                                        
                                        <?php }?>    
									</select>
                                    </div>
                            </div>
                            
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=regavp'">
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
		<form action="index.php?x=regavp" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="50%">Nama Pegawai </th>
                              <th width="40%">Wilayah</th>
                                <th width="10%">Aksi</th>
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
	$db->delete("m_regional",$where);
	echo "<script>window.location='index.php?x=regavp'</script>";
}
?>