    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_upah_dekom","*","id='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=upahdekom_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama Jabatan</label>
									<div class="col-lg-5">
										<select name="jabatan" id="jabatan" class="select">
										<option value="">---Pilih Jabatan---</option>
										<?php
											$query=$db->select("m_jabatan","*");
											foreach($query as $sel){	
			                            ?>
                                        	<option value="<?=$sel['id_jabatan']?>" <?php if($sel['id_jabatan']==$val['id_jabatan']){echo "selected";}?>><?=$sel['nama_jabatan']?></option>
                                        
                                        <?php }?>    
									</select>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nominal</label>
									<div class="col-lg-5">

									<input type="text" name="nominal" id="nominal" class="form-control harga" autocomplete="off" value="<?=$val['nominal']?>" required>
                                    
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id']?>"  required>
									</div>
								</div>
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=upahdekom'">
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
		<form action="index.php?x=upahdekom" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master Upah Dekom</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="13%">Kode </th>
                                <th width="25%">Nama Jabatan</th>
                              <th width="35%" >Nominal</th>
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
	$db->delete("hr_upah_dekom",$where);
	echo "<script>window.location='index.php?x=upahdekom'</script>";
}
?>