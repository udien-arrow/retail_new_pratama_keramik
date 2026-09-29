    	<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit Daerah</h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("ex_lokasi_kirim","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=lokkir_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Lokasi Kirim</label>
									<div class="col-lg-5">
										<input type="text" name="lokasi" id="lokasi" class="form-control" autocomplete="off" value="<?=$val['lokasi_kirim']?>" required>
                                         <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Cabang</label>
								   <div class="col-lg-6">
										<select class="select-search" name="kota" id="kota">
                                      		 <option value="">--Cabang--</option>
											<?php
											$query=$db->select("m_cabang","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_cabang']?>"  <?php if($sel['id_cabang']==$val['kota']){echo "selected";}?>><?=$sel['nama_cabang']?></option> <?php } ?>
									</select>
								   </div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=lokkir'">
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
		<form action="index.php?x=lokkir" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kota</th>
                                <th width="25%">Lokasi Kirim</th>
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
	$where = array("id" => $_POST['id']);
	$db->delete("ex_lokasi_kirim",$where);
	echo "<script>window.location='index.php?x=lokkir'</script>";
}
?>