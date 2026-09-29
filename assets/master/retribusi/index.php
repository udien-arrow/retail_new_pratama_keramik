    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Retribusi</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("m_retribusi","*","id_retribusi='$_POST[id]'");
					foreach($sat as $val){}
					//echo $val[st_franco].'-'.$_POST[id];
					?>
					<form class="form-horizontal" action="index.php?x=retribusi_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Retribusi</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_retribusi']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_retribusi']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-2">
										<div class="checkbox checkbox-switch">
												<label>
													<input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="default" data-off-color="danger" <?php if($val[st_franco]=='1'){echo "checked";}?>   value="1" name="franco">
													&nbsp;&nbsp;&nbsp;&nbsp;Franco
												</label>
											</div>
									</div>
                                    <div class="col-lg-2">
										<div class="checkbox checkbox-switch">
												<label>
													<input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="default" data-off-color="danger" <?php if($val[st_locco]=='1'){echo "checked";}?> value="1" name="locco">
													&nbsp;&nbsp;&nbsp;&nbsp;Locco
												</label>
											</div>
									</div>
                                    <div class="col-lg-2">
										<div class="checkbox checkbox-switch">
												<label>
													<input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="default" data-off-color="danger" <?php if($val[st_da]=='1'){echo "checked";}?> value="1" name="da">
													&nbsp;&nbsp;&nbsp;&nbsp;DA
												</label>
											</div>
									</div>
								</div>
                               <br><br>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=retribusi'">
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
		<form action="index.php?x=retribusi" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                              <th width="13%">Kode </th>
                              <th width="55%">Nama</th>
                              <th width="8%">Franco</th>
                              <th width="8%">Locco</th>
                              <th width="8%">DA</th>
                              <th width="12%">Aksi</th>
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
	$where = array("id_retribusi" => $_POST['id']);
	$db->delete("m_retribusi",$where);
	echo "<script>window.location='index.php?x=retribusi'</script>";
}
?>