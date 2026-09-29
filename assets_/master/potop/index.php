    
		<div class="col-lg-5">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Tambah / Edit <?=$title?></h5>
					</div>
                    <div class="dataTables_wrapper"></div>
                    <div class="table-responsive pre-scrollable">
					<div class="panel-body">
                    <?php
                    $sat=$db->select("hr_m_potongan_opr","*","id_jenis='$_POST[id]'");
					foreach($sat as $val){}
					?>
					<form class="form-horizontal" action="index.php?x=potop_s" name="formku" id="formku" method="post" onSubmit="return(validate_frm())">
							<fieldset class="content-group">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
									<label class="control-label col-lg-4">Nama</label>
									<div class="col-lg-5">
										<input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?=$val['nama_jenis']?>" required>
								      <input type="hidden" name="kode" id="kode" class="form-control" value="<?=$val['id_jenis']?>"  required>
									</div>
								</div>
                                <div class="form-group">
                                   <label class="control-label col-lg-4">Jenis</label>
								   <div class="col-lg-4">
                              	  		<select name="jenis" class="select" id="jenis">
                                        	<option value="1" <?php if($val['type']=='1'){echo "selected";}?>>Potongan</option>
                                            <option value="2" <?php if($val['type']=='2'){echo "selected";}?>>Operasional</option>
                                    	</select>
                                   </div>
								</div>
                             
                              
                                <div class="form-group">
									<label class="control-label col-lg-4"></label>
									<div class="col-lg-5">
										<button class="btn btn-primary" type="submit" onClick="return confirm('Apakah Anda yakin menyimpan data??')">
										 Simpan 
                                        </button>
                                        <button class="btn btn-success" type="button" onClick="window.location='index.php?x=potop'">
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
		<form action="index.php?x=potop" id="form_index" method="post">
   		  <div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Master</h5>
					</div>
                    
					 <table id="example4" class="table datatable-basic table-bordered table-striped table-hover dataTable no-footer" >
                        <thead>
                            <tr>
                                <th width="20%">Nama  </th>
                              <th width="25%">Jenis</th>
                              <th width="5%">Aksi</th>
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
	$where = array("id_jenis" => $_POST['id']);
	$db->delete("hr_m_potongan_opr",$where);
	echo "<script>window.location='index.php?x=potop'</script>";
}
?>